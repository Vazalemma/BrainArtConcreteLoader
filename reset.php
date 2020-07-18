<?php
include "createProducts.php";

/**
 * Clear the tables
 * 
 * Clears all three tables from their content for the purpose of resetting the test.
 * It is required for the relations table to be cleared first,
 * otherwise the database responds with an error saying
 * you can't delete relations.
 */
function clearTables() {
	global $server;
	global $user;
	global $pass;
	global $db;
	
	$connection = new mysqli($server, $user, $pass, $db);
	if ($connection->connect_error) die("Connection failed: " . $connection->connect_error);
	
	clearTable($connection, file_get_contents("sql/clear-loadedProducts.sql"));
	clearTable($connection, file_get_contents("sql/clear-concreteProducts.sql"));
	clearTable($connection, file_get_contents("sql/clear-trucks.sql"));
	
	$connection->close();
}


clearTables();
generateConcreteProducts();
?>