<?php

  function selectData($user, $enteredPassword)
  {
    require('connect-db.php');
    require('cookie_giving.php');

    $query = "SELECT * FROM users WHERE user_ID = :user";
    $statement = $db->prepare($query);
    $statement->bindvalue(':user', $user);
    $statement->execute();

    $results = $statement->fetchAll();
    $statement->closeCursor();

    $password = "";
    foreach($results as $row){
      $password = $row['password'];
    }

    if($password == ""){
      echo "<script>alert('Account does not exist!');</script>";
    }
    else if($password == $enteredPassword){
      cookieTwenty($user, $enteredPassword);
      header("Location:main_page.php");
      exit;
    }
    else{
      echo "<script>alert('Wrong Password'); </script>";
    }
  }

?>
