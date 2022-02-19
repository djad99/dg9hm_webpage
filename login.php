<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="author" content="David Gray, Gracie Wright">
    <link rel="stylesheet" href="styles/style1.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>

  <body id = "body-style">
    <h1 id="title"> Welcome to Schedulemaster</h1>
    <!--Login code below taken from the login page given in class resources-->
    <table class="table table-borderless" align = "center">
      <tr>
        <td width="30%" align=></td>
        <td><form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">Username:<input type="text" name="username" id="username" class="form-control"/></td>
      </tr>
      <tr>
        <td width="30%" align="right"></td>
        <td><form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">Password:<input type="password" name="password" id="password" class="form-control" value="" />
        </td>
      </tr>
      <tr>
        <td colspan=2 align="center">
          <button onclick = "CheckLogin()"  name="submit" id = "submit" class = "btn btn-primary">Submit</button>
        </td>
      </tr>
      </table>

      <table class="table table-borderless" align = "center">
      <tr>
        <td align="center" name="userpass" id="userpass"><label"userpass">New User?</label>
        </td>
      </tr>
      <tr>
        <td colspan=2 align="center">
          <button name = "reg" id = "reg" class = "btn btn-primary">Register</button>
        </td>
      </tr>
    </table>

    <?php session_start();    // make sessions available
    // Session data are accessible from an implicit $_SESSION global array variable
    // after a call is made to the session_start() function.
    ?>

    <p id="valid" align = "center"></p>
  </body>
  <script>

  CheckLogin = () =>{ //Arrow Function to check login

    let getName = function (){ //anonymous function to get username
      name = document.getElementById("username").value;
    }();

    let getPass = function (){ //anonymous function to get password
      pass = document.getElementById("password").value;
    }();



  if(name==""){
    alert("Please enter a username");
  }
  else if(pass==""){
    alert("Please enter a password");
  }


}
  </script>

<?php
  require("login_verification.php");

    if(isSet($_POST['submit'])){
      if(!empty($_POST['username']) && !empty($_POST['password'])){

        $user = $_POST['username'];
        $enteredPassword = $_POST['password'];

        selectData($user, $enteredPassword);

      }
    }

    if(isSet($_POST['reg'])){
      header("Location:registration.php");
      exit;
    }
 ?>
</html>
