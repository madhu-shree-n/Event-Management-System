<!DOCTYPE html>
<html>
<head>
    <title>Venue Details</title>
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
            background-color: #e0f7fa;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333333;
            margin-bottom: 20px;
        }

        p {
            margin: 0;
            padding: 5px 0;
            color: #444444;
        }

        strong {
            color: #555555;
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
        <h2>Venue Details for Event</h2>

        <?php
        // Check if the form has been submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve the event ID from the form
            $event_id = $_POST["event_id"];

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

            // Prepare and execute the SQL query
            $sql = "SELECT * FROM venue WHERE event_id = '$event_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output venue details
                while($row = $result->fetch_assoc()) {
                    echo "<p><strong>Event ID:</strong> " . $row["event_id"] . "</p>";
                    echo "<p><strong>Venue Name:</strong> " . $row["name"] . "</p>";
                    echo "<p><strong>Location:</strong> " . $row["address"] . "</p>";
                    echo "<p><strong>Capacity:</strong> " . $row["capacity"] . "</p>";
                    // ... add more details as needed
                }
            } else {
                echo "<p class='error-message'>No venue details found for the specified event ID.</p>";
            }

            // Close the database connection
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
