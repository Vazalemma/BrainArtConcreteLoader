<?php
include "concretedbVariables.php";
include "databaseFunctions.php";
include "sideFunctions.php";


/**
 * Static variables for product choosing
 * 
 * $printResult (string) - Formatted result about what products to load as a response to the user
 * $bestTotalWeight (int) - Highest load that is lower than max capacity based on currently available products
 * $bestProducts (associative array) - Array of the best chosen products in [ID => weight] format
 */
$printResult = "";
$bestTotalWeight = 0;
$bestProducts = array();


/**
 * Manage the next load of products to load onto the truck
 * 
 * This function takes user input, loads in all untransported products, figures out the batch of products
 * to send onto the next truck, updates all databased accordingly and gives the user the necessary response.
 */
function manageNextLoad() {
	global $server;
	global $user;
	global $pass;
	global $db;
	global $bestTotalWeight;
	global $printResult;
	
	$connection = new mysqli($server, $user, $pass, $db);
	if ($connection->connect_error) die("Connection failed: " . $connection->connect_error);
	
	$truckName = cleanInput($connection, $_POST["truckname"]);
	$maxLoad = intval(cleanInput($connection, $_POST["maxload"]));
	
	if (truckLoadIsNotAppropriate($maxLoad)) {
		alert(wrongMaxLoadMessage());
		exit();
	}
	
	$products = mysqli_query($connection, file_get_contents("sql/select-concrete-id-weight.sql"));
	if (mysqli_num_rows($products) == 0) {
		alert("Error: No products to load.");
		exit();
	}
	
	$batch = bestProductsToLoadByID($products, $maxLoad);
	$money = getProcessCost($batch, $bestTotalWeight);
	
	insertTruck($connection, $truckName, $maxLoad, $bestTotalWeight, $money);
	$truckID = getLastTruckID($connection);
	
	$printResult = "Concrete loading validation successful!<br>Load these following products:<p>";
	foreach ($batch as $index) {
		insertTruckProductRelation($connection, $truckID, $index);
		updateProductTransportState($connection, $index);
		$product = getProductNameAndWeightByID($connection, $index);
		$printResult = $printResult . $product['productName'] . " (" . $product['productWeight'] . " kg)<br>";
	}
	$printResult = $printResult . "<br>Total weight: " . $bestTotalWeight . "/" . $maxLoad . " kg<br>Total money: " . $money . " units";
}


/**
 * Gets the IDs of the best products to load onto the truck
 * 
 * Through an [ID => weight] array system and a recursive function,
 * it figures out the best products to add and lists them by ID as an array.
 * 
 * @param	mysqli	$products	MySQLi formatted rows of all products that haven't been transported yet
 * @param	int		$maxLoad	Maximum load capacity of the truck
 * @return	array				Array of IDs of the best products to load
 */
function bestProductsToLoadByID($products, $maxLoad) {
	global $bestProducts;
	
	$weights = array();
	while ($row = mysqli_fetch_array($products)) {
		$weights[$row["productID"]] = $row["productWeight"];
	}
	
	getBestLoadFit($weights, $maxLoad, array());
	return array_keys($bestProducts);
}


/**
 * Get best products to fit on the truck
 * 
 * Recursive method for choosing the best products by their weight
 * and truck max capacity to load onto the truck.
 * 
 * @param	array	$array		Array of products in [ID => weight] format
 * @param	int	$maxWeight	Maximum weight capacity of the truck
 * @param	array	$currentBatch	Array of products that have already been recursively passed
 * @return	-				Returns when capacity has been perfectly reached or overcapped
 */
function getBestLoadFit($array, $maxWeight, $currentBatch) {
	global $bestTotalWeight;
	global $bestProducts;
	
	$totalWeight = array_sum($currentBatch);
	
	if ($totalWeight == $bestTotalWeight and $totalWeight == $maxWeight) return;
	if ($totalWeight > $maxWeight) return;
	if ($totalWeight > $bestTotalWeight) {
		$bestTotalWeight = $totalWeight;
		$bestProducts = $currentBatch;
		if ($totalWeight == $maxWeight) return;
	}
	
	foreach ($array as $id => $weight) {
		unset($array[$id]);
		$newBatch = $currentBatch;
		$newBatch[$id] = $weight;
		getBestLoadFit($array, $maxWeight, $newBatch);
	}
}


/**
 * Print the html product loading results
 * 
 * All the products that the system has decided to load onto the truck get printed to the user in a neat format.
 */
function printResult() {
	global $printResult;
	echo $printResult;
}
?>
