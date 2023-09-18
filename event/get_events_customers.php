<!DOCTYPE html>
<html>
<head>
    <title>Events and Customers</title>
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
        }

        h2 {
            text-align: center;
            color: #333333;
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
            border-top: 1px solid #333333;
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
        <h2>Events and Customers</h2>

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

        $sql = "SELECT events.*, customer.* FROM events
                INNER JOIN customer ON events.event_id = customer.event_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='event-details'>Event ID: " . $row["event_id"] . "</div>";
                echo "<div class='event-details'>Event Name: " . $row["event_name"] . "</div>";
                echo "<div class='event-details'>Customer ID: " . $row["customer_id"] . "</div>";
                echo "<div class='event-details'>Customer Name: " . $row["customer_name"] . "</div>";
                // Add more fields as needed
                echo "<hr>";
            }
        } else {
            echo "<div class='no-events'>No events found.</div>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
