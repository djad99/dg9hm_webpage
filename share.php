<?php
$name = $day = $month = $year = $time = $location = $tags = $notes = NULL;
$msg_event = $msg_date = NULL;
//setcookie('success', "");


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$okay_name = 0;
	$okay_date = 1;

	if (empty($_POST['event'])){
		$msg_event = "Please enter the name of the event. <br />";
	}
	else
	{
		$event = trim($_POST['event']);
		$msg_event = "";
		$okay_name = 1;
	}

	$event = $_POST['event'];

	$month = $_POST['month'];
	$word_month = $month;
	$day = $_POST['day'];
	$year = $_POST['year'];

	if(($day == "Day") || ($year == "Year") || ($month == "Month")){
		$msg_date = "Please enter a valid date.";
		$okay_date = 0;
	}

	$day = (int)$day;
	$year = (int)$year;

	switch ($month) {
		case"Jan":
			$month = 1;
			break;
		case "Feb":
			$month = 2;
			if((($year % 4) == 0) && ($day > 29)){
				$msg_date = "Please enter a valid date.";
				$okay_date = 0;
			}
			else if((($year % 4) != 0) && ($day > 28)){
				$msg_date = "Please enter a valid date.";
				$okay_date = 0;
			}
			break;
		case "Mar":
			$month = 3;
			break;
		case "Apr":
			$month = 4;
			if($day > 30){
				$msg_date = "Please enter a valid date.";
				$okay_date = 0;
			}
			break;
		case "May":
			$month = 5;
			break;
		case "Jun":
			$month = 6;
			if($day > 30){
				$msg_date = "Please enter a valid date.";
				$okay_date = 0;
			}
			break;
		case "Jul":
			$month = 7;
			break;
		case "Aug":
			$month = 8;
			break;
		case "Sep":
			$month = 9;
			if($day > 30){
				$msg_date = "Please enter a valid date.";
				$okay_date = 0;
			}
			break;
		case "Oct":
			$month = 10;
			break;
		case "Nov":
			$month = 11;
			if($day > 30){
				$msg_date = "Please enter a valid date.";
				$okay_date = 0;
			}
			break;
		default:
			$month = 12;
	}

	$currDay = (int)date("d");
	$currMonth = (int)date("m");
	$currYear = (int)date("Y");

	if(($month < $currMonth) && ($year <= $currYear)){
		$msg_date = "Please enter a valid date.";
		$okay_date = 0;
	}
	if(($month == $currMonth) && ($year == $currYear)){
		if($day < $currDay){
			$msg_date = "Please enter a valid date.";
			$okay_date = 0;
		}
	}

	if($okay_date == 1){
		$msg_date = "";
	}

	if(($okay_date == 1) && ($okay_name == 1)){
		$time = $_POST['time'];
		$location = $_POST['location'];
		$tags = $_POST['tags'];
		$notes = $_POST['notes'];
		addToDatabase($event, $word_month, $day, $year, $time, $location, $tags, $notes);
	}

}

function addToDatabase($event, $month, $day, $year, $time, $location, $tags, $notes){
	require('connect-db-event.php');

	$user = $_COOKIE['user'];
	$summary = $user . "-" . $event . "-" . $month . "-" . strval($day) . "-" . strval($year) . "-" . "1";


	$query = "INSERT INTO user_events (summary, user, event, month, day, year, time, location, tags, notes)
				VALUES (:summ, :user, :event, :month, :day, :year, :time, :location, :tags, :notes)";

	$statement = $db->prepare($query);

	$statement->bindValue(':summ', $summary);
	$statement->bindValue(':user', $user);
	$statement->bindValue(':event', $event);
	$statement->bindValue(':month', $month);
	$statement->bindValue(':day', $day);
	$statement->bindValue(':year', $year);
	$statement->bindValue(':time', $time);
	$statement->bindValue(':location', $location);
	$statement->bindValue(':tags', $tags);
	$statement->bindValue(':notes', $notes);

	$result = $statement->execute();
	$statement->closeCursor();
	setcookie('success', "Event successfully added.");
	header('Location: main_page.php');
	}


?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Gracie Wright and David Gray">
  <meta name="description" content="adding events page">

  <title>Add Event</title>
  <link rel="stylesheet" href="styles/style1.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <style>
	div{
		align: center;
		width: 80%;
	}
  </style>

</head>
<body>

