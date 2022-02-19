<!DOCTYPE html>
<html>
<head>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <meta charset="UTF-8">
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <title>Schedulemaster</title>
  <link rel="stylesheet" href="styles/style1.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


  <style>
	td{
		height: 85px;
		vertical-align: top;
		white-space: pre-wrap;
	}
	table, tr, td{
		border: 1px solid black;
	}
  </style>

</head>

<?php
	require('connect-db.php');

	if (isset($_COOKIE['user']))
	{

		$query = "SELECT * FROM users WHERE user_ID =\"" . $_COOKIE['user'] . "\";";
		$statement = $db->prepare($query);
		$statement->execute();
		$results = $statement->fetch(PDO::FETCH_ASSOC);
		$val = $results['style'];
		$statement->closeCursor()

	?>
<body onload="loadCal();" id="body-style">
	<header>
		<div class="row" id="head">
	        <div class="col-md-2" align="center">
				<input type="button" value="Settings" onclick = "Settings()">
			</div>

			<div class="col-md-8" align="center">
				<h2> Schedule for <?php echo $_COOKIE['user']; ?> </h2>
			</div>

			<div class="col-md-2" align="center">
				<input type="button" value="Log Out" onclick = "LogOut()">
			</div>
		</div>
	</header>

	<div class="row">
		<div class="col-md-4" align="center">
			<button disabled="true" href="#" align="left" id="previous" class="previous" onclick="updateCalBack()">&#8249; Previous</a>
			<button href="#" class="next" id="next" onclick="updateCalForward()">Next &#8250;</a>
		</div>
		<div class="col-md-4" align="center">
			  <input type="text" id="search" placeholder="Search.." name="search">
			  <button onclick="searchEvents()">Submit</button>
		</div>
		<?php
			if(isset($_COOKIE['success'])){
				if($_COOKIE['success'] != ""){
					echo $_COOKIE['success'];
				}
				setcookie('success', "", time() - 3600);
			}
		?>

	</div>


	<div class="row" id="aboveCal">

		<table id="calendar" align="center" style="width: 90%; align: center; border: 2px solid black">
			<tr align="center">
				<td id="cell0"></td>
				<td id="cell1"></td>
				<td id="cell2"></td>
				<td id="cell3"></td>
				<td id="cell4"></td>
				<td id="cell5"></td>
				<td id="cell6"></td>

			</tr>

			<tr align="center">
				<td id="cell7"></td>
				<td id="cell8"></td>
				<td id="cell9"></td>
				<td id="cell10"></td>
				<td id="cell11"></td>
				<td id="cell12"></td>
				<td id="cell13"></td>

			</tr>

			<tr align="center">
				<td id="cell14"></td>
				<td id="cell15"></td>
				<td id="cell16"></td>
				<td id="cell17"></td>
				<td id="cell18"></td>
				<td id="cell19"></td>
				<td id="cell20"></td>

			</tr>

			<tr align="center">
				<td id="cell21"></td>
				<td id="cell22"></td>
				<td id="cell23"></td>
				<td id="cell24"></td>
				<td id="cell25"></td>
				<td id="cell26"></td>
				<td id="cell27"></td>

			</tr>

			<tr align="center">
				<td id="cell28"></td>
				<td id="cell29"></td>
				<td id="cell30"></td>
				<td id="cell31"></td>
				<td id="cell32"></td>
				<td id="cell33"></td>
				<td id="cell34"></td>
			</tr>
		</table>
	</div>

	<div class="row">
		<div class="col-sm-6" align="center">
			<button type="button" onclick="location.href = 'add_event2.php'" align="center" >Add Event</button>


		</div>


	</div>



<!-- MODALS -->

	<!-- ADDEVENT MODAL -->


	<!-- ADD EVENT MODAL CODE -->


	<!-- VIEWDETAILS MODAL -->
	<div class="modal fade" name="viewDetails" id="viewDetails" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h3>Event</h3>
				</div>

				<div class="modal-body">
					<div class="form-group row">
						<label class="col-sm-2" align="left">Event Title:*</label>
						<div class="col-sm-10">
							<input disabled="true" type="text" name="event" id="event2" class="form-control" />
							<span id="msg_event"></span>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2" align="left">Date:*</label>
						<div class="col-sm-10">
						<select disabled name="month" id="month2" class="col-sm-3">
						  <option>Month</option>
						  <option>Jan</option>
						  <option>Feb</option>
						  <option>Mar</option>
						  <option>Apr</option>
						  <option>May</option>
						  <option>Jun</option>
						  <option>Jul</option>
						  <option selected>Aug</option>
						  <option>Sep</option>
						  <option>Oct</option>
						  <option>Nov</option>
						  <option>Dec</option>
						</select>

						<select disabled name="day" id="day2" class="col-sm-2">
						  <option>Day</option>
						  <option selected>1</option>
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

						<select disabled name="year" id="year2" class="col-sm-3">
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

						<span id="msg_date"></span>
						</div>

					</div>

					<div class="form-group row">
						<label class="col-sm-2" align="left">Time:</label>
						<div class="col-sm-10">
							<input disabled type="text" name="time" id="time2" class="form-control"/>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2" align="left">Location:</label>
						<div class="col-sm-10">
							<input disabled type="text" name="location" id="location2" class="form-control"/>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2" align="left">Tags:</label>
						<div class="col-sm-10">
							<input disabled type="text" name="tag" id="tag2" class="form-control"/>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2" align="left">Notes:</label>
						<div class="col-sm-10">
							<textarea disabled class="form-control" rows="5" id="notes2" name="notes"></textarea>
						</div>
					</div>

					<div class="form-group row" align="center">
						<div class="col-sm-4">
							<button id="edit" onclick="enable()" align="center">Edit</button>
						</div>
						<div class="col-sm-4">
							<button id="delete" onclick="confirmDel()" align="center">Delete</button>
						</div>
						<div class="col-sm-4">
							<button type="button" data-dismiss="modal" onclick="refresh()" align="center">Close</button>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>




	<?php

      //connect
      require('connect-db.php');

      //write query
      $query = "CREATE TABLE events(summary INT PRIMARY KEY,user VARCHAR(255),event VARCHAR(255),  month VARCHAR(255),day INT,year INT,time VARCHAR(255),location VARCHAR(255),tags VARCHAR(255),  notes VARCHAR(511)";

      // prepare the query, get statement instance
      $statement = $db->prepare($query);

      //run the query
      $statement->execute();

      //release this cursor
      $statement->closeCursor();


		$user = $_COOKIE['user'];
		$query = "SELECT * FROM events";
		$statement = $db->prepare($query);
		$statement->execute();
		$results = $statement->fetchAll();
		$statement->closeCursor();
		$button = array();
		foreach ($results as $row)
		{
			$value = array($row['user'], $row['event'], $row['month'], $row['day'], $row['year'], $row['time'], $row['location'], $row['tags'], $row['notes']);
			$key = $row['summary'];
			$button[$key] = $value;
		}
		//print_r("<script> events =" . $button . "</script>");
		$injson = json_encode($button);
		file_put_contents("data.json", $injson);
	?>

<!-- SCRIPT -->


<script >
	var selectedcol = <?php echo $val; ?>;
	console.log(selectedcol);
	if (selectedcol == "1"){
		document.body.style.backgroundColor = '#D3D3D3';
	}
	if (selectedcol == "2"){
		document.body.style.backgroundColor = '#E6E6FA';
	}
	if (selectedcol == "3"){
		document.body.style.backgroundColor = '#beeeef';
	}

	var events = <?php echo $injson ?>;
	var button_key = null;

	function searchEvents(){
		var searchResults = {};
		console.log(document.getElementById("search").value);
		var keyword = document.getElementById("search").value;
		for(var i=0; i < Object.keys(events).length; i++){
			//console.log(Object.keys(events)[i].toString());
			//console.log(keyword.toString());

			if(Object.keys(events)[i].toString().indexOf(keyword.toString()) != -1){
				searchResults[Object.keys(events)[i]] = Object.values(events)[i];
			}
			else{
				console.log(Object.values(events)[i]);
				console.log(Object.values(events)[i][0]);
				for(var j=0; j < Object.values(events)[i].length; j++){
					if((Object.values(events)[i][j].indexOf(keyword.toString())) != -1){
						searchResults[Object.keys(events)[i]] = Object.values(events)[i];
					}
				}
			}
		}
		console.log(searchResults);
	}

	function confirmDel(){
		if(confirm("Are you sure you want to delete this event?")){
			$.post("delete.php", {
				pk: button_key,
				event: document.getElementById("event2").value,
				month: document.getElementById("month2").value,
				day: document.getElementById("day2").value,
				year: document.getElementById("year2").value,
				time: document.getElementById("time2").value,
				location: document.getElementById("location2").value,
				tag: document.getElementById("tag2").value,
				notes: document.getElementById("notes2").value
			});
			window.location='main_page.php';
		}


	}


	function refresh(){
		window.location='main_page.php';

	}

	function loadEvents(){
		var user = "<?php echo $_COOKIE['user']; ?>";
		console.log(user);
		console.log(Object.entries(events));
		d = new Date();
		for(var i=0; i < Object.keys(events).length; i++){
			k = Object.values(events)[i];
			console.log(k[0] == user);
			if((k[4] == d.getFullYear().toString()) && (k[0] == user)){
				addToSchedule(Object.keys(events)[i], k);
			}
		}
	}


	var startingDate = null;
	<!-- document.getElementById("create").addEventListener("click", checkInput); -->



	function updateCalBack(){
		var week = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
		var month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
  		var i = 0;
  		var day = startingDate;
		var dayOfWeek = parseInt(day.getDay());
		day.setDate(day.getDate()-dayOfWeek-70);
  		while (i < document.getElementById("calendar").rows.length) {
  			document.getElementById("calendar").rows[i].cells[0].innerHTML = week[0] + " " + month[day.getMonth()] + " " + day.getDate().toString();
  			day.setDate(day.getDate()+1);
  			document.getElementById("calendar").rows[i].cells[1].innerHTML = week[1] + " " + month[day.getMonth()] + " " + day.getDate().toString();
  			day.setDate(day.getDate()+1);
  			document.getElementById("calendar").rows[i].cells[2].innerHTML = week[2] + " " + month[day.getMonth()] + " " + day.getDate().toString();
  			day.setDate(day.getDate()+1);
  			document.getElementById("calendar").rows[i].cells[3].innerHTML = week[3] + " " + month[day.getMonth()] + " " + day.getDate().toString();
  			day.setDate(day.getDate()+1);
  			document.getElementById("calendar").rows[i].cells[4].innerHTML = week[4] + " " + month[day.getMonth()] + " " + day.getDate().toString();
  			day.setDate(day.getDate()+1);
  			document.getElementById("calendar").rows[i].cells[5].innerHTML = week[5] + " " + month[day.getMonth()] + " " + day.getDate().toString();
  			day.setDate(day.getDate()+1);
  			document.getElementById("calendar").rows[i].cells[6].innerHTML = week[6] + " " + month[day.getMonth()] + " " + day.getDate().toString();
  			day.setDate(day.getDate()+1);
  			i++;
  		}
		startingDate = day;
		console.log(startingDate);
		loadEvents();


		/*for(k = 0; k < Object.values(events).length; k++){
			for(l = 0; l < Object.values(events)[k].length; l++){
				console.log(Object.values(events));
				console.log(Object.values(events)[k].length);
				console.log(Object.values(events)[k][l]);

				var compare = Object.values(events)[k][l][1] + " " + Object.values(events)[k][l][2];
				console.log(Object.values(events)[k].length);
				var i=0;
				while (i < 5) {
					var j = 0;
					while(j < 7){
						if(document.getElementById("calendar").rows[i].cells[j].innerHTML.toString().substring(4).localeCompare(compare.toString()) == 0){
							for(m = 0; m < Object.values(events)[k].length; m++){
								console.log(Object.values(events)[k][l].length);
								console.log(i);
								console.log(j);
								document.getElementById("calendar").rows[i].cells[j].innerHTML += "<br>";
								var newbtn = document.createElement("Button");
								newbtn.innerHTML = Object.values(events)[k][l][0];
								newbtn.style = "border: none;"
								newbtn.class = "btn btn-link";
								newbtn.type = "button";
								newbtn.onclick = viewDetails;
								document.getElementById("calendar").rows[i].cells[j].appendChild(newbtn);
								l++;
								}

						}
						j++;
					}
					i++;
				}
	}
	}*/
		if(startingDate.getFullYear == 2021){
			document.getElementById("next").disabled = true;
		}
		else{
			document.getElementById("next").disabled = false;
		}

		var current = new Date();
		var dayOfWeek = parseInt(current.getDay());
		console.log(dayOfWeek);
		current.setDate(current.getDate() - dayOfWeek + 35);
		console.log(current.toLocaleDateString());
		console.log(startingDate.toLocaleDateString());
		if(startingDate.toLocaleDateString().localeCompare(current.toLocaleDateString()) == 0){
			document.getElementById("previous").disabled = true;
			document.getElementById("calendar").rows[0].cells[d.getDay()].style.background = "lightblue";
		}
	}

	function updateCalForward(){
		var week = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
		var month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
  		var i = 0;
  		var day = startingDate;
		var dayOfWeek = parseInt(day.getDay());
		day.setDate(day.getDate()-dayOfWeek);
  		while (i < document.getElementById("calendar").rows.length) {
  			document.getElementById("calendar").rows[i].cells[0].innerHTML = week[0] + " " + month[day.getMonth()] + " " + day.getDate().toString();
  			day.setDate(day.getDate()+1);
  			document.getElementById("calendar").rows[i].cells[1].innerHTML = week[1] + " " + month[day.getMonth()] + " " + day.getDate().toString();
  			day.setDate(day.getDate()+1);
  			document.getElementById("calendar").rows[i].cells[2].innerHTML = week[2] + " " + month[day.getMonth()] + " " + day.getDate().toString();
  			day.setDate(day.getDate()+1);
  			document.getElementById("calendar").rows[i].cells[3].innerHTML = week[3] + " " + month[day.getMonth()] + " " + day.getDate().toString();
  			day.setDate(day.getDate()+1);
  			document.getElementById("calendar").rows[i].cells[4].innerHTML = week[4] + " " + month[day.getMonth()] + " " + day.getDate().toString();
  			day.setDate(day.getDate()+1);
  			document.getElementById("calendar").rows[i].cells[5].innerHTML = week[5] + " " + month[day.getMonth()] + " " + day.getDate().toString();
  			day.setDate(day.getDate()+1);
  			document.getElementById("calendar").rows[i].cells[6].innerHTML = week[6] + " " + month[day.getMonth()] + " " + day.getDate().toString();
  			day.setDate(day.getDate()+1);
  			i++;
  		}
		startingDate = day;
		console.log(startingDate);
		loadEvents();
		/*for(k = 0; k < Object.values(events).length; k++){
			for(l = 0; l < Object.values(events)[k].length; l++){
				console.log(Object.values(events));
				console.log(Object.values(events)[k].length);
				console.log(Object.values(events)[k][l]);

				var compare = Object.values(events)[k][l][1] + " " + Object.values(events)[k][l][2];
				console.log(Object.values(events)[k].length);
				var i=0;
				while (i < 5) {
					var j = 0;
					while(j < 7){
						if(document.getElementById("calendar").rows[i].cells[j].innerHTML.toString().substring(4).localeCompare(compare.toString()) == 0){
							for(m = 0; m < Object.values(events)[k].length; m++){
								console.log(Object.values(events)[k][l].length);
								console.log(i);
								console.log(j);
								document.getElementById("calendar").rows[i].cells[j].innerHTML += "<br>";
								var newbtn = document.createElement("Button");
								newbtn.innerHTML = Object.values(events)[k][l][0];
								newbtn.style = "border: none;"
								newbtn.class = "btn btn-link";
								newbtn.type = "button";
								newbtn.onclick = viewDetails;
								document.getElementById("calendar").rows[i].cells[j].appendChild(newbtn);
								l++;
								}

						}
						j++;
					}
					i++;
				}
	}
	}*/
		if(startingDate.getFullYear() == 2021){
			document.getElementById("next").disabled = true;

		}
		d = new Date();
		document.getElementById("previous").disabled = false;
		document.getElementById("calendar").rows[0].cells[d.getDay()].style.background = "white";



	}

	function enable(){
		if(document.getElementById("event2").disabled == true){
			$("#viewDetails").modal("show");
			document.getElementById("event2").disabled = false;
			document.getElementById("month2").disabled = false;
			document.getElementById("day2").disabled = false;
			document.getElementById("year2").disabled = false;
			document.getElementById("time2").disabled = false;
			document.getElementById("location2").disabled = false;
			document.getElementById("tag2").disabled = false;
			document.getElementById("notes2").disabled = false;
			document.getElementById("edit").innerHTML = "Save";
		}
		else {
			if(checkInput() == true){
			document.getElementById("event2").disabled = true;
			document.getElementById("month2").disabled = true;
			document.getElementById("day2").disabled = true;
			document.getElementById("year2").disabled = true;
			document.getElementById("time2").disabled = true;
			document.getElementById("location2").disabled = true;
			document.getElementById("tag2").disabled = true;
			document.getElementById("notes2").disabled = true;
			document.getElementById("edit").innerHTML = "Edit";
			$.post("change.php", {
				pk: button_key,
				event: document.getElementById("event2").value,
				month: document.getElementById("month2").value,
				day: document.getElementById("day2").value,
				year: document.getElementById("year2").value,
				time: document.getElementById("time2").value,
				location: document.getElementById("location2").value,
				tag: document.getElementById("tag2").value,
				notes: document.getElementById("notes2").value
			});
			loadEvents();
			}
			//console.log(document.getElementById("event2").value);


		}

	}

	function resetVals(){
		document.getElementById("event").value = "";
		document.getElementById("month").value = "Month";
		document.getElementById("day").value = "Day";
		document.getElementById("year").value = "Year";
		document.getElementById("time").value = "";
		document.getElementById("location").value = "";
		document.getElementById("tag").value = "";
		document.getElementById("notes").value = "";
		$("#addEvent").modal("hide");
	}


	function viewDetails(){
		//console.log("viewing details");
		/*if(isset($_COOKIE['id'])){
			setcookie("id", this.id);
		}*/
		$("#viewDetails").modal("show");
		primarykey = this.id;
		button_key = this.id;
		console.log(button_key);
		$row = events[primarykey];
		document.getElementById("event2").value = $row[1];
		document.getElementById("month2").value = $row[2];
		document.getElementById("day2").value = $row[3];
		document.getElementById("year2").value = $row[4];
		if(document.getElementById("time2").value != null){
			document.getElementById("time2").value = $row[5];
		}
		if(document.getElementById("location2").value != null){
			document.getElementById("location2").value = $row[6];
		}
		if(document.getElementById("tag2").value != null){
			document.getElementById("tag2").value = $row[7];
		}
		if(document.getElementById("notes2").value != null){
			document.getElementById("notes2").value = $row[8];
		}
	}


	function addToSchedule(keyid, value){
		console.log("in add to schedule");
		console.log(keyid);
		console.log(value);
		console.log(document.getElementById("calendar").rows[0].cells[0].innerHTML);
		var compare = value[2] + " " + value[3];
		var i=0;
		var added = false;
		while (i < 5) {
			var j = 0;
			while(j < 7){
				console.log((document.getElementById("calendar").rows[i].cells[j].innerHTML.toString().substring(4).indexOf(compare.toString()) != -1));
				console.log(document.getElementById("calendar").rows[i].cells[j].innerHTML.toString().substring(4));
				console.log(compare);
				if((document.getElementById("calendar").rows[i].cells[j].innerHTML.toString().substring(4).indexOf(compare.toString()) != -1) && (document.getElementById("calendar").rows[i].cells[j].innerHTML.toString().substring(4).length == compare.toString().length)){
					//console.log(i);
					//console.log(j);
					var newbtn = document.createElement("Button");
					newbtn.innerHTML = value[1];
					newbtn.style = "border: none;"
					newbtn.class = "btn btn-link";
					newbtn.type = "button";
					newbtn.id = keyid;
					newbtn.onclick = viewDetails;
					document.getElementById("calendar").rows[i].cells[j].appendChild(document.createElement("br"));
					document.getElementById("calendar").rows[i].cells[j].appendChild(newbtn);


					added = true;
					//console.log(added);
					break;
				}
					if(added == true){
						break;
						}
				j++;
			}
			if(added == true){ break; }
  			i++;
  		}
	}


	function checkInput(){
		var okay_name = false;
		var okay_date = true;
		var event = document.getElementById("event2");
		if (event.value.length <= 0){
			document.getElementById("msg_event").innerHTML = "Please enter the name of the event.";
		} else{
			document.getElementById("msg_event").innerHTML = "";
			okay_name = true;
		}

		if((document.getElementById("day2").value == "Day") || (document.getElementById("year2").value == "Year") || (document.getElementById("month2").value == "Month")){
			document.getElementById("msg_date").innerHTML = "Please enter a valid date.";
			okay_date = false;
		}

		var day = parseInt(document.getElementById("day2").value);
		var month = document.getElementById("month2").value;
		var year = parseInt(document.getElementById("year2").value);

		if(month == "Jan"){
			month = 0;
		}
		if(month == "Feb"){
			month = 1;
			if(((year % 4) == 0) && (day > 29)){
				document.getElementById("msg_date").innerHTML = "Please enter a valid date.";
				okay_date = false;
			}
			if(((year % 4) != 0) && (day > 28)){
				document.getElementById("msg_date").innerHTML = "Please enter a valid date.";
				okay_date = false;
			}
		}

		if(month == "Mar"){
			month = 2;
		}
		if(month == "Apr"){
			month = 3;
			if(day > 30){
				document.getElementById("msg_date").innerHTML = "Please enter a valid date.";
				okay_date = false;
			}
		}
		if(month == "May"){
			month = 4;
		}
		if(month == "Jun"){
			month = 5;
			if(day > 30){
				document.getElementById("msg_date").innerHTML = "Please enter a valid date.";
				okay_date = false;
			}
		}
		if(month == "Jul"){
			month = 6;
		}
		if(month == "Aug"){
			month = 7;
		}
		if(month == "Sep"){
			month = 8;
			if(day > 30){
				document.getElementById("msg_date").innerHTML = "Please enter a valid date.";
				okay_date = false;
			}
		}
		if(month == "Oct"){
			month = 9;
		}
		if(month == "Nov"){
			month = 10;
			if(day > 30){
				document.getElementById("msg_date").innerHTML = "Please enter a valid date.";
				okay_date = false;
			}
		}
		if(month == "Dec"){
			month = 11;
		}

		var date = new Date();

		if((month <= parseInt(date.getMonth())) && (year <= parseInt(date.getFullYear())) && (day < parseInt(date.getDate()))){
			document.getElementById("msg_date").innerHTML = "Please enter a valid date.";
			okay_date = false;
		}

		if(okay_date == true){
			document.getElementById("msg_date").innerHTML = "";
		}

		if(okay_date && okay_name){
			var val = [document.getElementById("event2").value, document.getElementById("month2").value, document.getElementById("day2").value,
			document.getElementById("year2").value, document.getElementById("time2").value, document.getElementById("location2").value, document.getElementById("tag2").value,
			document.getElementById("notes2").value];
			var key = document.getElementById("month2").value.toString() + " " + parseInt(document.getElementById("day2").value).toString() + " " + document.getElementById("year2").value.toString();

			$("#viewDetails").modal("show");
			return true;
			//addToSchedule(key, val);
		}
		return false;
	}


    function LogOut(){
      window.location='login.php';
    }

    function Settings(){
      window.location='settings.php';
    }

    function loadCal(){
  		var week = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
		var month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
  		var i = 0;
  		var day = new Date();
  		var num = day.getDate();
		var mon = day.getMonth();
		var dayOfWeek = parseInt(day.getDay());

		day.setDate(day.getDate()-dayOfWeek);
  		while (i < document.getElementById("calendar").rows.length) {
  			document.getElementById("calendar").rows[i].cells[0].innerHTML = week[0] + " " + month[day.getMonth()] + " " + day.getDate().toString();
  			day.setDate(day.getDate()+1);
  			document.getElementById("calendar").rows[i].cells[1].innerHTML = week[1] + " " + month[day.getMonth()] + " " + day.getDate().toString();
  			day.setDate(day.getDate()+1);
  			document.getElementById("calendar").rows[i].cells[2].innerHTML = week[2] + " " + month[day.getMonth()] + " " + day.getDate().toString();
  			day.setDate(day.getDate()+1);
  			document.getElementById("calendar").rows[i].cells[3].innerHTML = week[3] + " " + month[day.getMonth()] + " " + day.getDate().toString();
  			day.setDate(day.getDate()+1);
  			document.getElementById("calendar").rows[i].cells[4].innerHTML = week[4] + " " + month[day.getMonth()] + " " + day.getDate().toString();
  			day.setDate(day.getDate()+1);
  			document.getElementById("calendar").rows[i].cells[5].innerHTML = week[5] + " " + month[day.getMonth()] + " " + day.getDate().toString();
  			day.setDate(day.getDate()+1);
  			document.getElementById("calendar").rows[i].cells[6].innerHTML = week[6] + " " + month[day.getMonth()] + " " + day.getDate().toString();
  			day.setDate(day.getDate()+1);
  			i++;
  		}
		document.getElementById("calendar").rows[0].cells[dayOfWeek].style.background = "lightblue";
		console.log(document.getElementById("calendar").rows[0].cells[0].innerHTML);
		startingDate = day;
		//console.log(startingDate);
		loadEvents();

  	}
	</script>
  <!-- CDN for JS bootstrap -->
  <!--<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <?php
  }
  else   // not logged in yet
  {
     header('Location: login.php');
     exit;  // redirect to the login page
  }
  ?>




</body>
</html>
