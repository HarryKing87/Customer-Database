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
<div class="container">
            <li><a href="dashboard.php">Show Customers</a></li>
            <li><a href="newCustomer.php">Insert Customers</a></li>
            <li><a href="expenses.php">Customer Expenses</a></li>
            <li><a href="addExpenses.php">Add Expenses</a></li>
    </div>
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
echo "Here are the expenses of " . $_GET['name'] . " in this database";

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