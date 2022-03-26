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
    echo "";
}


$sql = "SELECT * FROM CUSTOMERS";

$result = $db->query($sql);

while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo "<option>". $row['NAME'] ."</option>";
}
echo "";
$db->close();
?>