<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_sample_db1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM cases";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="casemanagement.css"> 
    <title>Court Database Management System</title>
</head>

<body>

    <header>
        <h1>Admin Dashboard - Manage Cases</h1>
    </header>

    <div id="caseManagementBox">

        <div id="caseManagement">
            <form action="" method="post">
                <ul id="caseList">
                </ul>

                <div id="filterOptions">
                    <label for="courtComplex">Court Complex:</label>
                    <select name="courtComplex" id="courtComplex">
                        <option value="PRL. SENIOR CIVIL JUDGE AND CJM, MANGALURU">PRL. SENIOR CIVIL JUDGE AND CJM,
                            MANGALURU</option><br>
                    </select><br><br>

                    <label for="caseNumber">Case Number:</label>
                    <input type="text" name="caseNumber" id="caseNumber">
                    <br><br>

                    <label for="caseType">Case Type:</label>
                    <select name="caseType" id="caseType">
                        <option value="C.C. CRIMINAL CASES">C.C. CRIMINAL CASES</option>
                    </select><br><br>

                    <button type="submit" id="searchButton">Search</button>
                </div>
            </form>

            <?php
            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Case Number</th><th>Party Name</th><th>Type</th><th>Filing Date</th><th>First Hearing Date</th><th>Status</th><th>Action</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["case_number"] . "</td>";
                    echo "<td>" . $row["party_name"] . "</td>";
                    echo "<td>" . $row["type"] . "</td>";
                    echo "<td>" . $row["filling_date"] . "</td>";
                    echo "<td>" . $row["first_hearing_date"] . "</td>";
                    echo "<td>" . $row["status"] . "</td>";
                    echo "<td><a href='edit_case.php?case_number=" . $row["case_number"] . "'>Edit</a></td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No cases found.</p>";
            }

            $conn->close();
            ?>
<br><br>
            <button id="addNewCaseButton">Add New Case</button>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 Court System. All rights reserved.</p>
    </footer>

</body>

</html>
