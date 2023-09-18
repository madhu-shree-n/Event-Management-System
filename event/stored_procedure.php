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

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            padding: 10px;
            background-color: #e1f5fe; /* Alternate row background color */
            margin-bottom: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        strong {
            color: #64b5f6; /* Blue header text color */
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
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "event_management_system";

        if(isset($_POST['event_id'])) {
            $event_id = $_POST['event_id'];

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "CALL GetEventDetails($event_id)";
            $result = $conn->multi_query($sql);

            if ($result) {
                echo "<h3>Event Details:</h3>";
                do {
                    if ($res = $conn->store_result()) {
                        echo "<ul>";
                        while ($row = $res->fetch_assoc()) {
                            echo "<li>";
                            // Display the results here
                            // You can format and display each row as needed
                            foreach ($row as $key => $value) {
                                echo "<strong>$key:</strong> $value<br>";
                            }
                            echo "</li>";
                        }
                        echo "</ul>";
                        $res->free();
                    }
                } while ($conn->more_results() && $conn->next_result());
            } else {
                echo "<div class='error-message'>Error: " . $conn->error . "</div>";
            }

            $conn->close();
        } else {
            echo "<div class='error-message'>Event ID not provided.</div>";
        }
        ?>
    </div>
</body>
</html>
