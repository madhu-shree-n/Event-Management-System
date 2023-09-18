<!DOCTYPE html>
<html>
<head>
    <title>Event and Venue Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #002244;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background-color: #e0f7fa;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            
            border-bottom: 1px solid #333333;
        }

        th {
            background-color: #64b5f6;
            font-weight: bold;
        }

        .no-events {
            text-align: center;
            color: #ff0000;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Event and Venue Details</h2>
        
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

        // Query to retrieve event, venue, and customer details
        $query = "SELECT
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
                    events e
                INNER JOIN
                    venue v ON e.event_id = v.event_id
                INNER JOIN
                    customer c ON e.event_id = c.event_id
                ORDER BY
                    e.event_date";

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Event ID</th><th>Event Name</th><th>Location</th><th>Event Date</th><th>Venue Name</th><th>Venue Address</th><th>Customer ID</th><th>Customer Name</th><th>Customer Phone</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["event_id"] . "</td>";
                echo "<td>" . $row["event_name"] . "</td>";
                echo "<td>" . $row["location"] . "</td>";
                echo "<td>" . $row["event_date"] . "</td>";
                echo "<td>" . $row["venue_name"] . "</td>";
                echo "<td>" . $row["venue_address"] . "</td>";
                echo "<td>" . $row["customer_id"] . "</td>";
                echo "<td>" . $row["customer_name"] . "</td>";
                echo "<td>" . $row["customer_phone"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<div class='no-events'>No event and venue details available.</div>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
