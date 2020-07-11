<?php
// Connect to DB
$user = "root";
$pass = "";
$db = "concretedb";
$db = new mysqli("localhost", $user, $pass, $db) or die("Unable to connect");
echo "Connected<p>";

// Create new tables
$createProducts = "CREATE TABLE concreteProducts (productID int NOT NULL AUTO_INCREMENT, productName VARCHAR(255), productWeight int NOT NULL, transported BOOL DEFAULT FALSE, PRIMARY KEY (productID));";
$deleteProducts = "DELETE FROM concreteProducts;";
$createTrucks = "CREATE TABLE trucks (truckID int NOT NULL AUTO_INCREMENT, truckName VARCHAR(255), maxLoad int NOT NULL, currentLoad int NOT NULL, money int NOT NULL, PRIMARY KEY (truckID));";
$deleteTrucks = "DELETE FROM trucks;";
$createRelations = "CREATE TABLE loadedProducts (truckID int NOT NULL, productID int NOT NULL, FOREIGN KEY (truckID) REFERENCES trucks(truckID), FOREIGN KEY (productID) REFERENCES concreteProducts(productID));";
$deleteRelations = "DELETE FROM loadedProducts;";
mysqli_query($db, $deleteRelations);
mysqli_query($db, $deleteProducts);
mysqli_query($db, $deleteTrucks);
mysqli_query($db, $createProducts);
mysqli_query($db, $createTrucks);
mysqli_query($db, $createRelations);
echo "Tables created<p>";

// Create exactly 100 tonnes worth of products
$ranAdj = array("Red", "Pink", "Purple", "Gray", "Light Gray", "Dark Gray", "Black", "White", "Heavy", "Massive", "Tiny", "Old", "New");
$ranAdv = array("Ancient", "Chiseled", "Packed", "Painted", "Patterened", "Building", "Universal", "Lego", "Fragile", "Buttered");
$ranNoun = array("Concrete", "Concrete Block", "Concrete Vase", "Concrete Floor", "Concrete Wall", "Concrete Bottle");
$x = 100000;
while ($x > 5555) {
	$weight = rand(55, 5555);
	$name = $ranAdj[rand(0, 12)] . " " . $ranAdv[rand(0, 9)] . " " . $ranNoun[rand(0, 5)];
	$sql = "INSERT INTO concreteProducts (productName, productWeight) VALUES ('$name', '$weight');";
	mysqli_query($db, $sql);
	$x = $x - $weight;
}
$sqlf = "INSERT INTO concreteProducts (productName, productWeight) VALUES ('Moms Heavy Concrete Toy', '$x');";
mysqli_query($db, $sqlf);
echo "Products created";
?>