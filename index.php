<?php
include "nextTruck.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
	<title>Load that concrete!</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="main">
		<div class="insert">
			<form id="concreteForm" action="" method="post">
				<b>Concrete loading control panel</b><p>
				Insert your data here:<p>
				<input type="text" id="truckname" name="truckname" placeholder="Truck name"><p>
				<input type="text" id="maxload" name="maxload" placeholder="Truck max load (kg)"><p>
				<input type="submit" id="submit">
			</form><br>
		<div>
		<div class="result">
			<?php
			if (isset($_POST["maxload"])) manageNextLoad();
			printResult();
			?>
		</div>
	</div>
</body>
</html>