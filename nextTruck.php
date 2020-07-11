<?php
$printResult = "";

function manageNextLoad() {
	$db = new mysqli("localhost", "root", "", "concretedb") or die("Unable to connect");
	
	$truckName = cleanInput($db, $_POST["truckname"]);
	$maxLoad = intval(cleanInput($db, $_POST["maxload"]));
	
	if ($maxLoad < 1000 or $maxLoad > 8000) {
		alert("Max load can only be 1000-8000 kg.");
		exit();
	}
	
	// Get all untransported products
	$products = mysqli_query($db, "SELECT productID, productWeight FROM concreteProducts WHERE transported = FALSE;");
	$weights = array();
	$x = 0;
	while ($row = mysqli_fetch_array($products)) {
		$weights[$row["productID"]] = $row["productWeight"];
		$x = $x + 1;
	}
	
	// Fit as much concrete on it as possible (can be optimized)
	$total = 0;
	$batch = array();
	foreach ($weights as $id => $weight) {
		if ($total + $weight > $maxLoad) continue;
		$total += $weight;
		array_push($batch, $id);
	}
	
	$money = 60 + count($batch) + floor($total / 50);
	
	// Update DBs & Print
	mysqli_query($db, "INSERT INTO trucks (truckName, maxLoad, currentLoad, money) VALUES ('$truckName', '$maxLoad', '$total', '$money');");
	$truckID = mysqli_query($db, "SELECT * FROM trucks ORDER BY truckID DESC LIMIT 1;")->fetch_row()[0];
	
	global $printResult;
	$printResult = "Concrete loading validation successful!<br>Load these following products:<p>";
	foreach ($batch as $index) {
		mysqli_query($db, "INSERT INTO loadedProducts (truckID, productID) VALUES ('$truckID', $index);");
		mysqli_query($db, "UPDATE concreteProducts SET transported=TRUE WHERE productID = $index;");
		$product = mysqli_fetch_array(mysqli_query($db, "SELECT productName, productWeight FROM concreteProducts WHERE productID = $index;"));
		$printResult = $printResult . $product['productName']. " (" . $product['productWeight'] . " kg)<br>";
	}
	$printResult = $printResult . "<br>Total weight: " . $total . "/" . $maxLoad . " kg<br>Total money: " . $money . " units";
}

function printResult() {
	global $printResult;
	echo $printResult;
}

function cleanInput($database, $value) {
	return strip_tags(mysqli_real_escape_string($database, $value));
}

function alert($message) {
	echo "<script type='text/javascript'>alert('$message');</script>";
}
?>
