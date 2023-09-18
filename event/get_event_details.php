<!DOCTYPE html>
<html>
<head>
    <title>Event Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #002244;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #e0f7fa; /* Light blue background color */
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
        }

        th {
            background-color: #64b5f6; /* Blue header background color */
            color: #ffffff;
        }

        tr:nth-child(even) {
            background-color: #e1f5fe; /* Alternate row background color */
        }

        .error-message {
            text-align: center;
            color: #ff0000;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Event Details</h2>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "event_management_system";
        $event_id = $_POST['event_id'];

        // Replace with your database connection code
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM events WHERE event_id = '$event_id'";
        $result = $conn->query($sql);
        if (!$result) {
            die("Query failed: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Field</th><th>Value</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>Event ID:</td><td>" . $row["event_id"] . "</td></tr>";
                echo "<tr><td>Event Name:</td><td>" . $row["event_name"] . "</td></tr>";
                // Add more fields as needed
            }
            echo "</table>";
        } else {
            echo "<div class='error-message'>Event not found.</div>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
