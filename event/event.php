<!DOCTYPE html>
<html>
<head>
    <title>Event Management</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #002244; /* Set background color to blue */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #B9D9EB;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 80%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            margin: 0 0 30px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-weight: bold;
            color: #555;
            margin-bottom: 15px;
        }

        .search-bar {
            position: relative;
            width: 100%;
            margin: 10px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        input[type="text"] {
            padding: 12px;
            border: none;
            border-radius: 25px;
            width: 100%;
            outline: none;
            background-color: transparent;
            transition: box-shadow 0.3s;
        }

        .search-icon {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            display: block;
            width: 24px;
            height: 24px;
            opacity: 0.5;
            transition: opacity 0.3s;
        }

        input[type="text"]:focus {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        input[type="text"]:not(:placeholder-shown) + .search-icon {
            opacity: 0;
        }

        input[type="submit"] {
            background-color:   #696969;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 14px 24px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 30px;
        }

        .button-container form {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Event Management</h2>

        <div class="button-container">
            <form action="get_event_details.php" method="post">
                <label for="event_id">Retrieve Event Details by ID</label>
                <div class="search-bar">
                    <input type="text" name="event_id" id="event_id" placeholder="Search Event ID">
                    <img class="search-icon" src="search_icon.png" alt="Search Icon">
                </div>
                <input type="submit" value="Retrieve">
            </form>

            <form action="get_events_customers.php" method="post">
                <label>Events and Customers</label>
                <input type="submit" value="Retrieve">
            </form>

            <form action="get_overbooked_events.php" method="post">
                <label>Overbooked Events and Managers</label>
                <input type="submit" value="Retrieve">
            </form>

             
    <form action="stored_procedure.php" method="post">
    	<label for="event_id">Event Details</label>
       <div class="search-bar">
                    <input type="text" name="event_id" id="event_id" placeholder="Search Event ID">
                    <img class="search-icon" src="search_icon.png" alt="Search Icon">
                </div>
        <input type="submit" value="Get Details">
    </form>

    <?php
    if(isset($_POST['event_id'])) {
        $event_id = $_POST['event_id'];
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "event_management_system";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "CALL GetEventDetails($event_id)";
$result = $conn->multi_query($sql);
if ($result) {
            do {
                if ($res = $conn->store_result()) {
                    while ($row = $res->fetch_assoc()) {
                        // Display the results here
                        // You can format and display each row as needed
                        print_r($row);
                    }
                    $res->free();
                }
            } while ($conn->more_results() && $conn->next_result());
        } else {
            echo "Error: " . $conn->error;
        }

        $conn->close();
    }
    ?>
            
    <form action="add_event.php" method="post">
        <label for="event_name">Event Name:</label>
        <div class="search-bar">
                    <input type="text" name="event_name" id="event_name" placeholder="Search Event Name">
                    <img class="search-icon" src="search_icon.png" alt="Search Icon">
                </div>

        <!-- Add other input fields, including manager_id -->

        <label for="manager_id">Manager ID:</label>
        <div class="search-bar">
                    <input type="text" name="manager_id" id="manager_id" placeholder="Search Manager ID">
                    <img class="search-icon" src="search_icon.png" alt="Search Icon">
                </div>

        <input type="submit" value="Add Event">
    </form>
        </div>
    </div>

</body>
</html>
