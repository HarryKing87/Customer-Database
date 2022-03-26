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
    <title>Expenses | Customer Expenses</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        li a {
  padding-right: 1rem;
  color: white;
  text-decoration: none;
}
        table {
            margin:0 auto;
            padding:5px;
        }
td {
  border: 2px solid;
  padding:5px;
}
tr:nth-child(even) {
  background-color: #f2f2f2;
}
html {
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}
.container {
  display: flex;
  list-style-type: none;
  background: black;
  color: white;
  justify-content: space-evenly;
  padding: 10px;
  margin-bottom: 1rem;
  border-radius: 10px;
}
    </style>
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
</body>
</html>

<?php 

class Users extends SQLite3 {
    function __construct() {
        $this->open("customers.db");
    }
}

$db = new Users();

if (!$db) {
    echo $db->lastErrorMsg();
} else {
    echo "";
}


$sql = "SELECT * FROM CUSTOMERS";

$result = $db->query($sql);
echo "<table class='table-auto'>
<tr>
<th>Name</th>

";
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo "<tr>";
    echo "<td><a href='customerExpenses.php?name=$row[NAME]'>" . $row['NAME'] . "</a></td>";
    echo "</tr>";
}
echo "</table>";
$db->close();
?>