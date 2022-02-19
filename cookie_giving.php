<?php
  function cookieTwenty($user, $password){
    setcookie('user', $user, time()+1200);

    setcookie('pwd', md5($password), time()+1200);
    //FOR PHP 5.5, REPLACE MD5 WITH A PROPER NOT BROKEN SINCE 2005 HASH
  }
  ?>
