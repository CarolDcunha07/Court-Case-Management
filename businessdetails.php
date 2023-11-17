<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="businessdetails.css"> <!-- Include the CSS file -->
    <title>Business Details</title>
</head>

<body>
    <div id="header">
        <h1>Business Details</h1>
    </div>
    <?php
    // Check if the business_date is set in the URL
    if (isset($_GET["business_date"])) {
        // Retrieve business_date from the URL parameter
        $businessDate = $_GET["business_date"];

        // Connect to your database (replace with your database credentials)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "login_sample_db1";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch details for the business_date
        $sqlDetails = "SELECT * FROM case_history WHERE business_date = '$businessDate'";
        $resultDetails = $conn->query($sqlDetails);

        // Display details in a table format
        if ($resultDetails->num_rows > 0) {
            echo "<h2>Business Details</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Judge</th><th>Hearing Date</th><th>Purpose of Hearing</th></tr>";
            while ($rowDetails = $resultDetails->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $rowDetails["judge"] . "</td>";
                echo "<td>" . $rowDetails["hearing_date"] . "</td>";
                echo "<td>" . $rowDetails["purpose_of_hearing"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";

            // Close button with JavaScript to go back
            echo "<button id='closeModalButton' onclick='goBack()'>Close</button>";
        } else {
            echo "<p>No details found for the business date.</p>";
        }

        $conn->close();
    } else {
        echo "<p>No business date provided.</p>";
    }
    ?>

    <footer>
        <p>&copy; 2023 Court System. All rights reserved.</p>
    </footer>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>
