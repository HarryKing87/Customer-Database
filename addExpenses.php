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
</head>
<body>
<div class="container">
            <li><a href="dashboard.php">Show Customers</a></li>
            <li><a href="newCustomer.php">Insert Customers</a></li>
            <li><a href="expenses.php">Customer Expenses</a></li>
            <li><a href="addExpenses.php">Add Expenses</a></li>
    </div>
    <form action="" method="POST">
        <h1>Insert new customer expenses</h1>
        
        <label for="name">Customer Name</label>
        <select name="name" id="name"><?php require('Admin/showSelector.php');?></select>
        
        <label for="expenses">Customer Expenses</label>
        <input type="number" name="expenses" id="expenses">
        
        
        <button type="submit">Submit</button>
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