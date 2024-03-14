<?php
require_once 'config.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Query the database for the user
$stmt = $db->prepare("SELECT * FROM Users WHERE Username = :username");
$stmt->bindParam(':username', $username);
$stmt->execute();
$user = $stmt->fetch();

// Check if the user exists and the password is correct
if ($user && password_verify($password, $user['Password'])) {
    // Redirect to the admin panel
    header('Location: AdminPanel.html');
} else {
    // Display an error message
    echo "Invalid username or password";
}
?>