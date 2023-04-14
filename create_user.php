<?php
// Set up database connection
$servername = "localhost"; 
$username = "admin";
$password = "l[nv844MLLbHpD9R";
$dbname = "DCS"; 
$pswd = "user123";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Hash the password using the default bcrypt algorithm
$hashedPassword = password_hash($pswd, PASSWORD_DEFAULT);
// Insert user details into "usrDetails" table
$sql1 = "INSERT INTO usrDetails (uName, fName, pWord, refCode) VALUES ('user', 'User', '$hashedPassword',uuid())";
if ($conn->query($sql1) === TRUE) {
  $last_id = $conn->insert_id;
  // Insert user type and activity into "usrTypeAct" table
  $sql2 = "INSERT INTO usrTypeAct (id, usrType, usrAct) VALUES ('$last_id', '1', '1')";
  if ($conn->query($sql2) === TRUE) {
    echo "User account created successfully";
  } else {
    echo "Error creating user account: " . $conn->error;
  }
} else {
  echo "Error creating user account: " . $conn->error;
}

// Close database connection
$conn->close();
?>