<?php
// Set up database connection
$servername = "localhost"; 
$username = "admin";
$password = "l[nv844MLLbHpD9R";
$dbname = "DCS"; 
$pswd = "admin123";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Hash the password using the default bcrypt algorithm
$hashedPassword = password_hash($pswd, PASSWORD_DEFAULT);
// Insert user details into "usrDetails" table
$sql1 = "INSERT INTO usrDetails (uName, fName, pWord) VALUES ('admin', 'Admin', '$hashedPassword')";
if ($conn->query($sql1) === TRUE) {
  $last_id = $conn->insert_id;
  // Insert user type and activity into "usrTypeAct" table
  $sql2 = "INSERT INTO usrTypeAct (id, usrType, usrAct) VALUES ('$last_id', '0', '1')";
  if ($conn->query($sql2) === TRUE) {
    echo "Admin account created successfully";
  } else {
    echo "Error creating admin account: " . $conn->error;
  }
} else {
  echo "Error creating admin account: " . $conn->error;
}

// Close database connection
$conn->close();
?>