<?php
	require('connect-db.php');
	//echo $_POST['color'];		


	$query = "UPDATE users 
			SET style=\"" . $_POST['col'] . "\" 
			WHERE user_ID= \"" . $_COOKIE['user'] . "\";";	
	$statement = $db->prepare($query);		
	$results = $statement->execute();
	$statement->closeCursor();		
		

?>