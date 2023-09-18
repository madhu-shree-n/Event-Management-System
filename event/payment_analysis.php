<!DOCTYPE html>
<html>
<head>
    <title>Payment Analysis Results</title>
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
            word-wrap: break-word; /* Allow text to wrap within cells */
            max-width: 200px;
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
        <h2>Payment Analysis Results</h2>
        
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

        // Query to analyze payments by payment mode
        $query = "SELECT payment_mode, SUM(total_amount) AS total_payments
                  FROM payment
                  GROUP BY payment_mode";

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Payment Mode</th><th>Total Payments</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["payment_mode"] . "</td><td>" . $row["total_payments"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<div class='error-message'>No payment analysis results available.</div>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
