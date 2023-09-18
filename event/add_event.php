<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_management_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$event_name = $_POST['event_name'];
$manager_id = $_POST['manager_id']; // Get manager_id from form

// Add other event details to be inserted

$sql = "INSERT INTO events (event_name, manager_id) VALUES ('$event_name', '$manager_id')";

if ($conn->query($sql) === TRUE) {
    // Update no_of_events in manager table using the trigger
    // Note: The trigger will be automatically executed after the insert
    echo "Event added successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
