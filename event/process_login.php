<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_management_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username,$password);

if ($stmt->execute()) {
    // echo "User added successfully";
     header("Location: event_management.html");
    exit();
} else {
	header("Location: login.html?error=1");
    
    echo "Error adding user: " . $stmt->error;
    exit();
}

$stmt->close();
$conn->close();
?>