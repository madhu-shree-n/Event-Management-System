<!DOCTYPE html>
<html>
<head>
    <title>Event Details</title>
</head>
<body>
    <h2>Event Details</h2>

<?php
// Create a database connection (adjust these values according to your database configuration)
 $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "event_management_system";
        // Replace with your database connection code
        $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Perform the SQL query
$sql = "SELECT
            e.event_id,
            e.event_name,
            e.location,
            e.event_date,
            v.name AS venue_name,
            v.address AS venue_address,
            c.customer_id,
            c.customer_name,
            c.phone_number AS customer_phone
        FROM
            event e
        INNER JOIN
            venue v ON e.event_id = v.event_id
        INNER JOIN
            customer c ON e.event_id = c.event_id
        ORDER BY
            e.event_date";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<p><strong>Event ID:</strong> " . $row["event_id"] . "</p>";
        echo "<p><strong>Event Name:</strong> " . $row["event_name"] . "</p>";
        echo "<p><strong>Location:</strong> " . $row["location"] . "</p>";
        echo "<p><strong>Event Date:</strong> " . $row["event_date"] . "</p>";
        echo "<p><strong>Venue Name:</strong> " . $row["venue_name"] . "</p>";
        echo "<p><strong>Venue Address:</strong> " . $row["venue_address"] . "</p>";
        echo "<p><strong>Customer ID:</strong> " . $row["customer_id"] . "</p>";
        echo "<p><strong>Customer Name:</strong> " . $row["customer_name"] . "</p>";
        echo "<p><strong>Customer Phone:</strong> " . $row["customer_phone"] . "</p>";
        echo "----------------------------------<br>";
    }
} else {
    echo "No event details found.";
}

// Close the database connection
$conn->close();
?>
</body>
</html>
