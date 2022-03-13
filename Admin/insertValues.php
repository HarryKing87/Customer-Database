<?php 
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

$insert =<<<EOF
    INSERT INTO CUSTOMER_FINANCES (NAME, EXPENSES)
    VALUES ('Lazaros Kapoukranidis', 425);

    INSERT INTO CUSTOMER_FINANCES (NAME, EXPENSES)
    VALUES ('Lazaros Kapoukranidis', 555);
EOF;

$result = $database->exec($insert);
if(!$result) {
    echo $database->lastErrorMsg();
} else {
    echo "Records added successfully!\n";
}
$database->close();
?>