<div>
   <h1>Share Event</h1>


   <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

     <div class="form-group row col-sm-12">
	 <label class="col-sm-2" align="left">Event Title:* </label>
	 <div class="col-sm-10">
     <input type="text" name="event" class="form-control"
            value="<?php if (isset($_POST['event'])) echo $_POST['event'] ?>"
            <?php if (empty($_POST['event'])) { ?> autofocus <?php } ?>  />
			<span class="msg"><?php if ($msg_event != "") echo $msg_event ?></span>
		</div>
      </div>

	 <div class="form-group row col-sm-12">
		<label class="col-sm-2" align="left">Date:*</label>
			<div class="col-sm-10">
			<select id="month" name="month" class="col-sm-3" value="<?php echo $_POST['month'] ?>">
			  <option>Month</option>
			  <option>Jan</option>
			  <option>Feb</option>
			  <option>Mar</option>
			  <option>Apr</option>
			  <option>May</option>
			  <option>Jun</option>
			  <option>Jul</option>
			  <option>Aug</option>
			  <option>Sep</option>
			  <option>Oct</option>
			  <option>Nov</option>
			  <option>Dec</option>
			</select>

			<select id="day" name="day" class="col-sm-2" value="<?php echo $_POST['day'] ?>">
			  <option>Day</option>
			  <option>1</option>
			  <option>2</option>
			  <option>3</option>
			  <option>4</option>
			  <option>5</option>
			  <option>6</option>
			  <option>7</option>
			  <option>8</option>
			  <option>9</option>
			  <option>10</option>
			  <option>11</option>
			  <option>12</option>
			  <option>13</option>
			  <option>14 </option>
			  <option>15</option>
			  <option>16</option>
			  <option>17</option>
			  <option>18</option>
			  <option>19</option>
			  <option>20</option>
			  <option>21</option>
			  <option>22</option>
			  <option>23</option>
			  <option>24</option>
			  <option>25</option>
			  <option>26</option>
			  <option>27</option>
			  <option>28</option>
			  <option>29</option>
			  <option>30</option>
			  <option>31</option>
			</select>

			<select id="year" name="year" class="col-sm-3" value="<?php echo $_POST['year'] ?>">
			  <option>Year</option>
			  <option>2020</option>
			  <option>2021</option>
			  <option>2022</option>
			  <option>2023</option>
			  <option>2024</option>
			  <option>2025</option>
			  <option>2026</option>
			  <option>2027</option>
			  <option>2028</option>
			  <option>2029</option>
			  <option>2030</option>
			</select>

			<span id="msg_date"> <?php if ($msg_date != "") echo $msg_date ?> </span>
			</div>
	 </div>


	 <div class="form-group row col-sm-12">
		<label class="col-sm-2" align="left">Time:</label>
		<div class="col-sm-10">
			<input type="text" name="time" id="time" class="form-control" placeholder="format: 8am - 11am"/>
		</div>
	</div>

	<div class="form-group row col-sm-12">
		<label class="col-sm-2" align="left">Location:</label>
		<div class="col-sm-10">
			<input type="text" name="location" id="location" class="form-control"/>
		</div>
	</div>

	<div class="form-group row col-sm-12">
		<label class="col-sm-2" align="left">Tags:</label>
		<div class="col-sm-10">
			<input type="text" name="tags" id="tag" class="form-control" placeholder="School, Work, Appointment"/>
		</div>
	</div>

	<div class="form-group row col-sm-12">
		<label class="col-sm-2" align="left">Notes:</label>
		<div class="col-sm-10">
			<textarea class="form-control" name="notes" rows="3" id="notes"></textarea>
		</div>
	</div>


	<div class="form-group row col-sm-12">
		<label class="col-sm-2" align="left">Share with:</label>
		<div class="col-sm-10">
			<textarea class="form-control" name="notes" rows="3" id="notes" placeholder="Enter emails separated by commas. ex: johndoe@gmail.com, janedoe@yahoo.com"></textarea>
		</div>
	</div>

	<div class="form-group row col-sm-12" align="center">
		<div class="col-sm-6">
			<button type="submit" id="create" align="center">Create</button>
		</div>
		<div class="col-sm-6">
			<button type="button" onclick=redirect() align="center">Close</button>
		</div>
	</div>


   </form>
</div>



<script>
	function redirect(){
      window.location='main_page.php';
    }
</script>




</body>
</html>
