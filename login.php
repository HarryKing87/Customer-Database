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

    echo "<script>window.open('https://customer-finder-php.herokuapp.com/dashboard.php','_self')</script>";  
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
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="Auth-CSS/spinner.css">
  <link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Smooch+Sans:wght@500&display=swap" rel="stylesheet">
<!--<link rel="stylesheet" href="Auth-CSS/login.css">-->

</head>
<body>
<div
      class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8"
    >
      <div class="max-w-md w-full space-y-8">
<div>
  <img src="front-page.svg" width="50%" style="margin:0 auto;"></img>
          <h1 class="mt-6 text-center text-3xl font-extrabold text-indigo-500">Customer Finder</h1>
          <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Sign in to your account
          </h2>
          <p class="mt-2 text-center text-sm text-gray-600">
            Or
            <a
              href="register.php"
              class="font-medium text-indigo-600 hover:text-indigo-500"
            >
              register here
            </a>
          </p>
        </div>
  <form role="form" action="" method="post">
  <h1 style="margin-left: auto; margin-right:auto; margin-top: -5%; margin-bottom:2rem; font-family: 'Smooch Sans', sans-serif; color:white; text-align:center;">Login</h1>
    <div>
              <label for="username" class="font-bold">Email address</label>
              <input
                id="username"
                name="username"
                type="text"
                required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                placeholder="Username"
              />
            </div>

    <div>
              <label for="password" class="font-bold">Password</label>
              <input
                id="password"
                name="password"
                type="password"
                required
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                placeholder="Password"
              />
            </div>
            <button
              type="submit"
              name = "login"
              class="group relative w-full flex justify-center my-2 py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              id="loadButton"
              >
              <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <!-- Heroicon name: solid/lock-closed -->
                <svg
                  class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  aria-hidden="true"
                >
                  <path
                    fill-rule="evenodd"
                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                    clip-rule="evenodd"
                  />
                </svg>
              </span>
              Sign in
            </button>
  </form>
</div>
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