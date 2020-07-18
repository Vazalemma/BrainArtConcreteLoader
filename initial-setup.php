<?php
include "createProducts.php";

/**
 * Create the initial database
 * 
 * Create the database (in this case, 'concretedb') that we will be using in this project.
 */
function createInitialDatabase() {
	global $server;
	global $user;
	global $pass;
	global $db;

	$connection = new mysqli($server, $user, $pass);
	if ($connection->connect_error) die("Connection failed: " . $connection->connect_error);
	
	createDatabase($connection, file_get_contents("sql/create-concretedb.sql"));

	$connection->close();
}


/**
 * Create the necessary tables
 * 
 * Create the three tables that will be used in this project.
 * One is for the concrete products, one is for the trucks,
 * and the last one is for relations between the truck and the products it's carrying
 */
function createTables() {
	global $server;
	global $user;
	global $pass;
	global $db;
	
	$connection = new mysqli($server, $user, $pass, $db);
	if ($connection->connect_error) die("Connection failed: " . $connection->connect_error);
	
	createTable($connection, file_get_contents("sql/create-concreteProducts.sql"));
	createTable($connection, file_get_contents("sql/create-trucks.sql"));
	createTable($connection, file_get_contents("sql/create-loadedProducts.sql"));
	
	$connection->close();
}


createInitialDatabase();
createTables();
generateConcreteProducts();
?>