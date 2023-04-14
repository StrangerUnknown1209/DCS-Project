<?php


// Set database credentials
$host = "localhost";
$username = "admin";
$password = "l[nv844MLLbHpD9R";
$database = "DCS";

//create initial connection
$conn = new mysqli($host, $username, $password);
//Connection check
if ($conn->connect_error) {
    echo "<br>connection failed to database host</br>";
    die("Connection failed: " . $conn->connect_error);
}
echo " <br>Connected successfully <br>";

// SQL query to show all databases
$query = "SHOW DATABASES";

// Execute the query
$result = mysqli_query($conn, $query);

//loop through results and check for database
$found = false;
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['Database'] == $database) {
        $found = true;
        break;
    }
    else
    continue;
}
//checking database presence
if ($found) {
    echo "<br>Database $database exists<br>";
} else {
    echo "<br>Database $database does not exist<br> Creating database...<br>";
    $query = "CREATE DATABASE $database";

// Execute the query
    if (mysqli_query($conn, $query)) {
        echo "<br>Database $database created successfully<br>";
    }
    else {
        echo "<br>Error creating database: <br>" . mysqli_error($conn);
    }
}
mysqli_close($conn);





// Create database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<br>Connected successfully<br>";


//checking and creating (if needed) table usrDetails
$table_name = "usrDetails";
$query = "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = '$database' AND table_name = '$table_name'";
$result = mysqli_query($conn, $query);



// Check if the table exists
if (mysqli_fetch_array($result)[0] > 0) {
    echo "Table $table_name exists in $database<br>";
} else {
    echo "<br>creating table $table_name<br>";
    $query = "CREATE TABLE $table_name (id INT(10) AUTO_INCREMENT PRIMARY KEY, uName VARCHAR(10) NOT NULL UNIQUE, pWord VARCHAR(255), fName VARCHAR(30) NOT NULL, lName VARCHAR(30) NOT NULL, mob INT(10) NOT NULL, age INT(3) NOT NULL, refCode VARCHAR(10) UNIQUE NOT NULL, refdCode VARCHAR(10), email VARCHAR(50), regDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

// Execute the query
    if (mysqli_query($conn, $query)) {
        echo "<br>Table $table_name created successfully<br>";
    }
    else {
        echo "<br>Error creating table:<br>" . mysqli_error($conn);
    }
}




//checking and creating (if needed) table usrPay
$table_name = "usrPay";
$query = "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = '$database' AND table_name = '$table_name'";
$result = mysqli_query($conn, $query);



// Check if the table exists
if (mysqli_fetch_array($result)[0] > 0) {
    echo "<br>Table $table_name exists in $database<br>";
} else {
    echo "<br>creating table $table_name <br>";
    $query = "CREATE TABLE $table_name (id INT(10) NOT NULL AUTO_INCREMENT, amtIn DECIMAL(10,2) NOT NULL, dateIn date not null, amtOut DECIMAL(10.2) NOT NULL, dateOut date not null, txnStat VARCHAR(20) NOT NULL, primary key (id), foreign key (id) References usrDetails(id))ENGINE=InnoDB";
// Execute the query
    if (mysqli_query($conn, $query)) {
        echo "<br> Table $table_name created successfully<br>";
    }
    else {
        echo "<br>Error creating table:<br>" . mysqli_error($conn);
    }
}



//checking and creating (if needed) table usrTypeAct
$table_name = "usrTypeAct";
$query = "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = '$database' AND table_name = '$table_name'";
$result = mysqli_query($conn, $query);



// Check if the table exists
if (mysqli_fetch_array($result)[0] > 0) {
    echo "<br>Table $table_name exists in $database<br>";
} else {
    echo "<br>creating table $table_name <br>";
    $query = "CREATE TABLE $table_name (id INT(10) NOT NULL AUTO_INCREMENT,usrType boolean NOT NULL, usrAct boolean NOT NULL, primary key (id), foreign key (id) References usrDetails(id))ENGINE=InnoDB";
// Execute the query
    if (mysqli_query($conn, $query)) {
        echo "<br> Table $table_name created successfully<br>";
    }
    else {
        echo "<br>Error creating table:<br>" . mysqli_error($conn);
    }
}
?>
