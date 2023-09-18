<!DOCTYPE html>
<html>
<head>
    <title>Overbooked Events</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #002244; /* Webpage background color */
            margin: 0;
            padding: 0;
            color: #ffffff;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #e0f7fa; /* Box background color */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #002244; /* Box border color */
        }

        h2 {
            text-align: center;
            color: #002244; /* Line color */
            margin-bottom: 20px;
        }

        .event-details {
            font-size: 18px;
            color: #333333;
            margin-bottom: 10px;
        }

        hr {
            margin-top: 20px;
            border: none;
            border-top: 1px solid #002244; /* Line color */
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
        <h2>Overbooked Events</h2>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "event_management_system";
        // Replace with your database connection code
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT events.*, venue.capacity, manager.manager_name
                FROM events
                INNER JOIN venue ON events.event_id = venue.event_id
                INNER JOIN manager ON events.event_id = manager.event_id
                WHERE events.no_of_invitees > venue.capacity";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='event-details'>";
            while ($row = $result->fetch_assoc()) {
                echo "<div>Event ID: " . $row["event_id"] . "</div>";
                echo "<div>Event Name: " . $row["event_name"] . "</div>";
                echo "<div>Exceeded Capacity: " . $row["no_of_invitees"] . " > " . $row["capacity"] . "</div>";
                echo "<div>Manager: " . $row["manager_name"] . "</div>";
                // Add more fields as needed
                echo "<hr>";
            }
            echo "</div>";
        } else {
            echo "<div class='no-events'>No overbooked events found.</div>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
