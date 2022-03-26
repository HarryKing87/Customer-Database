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
							<a href="dashboard.php" class="py-4 px-2 text-green-500 border-b-4 border-green-500 font-semibold ">Home</a>
							<a href="newCustomer.php" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">Add Customer</a>
							<a href="expenses.php" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">Customer Expenses</a>
							<a href="addExpenses.php" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">Add Expenses</a>
						</div>
					</div>
					<!-- Secondary Navbar items -->
					<div class="hidden md:flex items-center space-x-3 " name = "logout">
						<a href="logout.php" class="py-2 px-2 font-medium text-white bg-green-500 rounded hover:bg-green-400 transition duration-300">Logout</a>
					</div>
					<!-- Mobile menu button -->
					<div class="md:hidden flex items-center">
						<button class="outline-none mobile-menu-button">
						<svg class=" w-6 h-6 text-black dark:text-white hover:text-green-500 "
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
					<li class="active"><a href="dashboard.php" class="block text-sm px-2 py-4 text-white bg-green-500 font-semibold">Home</a></li>
					<li><a href="newCustomer.php" class="block text-sm px-2 py-4 hover:bg-green-500 transition duration-300">Add Customer</a></li>
					<li><a href="expenses.php" class="block text-sm px-2 py-4 hover:bg-green-500 transition duration-300">Customer Expenses</a></li>
					<li><a href="addExpenses.php" class="block text-sm px-2 py-4 hover:bg-green-500 transition duration-300">Add Expenses</a></li>
					<li><a href="logout.php" class="block text-sm px-2 py-4 hover:bg-green-500 transition duration-300">Logout</a></li>
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
        <h1>Insert a new customer</h1>
        
        <label for="id">Customer Id</label>
        <input type="text" name="id" id="id">
        
        
        <label for="name">Customer Name</label>
        <input type="text" name="name" id="name">
        
        
        <label for="age">Customer Age</label>
        <input type="number" name="age" id="age">
        
        
        <label for="address">Customer Address</label>
        <input type="text" name="address" id="address">
        
        
        <button type="submit" class="my-4 border-2 rounded hover:bg-white">Submit</button>
    </form>

    <?php 
    if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['age']) && isset($_POST['address'])) {
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
       
        $insert ="INSERT INTO CUSTOMERS (ID, NAME, AGE, ADDRESS) VALUES ('".$_POST["id"]."', '".$_POST["name"]."', '".$_POST["age"]."','".$_POST["address"]."');";
        
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