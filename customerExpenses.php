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
    <link rel="stylesheet" href="CSS/newCustomer.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
    <style>
      body {
        background-image:none;
      }
        table {
  border: 2px solid black;
  width: 50%;
  margin: 1rem auto;
  border-collapse: collapse;
}
th {
  text-align: left;
  background: lightgreen;
}
table,
th,
td {
  border: 2px solid;
}
tr:nth-child(even) {
  background-color: #f2f2f2;
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
</body>
</html>
<?php 
class Welcome extends SQLite3 {
    function __construct() {
        $this->open("customers.db");
    }
}

$db = new Welcome();

if (!$db) {
    echo $db->lastErrorMsg();
} else {
    echo "";
}

$variable = $_GET['name'];
$sql = "SELECT * FROM `CUSTOMER_FINANCES` WHERE `NAME` LIKE '%{$variable}%'";

$result = $db->query($sql);
echo "Welcome, " . $_GET['name'] . "!\n";
echo "<br>";
echo "Here are the expenses of " . $_GET['name'] . " in this database.";

echo "<table>
<tr>
<th>Name</th>
<th>Expense</th>";
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row['NAME'] . "</td>" ."\n";
    echo "<td>" . $row['EXPENSES'] . "</td>"  ."\n";
    echo "</tr>";
}
echo "</table>";
$db->close();
?>