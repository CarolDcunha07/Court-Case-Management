<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="casedetails.css"> <!-- Include the CSS file -->
    <title>Case Details</title>
</head>

<body>
    <div id="header">
        <h1>Case Details</h1>
    </div>
    <?php
    // Check if the case_number is set in the URL
    if (isset($_GET["case_number"])) {
        // Retrieve case_number from the URL parameter
        $caseNumber = $_GET["case_number"];

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

        // Fetch detailed case information
        $sqlDetails = "SELECT * FROM cases WHERE case_number = '$caseNumber'";
        $resultDetails = $conn->query($sqlDetails);

        // Display detailed case information in a table format
        if ($resultDetails->num_rows > 0) {
            $rowDetails = $resultDetails->fetch_assoc();
            echo "<h2>Case Details</h2>"; // Updated line
            echo "<table border='1'>";
            echo "<tr><th>Case Type</th><td>" . $rowDetails["type"] . "</td></tr>"; // Updated line
            echo "<tr><th>Filling Number</th><td>" . $rowDetails["fillin_number"] . "</td></tr>"; // Updated line
            echo "<tr><th>Filling Date</th><td>" . $rowDetails["filling_date"] . "</td></tr>"; // Updated line
            echo "<tr><th>Registration Number</th><td>" . $rowDetails["reg_number"] . "</td></tr>"; // Updated line
            echo "</table>";

            // Display case status
            echo "<h2>Case Status</h2>";
            echo "<table border='1'>";
            echo "<tr><th>First Hearing Date</th><td>" . $rowDetails["first_hearing_date"] . "</td></tr>"; // Updated line
            echo "<tr><th>Decision Date</th><td>" . $rowDetails["decision_date"] . "</td></tr>"; // Updated line
            echo "<tr><th>Case Status</th><td>" . $rowDetails["status"] . "</td></tr>"; // Updated line
            echo "<tr><th>Nature of Disposal</th><td>" . $rowDetails["nature_of_disposal"] . "</td></tr>"; // Updated line
            echo "</table>";

            // Display case history
            echo "<h2>Case History</h2>";
            $sqlHistory = "SELECT * FROM case_history WHERE case_number = '$caseNumber'";
            $resultHistory = $conn->query($sqlHistory);

            if ($resultHistory->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Judge</th><th>Business on Date</th><th>Hearing Date</th><th>Purpose of Hearing</th></tr>";
                while ($rowHistory = $resultHistory->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $rowHistory["judge"] . "</td>";
                    echo "<td><a href='businessdetails.php?business_date=" . $rowHistory["business_date"] . "'>" . $rowHistory["business_date"] . "</a></td>";
                    echo "<td>" . $rowHistory["hearing_date"] . "</td>";
                    echo "<td>" . $rowHistory["purpose_of_hearing"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No case history found for the case.</p>";
            }

            // Close button with JavaScript to go back
            echo "<button id='closeModalButton' onclick='goBack()'>Close</button>";
        } else {
            echo "<p>No detailed information found for the case.</p>";
        }

        $conn->close();
    } else {
        echo "<p>No case number provided.</p>";
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
