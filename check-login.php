<?php
// Define the database connection parameters
$db_file = 'AdminPanLogDet1.accdb';
$db_user = '';
$db_pass = '';

// Create a new PDO instance to connect to the database
try {
    $pdo = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=$db_file;Uid=$db_user;Pwd=$db_pass;");
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

// Get the form data
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare a SQL query to select the user from the database
$stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username AND password = :password');
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->execute();

// Check if a user was found
if ($stmt->rowCount() > 0) {
    // Authentication successful
    session_start();
    $_SESSION['username'] = $username;
    header('Location: dashboard.php');
    exit;
} else {
    // Authentication failed
    echo 'Invalid username or password';
}

// Close the database connection
$pdo = null;
?>