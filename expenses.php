<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<div class="container">
            <li><a href="dashboard.php">Show Customers</a></li>
            <li><a href="newCustomer.php">Insert Customers</a></li>
            <li><a href="expenses.php">Customer Expenses</a></li>
            <li><a href="addExpenses.php">Add Expenses</a></li>
    </div>
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
echo "<table>
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