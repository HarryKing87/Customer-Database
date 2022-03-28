<?php 

class COMPANY extends SQLite3 {
    function __construct() {
        $this->open("credentials.db");
    }
}

$database = new COMPANY();
if (!$database) {
    echo $database->lastErrorMsg();
} else {
    echo "Database opened successfully!\n";
}

// Below we create the exact SQL code to be taken directly from the database.
// Specifically, the variable $createTable will be executed directly from line 
// 29 with the exec() function

$createTable =<<<EOF
DELETE FROM USERS;
EOF;

$result = $database->exec($createTable);

// If the result doesn't exist or is false then it throws an error.

if (!$result) {
    echo $database->lastErrorMsg();
} else {
    echo "Database entry (Table) deleted successfully!\n";
}
$database->close();
?>