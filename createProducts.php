<?php
include "concretedbVariables.php";
include "databaseFunctions.php";
include "sideFunctions.php";

/**
 * Generate random concrete products
 * 
 * Generates the exact given weight (100'000 KG) worth of concrete products
 * whereas each product weights between the given limits (55, 5555 KG).
 * For better UI presentation, a random name is given to each product as well.
 */
function generateConcreteProducts() {
	global $LOAD_TO_GENERATE_KG;
	global $MAX_PRODUCT_WEIGHT_KG;
	global $server;
	global $user;
	global $pass;
	global $db;
	
	$connection = new mysqli($server, $user, $pass, $db);
	if ($connection->connect_error) die("Connection failed: " . $connection->connect_error);
	
	$x = $LOAD_TO_GENERATE_KG;
	while ($x > $MAX_PRODUCT_WEIGHT_KG) {
		$weight = randomWeight();
		insertProduct($connection, randomName(), $weight);
		$x -= $weight;
	}
	insertProduct($connection, randomName(), $x);
	echo "All products inserted successfully";
	
	$connection->close();
}
?>