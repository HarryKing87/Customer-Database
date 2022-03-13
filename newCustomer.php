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
        <h1>Insert a new customer</h1>
        
        <label for="id">Customer Id</label>
        <input type="text" name="id" id="id">
        
        
        <label for="name">Customer Name</label>
        <input type="text" name="name" id="name">
        
        
        <label for="age">Customer Age</label>
        <input type="number" name="age" id="age">
        
        
        <label for="address">Customer Address</label>
        <input type="text" name="address" id="address">
        
        
        <button type="submit">Submit</button>
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