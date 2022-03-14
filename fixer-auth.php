<?php 
session_start();

class Users extends SQLite3 {
    function __construct() {
        $this->open("credentials.db");
    }
}

$db = new Users();

if (!$db) {
    echo $db->lastErrorMsg();
} else {
    echo "Database created successfully.\n";
}


$sql = "DELETE FROM USERS WHERE USERNAME = ''";

$result = $db->query($sql);

if (!$result) {
    echo $db->errorMsg();
} else {
    echo "Fix OK!\n";
}
$db->close();
?>