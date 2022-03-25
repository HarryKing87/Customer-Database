<?php
$toBeFilteredUsername = $_POST['username'];
$toBeFilteredPassword = $_POST['password'];
$toBeFilteredMail = $_POST['mail'];
$cleanUsername = filter_var($toBeFilteredUsername, FILTER_SANITIZE_STRING);
$cleanPassword = filter_var($toBeFilteredPassword, FILTER_SANITIZE_STRING);
$cleanMail = filter_var($toBeFilteredMail, FILTER_SANITIZE_EMAIL);


// Check whether the wanted values are set or not. (Prevent form from submitting itself everytime the user reloads.)
if(isset($_POST['username']) && isset($_POST['mail']) && isset($_POST['password'])) {


class Users extends SQLite3 {
    function __construct() {
        $this->open("credentials.db");
    }
}
$database = new Users();
if (!$database) {
    echo $database->lastErrorMsg();
} else {
    echo "<span>Database opened successfully!</span>\n";
}


$sqlCommand = "INSERT INTO users (USERNAME,MAIL,PASSWORD) 
                VALUES ('".$cleanUsername."', '".$cleanMail."', '".$cleanPassword."');";


$result = $database->exec($sqlCommand);

if (!$result) {
    echo $database->lastErrorMsg();
} else {
    echo "<span>Registered successfully!</span>\n";
}

$database->close();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Smooch+Sans:wght@500&display=swap" rel="stylesheet">
<!--<link rel="stylesheet" href="Auth-CSS/register.css">-->
<title>Register | PHP Auth</title>
</head>
<body>
<div class="flex items-center justify-center min-h-screen bg-gray-100">
      <div
        class="px-8 py-4 mx-4 mt-4 text-left bg-white shadow-lg md:w-1/3 lg:w-1/3"
      >
        <h3 class="text-2xl font-bold text-center">Join us</h3>
        <form method="POST">
            <div class="mt-4">
                <div>
                    <label class="block" for="username">Username<label>
                            <input type="text" placeholder="Name"
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600" name="username" id="username">
                </div>
                <div class="mt-4">
                    <label class="block" for="mail">Email<label>
                            <input type="email" name="mail" id="mail" required placeholder="Email"
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="mt-4">
                    <label class="block" for="password">Password<label>
                            <input type="password" name="password" required placeholder="Password"
                                class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="flex">
                    <button type="submit" id="submitButton" class="w-full px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900">Create
                        Account</button>
                </div>
                <div class="mt-6 text-grey-dark">
                    Already have an account?
                    <a class="text-blue-600 hover:underline" href="http://localhost:8000/login.php">
                        Log in
                    </a>
                </div>
            </div>
        </form>
      </div>
    </div>
</body>
</html>