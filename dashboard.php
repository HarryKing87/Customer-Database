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
    <title>Document</title>
</head>
<body>
    <div class="container">
            <li><a href="dashboard.php">Show Customers</a></li>
            <li><a href="newCustomer.php">Insert Customers</a></li>
            <li><a href="expenses.php">Customer Expenses</a></li>
            <li><a href="addExpenses.php">Add Expenses</a></li>
            <li name="logout"><a href="logout.php">Logout</a></li>
    </div>
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
    echo "<table>
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
</body>

</html>