<?php 
session_start();

class Users extends SQLite3 {
    function __construct() {
        $this->open("customers.db");
    }
}

$db = new Users();

if (!$db) {
    echo $db->lastErrorMsg();
} else {
    echo "Database created successfully.\n";
}


$sql = "SELECT * FROM CUSTOMER_FINANCES";

$result = $db->query($sql);

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo "ID = " . $row['ID'] ."\n";
    echo "NAME = ". $row['NAME'] ."\n";
    echo "AGE = ". $row['AGE'] ."\n";
    echo "ADDRESS = " . $row['ADDRESS'] ."\n";
    echo "----------------------------------------------------------------\n";
}
echo "Database records have been shown\n";
$db->close();
?>