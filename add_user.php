<?php
// Set up database connection
$servername = "localhost"; 
$username = "admin"; 
$password = "l[nv844MLLbHpD9R"; //NEED TO CHANGE THIS PASWORD!!!
$dbname = "DCS"; 
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get values from form
$uName = $_POST['uName'];
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$age = $_POST['age'];
$mob = $_POST['mob'];
$amt =$_POST['amtIn'];

// Generate password
$pWord = substr($fName, 0, 4) . substr($mob, -4);
$hashedPassword= password_hash($pWord, PASSWORD_DEFAULT);
// Insert user details into "usrDetails" table
$sql1 = "INSERT INTO usrDetails (uName, fName, lName, age, mob, pWord, refCode) 
         VALUES ('$uName', '$fName', '$lName', '$age', '$mob', '$hashedPassword', uuid())";
if ($conn->query($sql1) === TRUE) {
  $last_id = $conn->insert_id;
  $sql2 = "INSERT INTO usrTypeAct (id, usrType, usrAct) VALUES ('$last_id', '1', '1')";
  if ($conn->query($sql2) === TRUE) {
    $last_id=$conn->insert_id;
    $sql3="INSERT INTO usrPay (id,amtIn, dateIn, amtOut, dateOut, txnStat) VALUES ('$last_id','amtIn', 'amtOut','dateIn','dateOut',txnStat')";
    if ($conn->query($sql3) === TRUE) {
        echo "user create sucessfully!";
    }
    else{
        echo "user create failed! ". $conn->error;
    }
}
else{
    echo "Error creating user account: " . $conn->error;
}
} else {
  echo "Error creating user account: " . $conn->error;
}

// Close database connection
$conn->close();
?>