<!DOCTYPE html>
<html>
  <head>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <meta charset="utf-8">
    <meta name="author" content="David Gray, Gracie Wright">
    <link rel="stylesheet" href="styles/style1.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>

  <body id = "body-style">
	<?php
		if (isset($_COOKIE['user']))
		{	
			require('connect-db.php');
			$query = "SELECT * FROM users WHERE user_ID =\"" . $_COOKIE['user'] . "\";";			
			$statement = $db->prepare($query);		
			$statement->execute();
			$results = $statement->fetch(PDO::FETCH_ASSOC);	
			$statement->closeCursor();
			$val = $results['style'];
			
			
	?>
  
    <h1 id="title">Settings</h1> <!-- Title of the page centered -->


    <table class="table table-borderless" align = "center">
      <!--The radio button group for the color options -->
      <tr><td align = "center">	  
		  <input type="radio" id="color1" name="color" value="1" onclick="changeColor()">
		  <label for="color1" id="label1">Default Color</label>		 
		  <input type="radio" id="color2" name="color" value="2" onclick="changeColor()">
		  <label for="color2" id="label2">Lavender Color</label>		  
		  <input type="radio" id="color3" name="color" value="3" onclick="changeColor()">
		  <label for="color3" id="label3">Blue Color</label> <br>
		  <button onclick = "Save()" name = "save" id = "save" class = "btn btn-primary" id="Save">Save</button>
		  <button onclick="Back()" name = "back" id = "back" class = "btn btn-primary" >Back</button>
      </td>
	  </tr>
    </table>



    <p id="valid" align = "center"></p>
  </body>

  <script>
	var selectedcol = <?php echo $val; ?>;
	console.log(selectedcol);
	if (selectedcol == "1"){
		document.body.style.backgroundColor = '#D3D3D3';
		document.getElementById("color1").checked = true;
	}
	if (selectedcol == "2"){
		document.body.style.backgroundColor = "#E6E6FA";
		document.getElementById("color2").checked = true;
	}
	if (selectedcol == "3"){
		document.body.style.backgroundColor = '#beeeef';
		document.getElementById("color3").checked = true;
	}	
	
	function Save(){
		var color1 = document.getElementById("color1").checked;
		var color2 = document.getElementById("color2").checked;
		var color3 = document.getElementById("color3").checked;
		if(color1){
			selectedcol = "1"; 
		}
		else if(color2){
			selectedcol = "2"; 
		}
		else if(color3){
			selectedcol = "3"; 
		}
		$.post("updatesettings.php", {col: selectedcol});
		
		window.location.reload();
			
	}
  
	function changeColor(){
      var color1 = document.getElementById("color1").checked;
      var color2 = document.getElementById("color2").checked;
      var color3 = document.getElementById("color3").checked; //Values of true or false for each radio button

      if(color1){
        document.body.style.backgroundColor = "#D3D3D3"; //Default gray
      }
      else if(color2){
        document.body.style.backgroundColor = "#E6E6FA"; //lavender
      }
      else if(color3){
        document.body.style.backgroundColor = "#beeeef"; //Light blue
      }
    }  
	
	function Back(){
		window.location='main_page.php';
		
	}
	
	
  </script>


</html>

  <?php
  }
  else   // not logged in yet
  {
     header('Location: login.php');
     exit;  // redirect to the login page
  }
  ?>
