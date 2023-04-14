<?php
//dropping database DCS (TEST PURPOSES ONLY){
    $db_name = "DCS";
    $conn = new mysqli("localhost", "admin", "l[nv844MLLbHpD9R");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "DROP DATABASE $db_name";
    if ($conn->query($sql) === TRUE) {
        echo "Database dropped successfully";
    } else {
        echo "Error dropping database: " . $conn->error;
        return;
    }
    $conn->close();
//End of dropping database
?>