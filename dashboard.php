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
    <link rel="stylesheet" href="CSS/dashboard.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dashboard | Customer Expenses</title>
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


<div data-aos="fade-up" data-aos-duration="1500">
    <!--
    <button id="arrowDown">Sort Values</button>
    <form method="POST" id="sorting">
        <select name="order">
            <option value="nameASC">Ascending</option>
            <option value="nameDESC">Descending</option>
            <option value="idASC">By ID (ASC)</option>
            <option value="idDESC">By ID (DESC)</option>
            <option value="ageASC">By Age (ASC)</option>
            <option value="ageDESC">By Age (DESC)</option>
            <option value="addressASC">By Address (ASC)</option>
            <option value="addressDESC">By Address (DESC)</option>
        </select>
    <input type="submit" name="submit">
    </form>
-->
    <?php 
    echo $_POST["username"];
    class Users extends SQLite3 {
        function __construct() {
            $this->open("customers.db");
        }
    }
    
    $db = new Users();
    
    if (!$db) {
        echo "<main>$db->lastErrorMsg()</main>";
    } else {
        echo "\n";
    }
    
    // --- SORT ASC OR DESC
    if (isset($_POST['submit'])) {
        $selectedValue = $_POST['order'];
    }
    
    /*
    Name Ascending *
    Name Descending *
    ID Ascending
    ID Descending
    Age Ascending
    Age Descending
    Address Ascending
    Address Descending
    */
    /*
    if ($_POST['order'] == "nameASC") {
        $sql = "SELECT * FROM CUSTOMERS ORDER BY name ASC";
    }
    else if ($_POST['order'] == "nameDESC") {
        $sql = "SELECT * FROM CUSTOMERS ORDER BY name DESC";
    }
    else if ($_POST['order'] == "idASC") {
        $sql = "SELECT * FROM CUSTOMERS ORDER BY id ASC";
    }
    else if ($_POST['order'] == "idDESC") {
        $sql = "SELECT * FROM CUSTOMERS ORDER BY id DESC";
    }
    else if ($_POST['order'] == "ageASC") {
        $sql = "SELECT * FROM CUSTOMERS ORDER BY age ASC";
    }
    else if ($_POST['order'] == "ageDESC") {
        $sql = "SELECT * FROM CUSTOMERS ORDER BY age DESC";
    }
    else if ($_POST['order'] == "addressASC") {
        $sql = "SELECT * FROM CUSTOMERS ORDER BY address ASC";
    }
    else if ($_POST['order'] == "addressDESC") {
        $sql = "SELECT * FROM CUSTOMERS ORDER BY address DESC";
    } else {
        echo "Unknown Error!";
    }  
    */

    // --- END OF SORTING CODE
    $sql = "SELECT * FROM CUSTOMERS ORDER BY address ASC";
    $result = $db->query($sql);
    echo "<table class='table-auto'>
    <tr>
    <th>ID</th>
    <th>NAME</th>
    <th>AGE</th>
    <th>ADDRESS</th>";
    
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['ID'] . "</td>" ."\n";
        echo "<td>" . $row['NAME'] . "</td>" ."\n";
        echo "<td>" . $row['AGE'] . "</td>"  ."\n";
        echo "<td>" . $row['ADDRESS'] . "</td>"  ."\n";
        echo "</tr>";
    }
    echo "</table>";
    echo "<i>Database records have been shown</i>\n";
    $db->close();
    ?>

<script src="JS/script.js"></script>
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
</div>
</body>

</html>