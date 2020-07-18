<?php
/**
 * Creates a table
 * 
 * Creates a table in the given database and responds whether it was successful or not
 * 
 * @param	mysqli	$connection	The MySQLi connection to the database
 * @param	string	$sql			The SQL statement for creating a table
 */
function createTable($connection, $sql) {
	if ($connection->query($sql) === TRUE) {
		echo "Table created successfully<p>";
	} else {
		echo "Error creating table: " . $connection->error . "<p>";
	}
}


/**
 * Creates a database
 * 
 * Creates a database in the given connection and responds whether it was successful or not
 * 
 * @param	mysqli	$connection	The MySQLi connection
 * @param	string	$sql			The SQL statement for creating a database
 */
function createDatabase($connection, $sql) {
	if ($connection->query($sql) === TRUE) {
		echo "Database created successfully<p>";
	} else {
		echo "Error creating database: " . $connection->error . "<p>";
	}
}


/**
 * Clears a table
 * 
 * Deletes all rows from the given table and responds whether it was successful or not
 * 
 * @param	mysqli	$connection	The MySQLi connection to the database
 * @param	string	$sql			The SQL statement for clearing a table
 */
function clearTable($connection, $sql) {
	if ($connection->query($sql) === TRUE) {
		echo "Table cleared successfully<p>";
	} else {
		echo "Error clearing table: " . $connection->error . "<p>";
	}
}


/**
 * Inserts a product into concreteProducts
 * 
 * Inserts a new concrete product item with the given paramaters into the database
 * and responds whether it was successful or not
 * 
 * @param	mysqli	$connection	The MySQLi connection to the database
 * @param	string	$name		The randomly generated name for the concrete product
 * @param	int		$weight		The randomly generated weight for the concrete product
 */
function insertProduct($connection, $name, $weight) {
	$sql = "INSERT INTO concreteProducts (productName, productWeight) VALUES ('$name', '$weight');";
	if ($connection->query($sql) === FALSE) {
		echo "Error inserting item: " . $connection->error . "<p>";
	}
}


/**
 * Inserts a truck into the trucks table
 * 
 * A new truck with all data - name, max capacity, load capacity and money - gets inserted into the database
 * 
 * @param	mysqli	$connection	The MySQLi connection to the database
 * @param	string	$truckName	The user inserted name for the truck
 * @param	int		$maxLoad		The maximum capacity of thr truck
 * @param	int		$totalWeight	The total load capacity to be loaded onto thr truck
 * @param	int		$money		The total amount of money needed for the process
 */
function insertTruck($connection, $truckName, $maxLoad, $totalWeight, $money) {
	$sql = "INSERT INTO trucks (truckName, maxLoad, currentLoad, money) VALUES ('$truckName', '$maxLoad', '$totalWeight', '$money');";
	if ($connection->query($sql) === FALSE) {
		echo "Error inserting truck: " . $connection->error . "<p>";
	}
}


/**
 * Gets last truck by ID
 * 
 * When a new truck gets added, we need to know its ID, so we ask for it.
 * 
 * @param	mysqli	$connection	MySQLi connection ot the database
 */
function getLastTruckID($connection) {
	return mysqli_query($connection, file_get_contents("sql/select-last-truck.sql"))->fetch_row()[0];
}


/**
 * Inserts a new truck->product relation
 * 
 * A truck has got 1->many relation for products, so this function is used to add all the relations.
 * 
 * @param	mysqli	$connection	MySQLi connection ot the database
 * @param	int		$truckID		The index/ID of the truck in question
 * @param	int		$index		The index/ID of the product that the truck is connected to
 */
function insertTruckProductRelation($connection, $truckID, $index) {
	$sql = "INSERT INTO loadedProducts (truckID, productID) VALUES ('$truckID', $index);";
	if ($connection->query($sql) === FALSE) {
		echo "Error inserting relation: " . $connection->error . "<p>";
	}
}


/**
 * Updates the product transport state
 * 
 * When a product gets added on a truck, the product transported state gets updates from FALSE to TRUE.
 * 
 * @param	mysqli	$connection	MySQLi connection ot the database
 * @param	int		$index		The ID/index of the product
 */
function updateProductTransportState($connection, $index) {
	$sql = "UPDATE concreteProducts SET transported=TRUE WHERE productID = $index;";
	if ($connection->query($sql) === FALSE) {
		echo "Error updating product relation state: " . $connection->error . "<p>";
	}
}


/**
 * Gets the product name and weight by ID
 * 
 * After we figure out what products to load, we also need a new request to get the names to print to the user.
 * 
 * @param	mysqli	$connection	MySQLi connection ot the database
 * @param	int		$index		The ID/index of the product
 */
function getProductNameAndWeightByID($connection, $index) {
	$sql = "SELECT productName, productWeight FROM concreteProducts WHERE productID = $index;";
	return mysqli_fetch_array(mysqli_query($connection, $sql));
}
?>