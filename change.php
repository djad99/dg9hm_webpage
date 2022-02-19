<?php
	require('connect-db-event.php');
	$pk = strval($_POST["pk"]);
	$event = strval($_POST["event"]);
	$month = strval($_POST["month"]);
	$day = intval($_POST["day"]);
	$year = intval($_POST["year"]);
	$time = strval($_POST["time"]);
	$location = strval($_POST["location"]);
	$tag = strval($_POST["tag"]);
	$notes = strval($_POST["notes"]);
	//echo $pk;
	//echo $event;
	//echo $month;
	//echo $day;
	//echo $year;
	//echo $time;
	//echo $location;
	//echo $tag;
	//echo $notes;
	
	$query = "UPDATE user_events 
			SET event=\"" . $event . "\", month=\"" . $month . "\", day=" . $day . ", year=" . $year . ", 
			time= \"" . $time . "\", location=\"" . $location . "\", tags=\"" . $tag . "\", notes= \"'" . $notes . "\" 
			WHERE summary= \"" . $pk . "\";";	
	//echo $query;	
	//$query = "DELETE FROM user_events WHERE course_ID=:pk";

	$statement = $db->prepare($query);
	//mysql_query($query, $db);
	//$statement->bindValue(':event', $event);
	//$statement->bindValue(':month', $month);
	//$statement->bindValue(':day', $day);
	//$statement->bindValue(':year', $year);
	//$statement->bindValue(':time', $time);
	//$statement->bindValue(':location', $location);
	//$statement->bindValue(':tag', $tag);
	//$statement->bindValue(':notes', $notes);	
	//$statement->bindValue(':summ', $pk);
	
	$results = $statement->execute();
	//echo $results;
	$statement->closeCursor();
	//mysql_close($db);
	
?>



