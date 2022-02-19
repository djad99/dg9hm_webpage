<?php

function newUser($user, $email, $password){
  createTable();
  if(!selectData($user) && !selectDataEmail($email)){
    //Only insert if the username and email are available
    require("email.php");
    require('cookie_giving.php');
    insertData($user, $email, $password);
    cookieTwenty($user, $enteredPassword);
    header("Location:main_page.php");
    newAccountMail($user, $email);
    exit;
  }
  else if(selectDataEmail($email)){
    echo "<script>alert('Email has already been taken!');</script>";
  }
  else{
    echo "<script>alert('Username has already been taken!');</script>";
  }
}

function createTable()
{

  //connect
  require('connect-db.php');

  //write query
  $query = "CREATE TABLE users(
    user_ID VARCHAR(255) PRIMARY KEY,
    email VARCHAR(255),
    password VARCHAR(255),
    style INT)";

  // prepare the query, get statement instance
  $statement = $db->prepare($query);

  //run the query
  $statement->execute();

  //release this cursor
  $statement->closeCursor();

}
?>


<?php
/*************************/
/** insert data **/
function insertData($user, $email, $pass)
{
  require('connect-db.php');

  $query = "INSERT INTO users (user_ID, email, password, style) VALUES (:user, :email, :password, 1)";

  $statement = $db->prepare($query);
  $statement->bindvalue(':user', $user);
  $statement->bindvalue(':email', $email);
  $statement->bindvalue(':password', $pass);

  $statement->execute();
  $statement->closeCursor();





}
?>

<?php
/*************************/
/** get data **/
function selectData($user)
{
  require('connect-db.php');

  $query = "SELECT * FROM users WHERE user_ID = :user";
  $statement = $db->prepare($query);
  $statement->bindvalue(':user', $user);
  $statement->execute();

  $results = $statement->fetchAll();
  $statement->closeCursor();

  $i = sizeof($results);
  if($i>0){
    return true;
  }
return false;
}

function selectDataEmail($email){
  require('connect-db.php');

  $query = "SELECT * FROM users WHERE email = :email";
  $statement = $db->prepare($query);
  $statement->bindvalue(':email', $email);
  $statement->execute();

  $results = $statement->fetchAll();
  $statement->closeCursor();

  $i = sizeof($results);
  if($i>0){
    return true;
  }
return false;
}
?>
