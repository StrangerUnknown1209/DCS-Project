<?php
session_start(); // Start the PHP session to store user information

// Database configuration
$dbHost     = 'localhost';
$dbUsername = 'admin';
$dbPassword = 'l[nv844MLLbHpD9R';
$dbName     = 'DCS';

// Create a database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the username and password from the login form
$username = $_POST['username'];
$password = $_POST['password'];

// Hash the password using the default bcrypt algorithm
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Prepare the SQL statement to check if the user exists in the database
$sql = "SELECT * FROM usrDetails WHERE uName = '$username'";
$result = $conn->query($sql);

// Check if the user exists
if ($result->num_rows == 1) {
    // Fetch the user data from the result set
    $row = $result->fetch_assoc();
    
    // Verify the password hash
    if (password_verify($password, $row['pWord']))
     {
        // Check if the user is active
        $userId = $row['id'];
        $sql = "SELECT * FROM usrTypeAct WHERE id = $userId";
        $result = $conn->query($sql);
        
        // Fetch the user type and activation status from the result set
        $row = $result->fetch_assoc();
        $userType = $row['usrType'];
        $userActive = $row['usrAct'];
        
        // Check if the user is active
        if ($userActive == 0) {
            // Show a message and redirect to the login page
            echo "Contact the admin to activate your account";
            header("refresh:2;url=login.php");
        } else {
            // Store the user data in the PHP session
            $_SESSION['userId'] = $userId;
            $_SESSION['userType'] = $userType;
            
            // Redirect the user to the appropriate page
            if ($userType == 0) {
                // Admin user
                header("Location: admin.php");
            } else {
                // Normal user
                header("Location: user.php");
            }
        }
    } else {
        // Show an error message and redirect to the login page
        echo "Invalid password";
        header("refresh:2;url=login.php");
    }
} else {
    // Show an error message and redirect to the login page
    echo "Invalid username";
    header("refresh:2;url=login.php");
}

// Close the database connection
$conn->close();
?>
