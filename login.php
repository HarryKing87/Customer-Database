<?php
session_start();
?> 
<?php

if (isset($_POST['login'])) {
  // DATABASE CONNECTION
  class Users extends SQLite3
   {
      function __construct()
      {
         $this->open('credentials.db');
      }
   }
   $db = new Users();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      //echo "Opened database successfully\n";
   }

   $sql ='SELECT * from USERS where USERNAME="'.$_POST["username"].'";';


   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC)){
      $username=$row["USERNAME"];
      $password=$row['PASSWORD'];
  }
    
   $db->close();

  if($username == $_POST["username"] && $_POST["password"] == $password) {

    echo "<script>window.open('http://localhost:8000/dashboard.php','_self')</script>";  
    $_SESSION['username']=$username;
 } 
else {
  echo "<script>alert('Wrong username or password')</script>";
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login | PHP Auth</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Smooch+Sans:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="Auth-CSS/login.css">
</head>
<body>

<div class="container">
  <form role="form" action="" method="post">
  <h1 style="margin-left: auto; margin-right:auto; margin-top: -5%; margin-bottom:1rem; font-family: 'Smooch Sans', sans-serif; color:white;">Login</h1>
    <div>
      <label for="username">Username:</label>
      <input type="text" id="username" placeholder="Enter Username" name="username">
    </div>
    <div>
      <label for="password">Password:</label>
      <input type="password" id="password" placeholder="Enter password" name="password">
    </div>   
    <button type="submit" name="login">Login</button>
  </form>
</div>

<p></p>

<div class="navigation">
  <button><a href="login.php">Login</a></button>
  <button><a href="register.php">Register</a></button>
</div>
<script>
    // XML POST request on window load
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            console.log(xhttp.responseText);
        }
    };
    xhttp.open('POST', "dashboard.php", true);
    xhttp.setRequestHeader('Content-Type', 'application/');
    xhttp.send();
</script>
</body>
</html>