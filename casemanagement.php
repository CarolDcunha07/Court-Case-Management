<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="casemanagement.css"> <!-- Include the CSS file -->
    <style>
        #closeButton {
            background-color: green;
            color: white;
        }
    </style>
    <title>Court Database Management System</title>
</head>

<body>

    <header>
        <h1>Court Management System</h1>
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
                            MANGALURU</option>
                        <option value="PRL. DISTRICT AND SESSIONS JUDGE, MANGALURU">PRL. DISTRICT AND SESSIONS JUDGE,
                            MANGALURU</option>
                        <option value="JMFC IV COURT, MANGALURU">JMFC IV COURT, MANGALURU</option>
                    </select>

                    <br><br>

                    <label for="caseNumber">Case Number:</label>
                    <input type="text" name="caseNumber" id="caseNumber">

                    <br><br>

                    <label for="caseYear">Year:</label>
                    <input type="text" name="caseYear" id="caseYear">

                    <br><br>

                    <label for="caseType">Case Type:</label>
                    <select name="caseType" id="caseType">
                        <option value="C.C. CRIMINAL CASES">C.C. CRIMINAL CASES</option>
                        <option value="Cr Criminal Case">Cr Criminal Case</option>
                        <option value="O.S. ORIGINAL SUIT">O.S. ORIGINAL SUIT</option>
                        <option value="M.C. MATRIMONIAL CASES">M.C. MATRIMONIAL CASES</option>
                        <option value="R.A REGULAR APPEAL">R.A REGULAR APPEAL</option>
                        <option value="H.R.C. HOUSE RENT CONTROL CASES">H.R.C. HOUSE RENT CONTROL CASES</option>
                        <option value="L.P.C LONG PENDING CASES">L.P.C LONG PENDING CASES</option>
                    </select>

                    <br><br>

                    <button type="submit" id="searchButton">Search</button>
                </div>
            </form>

            <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $courtComplex = $_POST["courtComplex"];
                $caseNumber = $_POST["caseNumber"];
                $caseYear = $_POST["caseYear"];
                $caseType = $_POST["caseType"];

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "login_sample_db1";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM cases WHERE court_complex = '$courtComplex' AND case_number = '$caseNumber' AND YEAR(reg_date) = '$caseYear' AND type = '$caseType'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<h2>Search Results:</h2>";
                    echo "<table border='1'>";
                    echo "<tr><th>Sr. No</th><th>Case Number</th><th>Party Name</th></tr>";
                    $srNo = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $srNo++ . "</td>";
                        echo "<td><a href='casedetails.php?case_number=" . $row["case_number"] . "'>" . $row["case_number"] . "</a></td>";
                        echo "<td>" . $row["party_name"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No results found for the entered values.</p>";
                }

                $conn->close();
            }
            ?>

            <br><br>

            <button id="addNewCaseButton" onclick="window.location.href='add_new_case.php'">Add New Case</button> <br><br>
            <button id="closeButton" onclick="window.location.href=window.location.href">Close</button>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 Court System. All rights reserved.</p>
    </footer>

</body>

</html>
