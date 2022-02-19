<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="author" content="David Gray, Gracie Wright">

    <link rel="stylesheet" href="styles/style1.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>

  <body id = "body-style">
    <h1 id="title">Create a new account</h1>

    <table class="table table-borderless" align = "center">
      <!--Input values for username, email, password, and confirm password-->
      <tr>
        <td width="30%" align="right"></td>
        <td><form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">Username:<input type="text" name="username" id="username" class="form-control"/></td>
      </tr>
      <tr>
        <td width="30%" align="right"></td>
        <td><form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">Email:<input type="email" name="Email" id="email" class="form-control"/></td>
      </tr>
      <tr>
        <td width="30%" align="right"></td>
        <td><form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">Password:<input type="password" name="password" id="password" class="form-control" value="" />
        </td>
      </tr>
      <tr>
        <td width="30%" align="right"></td>
        <td><form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">Confirm Password:<input type="password" name="confirm" id="confirm" class="form-control" value="" />
        </td>
      </tr>
      <!--  <tr id="cofm_row" style="visibility:hidden">
        <td width="40%" align="right"><label>Confirm password: </label></td>
        <td><input type="text"  name="cofm_password" value="" />
        </td>
      </tr> -->
      <tr>
        <td colspan=2 align="center">
          <button onclick = "Register()" name = "register" id = "register" class = "btn btn-primary">Register</button>

          <button onclick = "Back()" name = "back" id="back" class = "btn btn-primary">Back</button>
        </td>
      </tr>
      </table>




  </body>

  <script>

  function ValidateEmail(mail) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)){  //Code adapted from https://www.w3resource.com/javascript/form/email-validation.php, so we could validate email addresses properly.
      return (true)
    }else{
      return (false)
    }
  }

    function Register(){
      var pass = document.getElementById("password").value;
      var conf = document.getElementById("confirm").value;
      var user = document.getElementById("username").value;
      var email = document.getElementById("email").value;



      if(user == ""){
        alert("Please enter a username"); //Empty Username
      }
      else if(email == ""){
        alert("Please enter an email"); // Empty email
      }
      else if(!ValidateEmail(email)){
        alert("Please enter a valid email"); //Improper email format
      }
      else if(pass == ""){
        alert("Please enter a password"); //Empty password
      }
      else if(conf != pass){
        alert("Passwords do not match"); //Non matching passwords
      }
    }


  </script>

  <?php
    require('new_account.php');
    if(isSet($_GET['register'])) { //Only gets the data after the register button is hit
      if(!empty($_GET['username']) &&
      !empty($_GET['Email']) && !empty($_GET['password']) &&
      ($_GET['password'] == $_GET['confirm']) &&
      filter_var($_GET['Email'], FILTER_VALIDATE_EMAIL)){
      //This conditional was to validate ALL the data through this before adding something to the database
        $user = $_GET['username'];
        $email = $_GET['Email'];
        $password = $_GET['password'];
        
        newUser($user, $email, $password);
      }
    }

    if(isSet($_GET['back'])) {
      header("Location:login.php");
      exit;
    }
  ?>
</html>
