<?php
include "concretedbVariables.php";


/**
 * Generates a random name
 * 
 * Given three arrays: adjectives, adverbs and nouns,
 * it generates a name for the concrete products.
 * The arrays can be found in concretedbVariables.php.
 * 
 * @return	string	A random string of words generated from the random word arrays
 */
function randomName() {
	global $randAdj;
	global $randAdv;
	global $randNoun;
	
	return join(" ", array(randomWord($randAdj), randomWord($randAdv), randomWord($randNoun)));
	//return randomWord($ranAdj) . " " . randomWord($ranAdv) . " " . randomWord($ranNoun);
}


/**
 * Generates a random weight
 * 
 * The weight is between the two global arguments given in the variables file.
 * 
 * @return	int	A random number between the weight limit (55, 5555)
 */
function randomWeight() {
	global $MIN_PRODUCT_WEIGHT_KG;
	global $MAX_PRODUCT_WEIGHT_KG;
	
	return rand($MIN_PRODUCT_WEIGHT_KG, $MAX_PRODUCT_WEIGHT_KG);
}


/**
 * Chooses a random word in a given array
 * 
 * With the array variable, it chooses a random word (string) within its entire length.
 * 
 * @param	array	$array	The array that the item gets chosen from
 * @return	string		A random item from the array
*/
function randomWord($array) {
	return $array[rand(0, count($array) - 1)];
}


/**
 * Cleans the user typed input
 * 
 * Cleans the input that the user gives when typing in a truck name and max load capacity.
 * 
 * @param	mysqli	$connection	The MySQLi connection to the database
 * @param	string	$input		The input text given by the user
 * @return	string				The cleaned & stripped input that was given by the user
 */
function cleanInput($connection, $input) {
	return strip_tags(mysqli_real_escape_string($connection, $input));
}


/**
 * Alerts a message
 * 
 * Echos out a javascript text that alerts the user with the given message
 * 
 * @param	string	$message	The given message to alert
 */
function alert($message) {
	echo "<script type='text/javascript'>alert('$message');</script>";
}


/**
 * Loads the wrong maximum load message
 * 
 * When the user inputs a wrong max load value, this message gets alerted back to the user
 * that tells them the limits of what a truck should be able to handle.
 * 
 * @return	string	The message to be alerted to the user
 */
function wrongMaxLoadMessage() {
	global $MIN_TRUCK_LOAD_KG;
	global $MAX_TRUCK_LOAD_KG;
	return "Max load can only be $MIN_TRUCK_LOAD_KG-$MAX_TRUCK_LOAD_KG KG.";
}


/**
 * Checks if truck max load is appropriate
 * 
 * Every truck has its maximum capacity, so we check if the given capacity seems reasonable.
 * We don't want user to accidentally mistype in an unreasonable number.
 * 
 * @param	int		$maxLoad	The user inputted maximum load of a truck
 * @return	boolean			True/False based on if the input seems reasonable
 */
function truckLoadIsNotAppropriate($maxLoad) {
	global $MIN_TRUCK_LOAD_KG;
	global $MAX_TRUCK_LOAD_KG;
	return $maxLoad < $MIN_TRUCK_LOAD_KG or $maxLoad > $MAX_TRUCK_LOAD_KG;
}


/**
 * Get the cost of the process
 * 
 * Takes into acount the loading cost of each product, the initial department cost of
 * the truck, and the extra costs that come based on the total weight of all products combined.
 * 
 * @param	array	$batch	The array of the IDs of all chosen products
 * @param	int	$weight	The total weight of all products
 * @return	int			The total amount of money needed for the process
 */
function getProcessCost($batch, $weight) {
	global $TRUCK_DEPARTMENT_INITIAL_COST;
	global $TRUCK_EXTRA_COST_PER_KG;
	return $TRUCK_DEPARTMENT_INITIAL_COST + count($batch) + floor($weight / $TRUCK_EXTRA_COST_PER_KG);
}
?>