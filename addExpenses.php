<?php  
session_start();  

if(!$_SESSION['username'])  
{  
    header("Location: http://localhost:8000/login.php");//redirect to the login page to secure the welcome page without login access.  
}  
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Customer</title>
    <link rel="stylesheet" href="CSS/newCustomer.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<nav class="bg-black-500 shadow-lg dark:bg-gray-800">
			<div class="max-w-6xl mx-auto px-4">
				<div class="flex justify-between">
					<div class="flex space-x-7">
						<div>
							<!-- Website Logo -->
							<a href="dashboard.php" class="flex items-center py-4 px-2">
								<span class="font-semibold text-lg  text-black dark:text-white">Customer Expenses</span>
							</a>
						</div>
						<!-- Primary Navbar items -->
						<div class="hidden md:flex items-center space-x-1">
							<a href="dashboard.php" class="py-4 px-2 text-gray-500 border-green-500 font-semibold ">Home</a>
							<a href="newCustomer.php" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">Add Customer</a>
							<a href="expenses.php" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">Customer Expenses</a>
							<a href="addExpenses.php" class="py-4 px-2  text-green-500 border-b-4 font-semibold hover:text-green-500 transition duration-300">Add Expenses</a>
						</div>
					</div>
					<!-- Secondary Navbar items -->
					<div class="hidden md:flex items-center space-x-3 " name = "logout">
						<a href="logout.php" class="py-2 px-2 font-medium text-white bg-green-500 rounded hover:bg-green-400 transition duration-300">Logout</a>
					</div>
					<!-- Mobile menu button -->
					<div class="md:hidden flex items-center">
						<button class="outline-none mobile-menu-button">
						<svg class=" w-6 h-6 text-black dark:text-white hover:text-indigo-500  "
							x-show="!showMenu"
							fill="none"
							stroke-linecap="round"
							stroke-linejoin="round"
							stroke-width="2"
							viewBox="0 0 24 24"
							stroke="currentColor"
						>
							<path d="M4 6h16M4 12h16M4 18h16"></path>
						</svg>
					</button>
					</div>
				</div>
			</div>
			<!-- mobile menu -->
			<div class="hidden mobile-menu">
				<ul class="">
					<li class="active"><a href="dashboard.php" class="block text-sm px-2 py-4 text-white bg-indigo-500 font-semibold dark:text-white">Home</a></li>
					<li><a href="newCustomer.php" class="block text-sm px-2 py-4 hover:bg-indigo-500 transition duration-300 dark:text-white">Add Customer</a></li>
					<li><a href="expenses.php" class="block text-sm px-2 py-4 hover:bg-indigo-500 transition duration-300 dark:text-white">Customer Expenses</a></li>
					<li><a href="addExpenses.php" class="block text-sm px-2 py-4 hover:bg-indigo-500 transition duration-300 dark:text-white">Add Expenses</a></li>
					<li><a href="logout.php" class="block text-sm px-2 py-4 hover:bg-indigo-500 transition duration-300 dark:text-white">Logout</a></li>
                </ul>
			</div>
			<script>
				const btn = document.querySelector("button.mobile-menu-button");
				const menu = document.querySelector(".mobile-menu");

				btn.addEventListener("click", () => {
					menu.classList.toggle("hidden");
				});
			</script>
		</nav>
    <form action="" method="POST">
        <h1>Insert new customer expenses</h1>
        
        <label for="name">Customer Name</label>
        <select name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><?php require('Admin/showSelector.php');?></select>
        
        <label for="expenses">Customer Expenses</label>
        <input type="number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" class="block py-2.5 px-0 w-full text-sm text-gray-900 border-0 border-b-2 border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" name="expenses" id="expenses">
        
        
        <button type="submit" class="my-4 border-2 rounded hover:bg-white">Submit</button>
    </form>

    <?php 
    if(isset($_POST['name']) && isset($_POST['expenses'])) {
        class COMPANY extends SQLite3 {
            function __construct() {
                $this->open('customers.db');
            }
        }
        
        $database = new COMPANY();
    
        if (!$database) {
            echo $database->lastErrorMsg();
        } else {
            echo "Database accessed!\n";
        }
       
        $insert ="INSERT INTO CUSTOMER_FINANCES (NAME, EXPENSES) VALUES ('".$_POST["name"]."', '".$_POST["expenses"]."');";
        
        $result = $database->exec($insert);
    
        if(!$result) {
            $error = $database->lastErrorMsg();
            echo "<b>$error</b>";
        } else {
            echo "Records added successfully!\n";
        }
        $database->close();
    }
    
    
    
    ?>
   
</body>
</html>