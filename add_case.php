
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add_case.css"> 
    <title>Add New Case</title>
</head>

<body>

    <header>
        <h1>Admin Dashboard</h1>
    </header>

    <div id="addCaseForm">
        <form action="" method="post">
            
            <label for="caseNumber">Case Number:</label>
            <input type="text" name="caseNumber" id="caseNumber">

            <label for="partyName">Party Name:</label>
            <input type="text" name="partyName" id="partyName" required>

            <label for="caseType">Case Type:</label>
            <select name="caseType" id="caseType" required>
                <option value="C.C. CRIMINAL CASES">C.C. CRIMINAL CASES</option>
                <option value="O.S. ORIGINAL SUIT">O.S. ORIGINAL SUIT</option>
            </select>

            <label for="courtComplex">Court Complex:</label>
            <select name="courtComplex" id="courtComplex" required>
                <option value="PRL. SENIOR CIVIL JUDGE AND CJM, MANGALURU">PRL. SENIOR CIVIL JUDGE AND CJM,
                    MANGALURU</option>
                <option value="PRL. DISTRICT AND SESSIONS JUDGE, MANGALURU">PRL. DISTRICT AND SESSIONS JUDGE,
                    MANGALURU</option>
                <option value="JMFC IV COURT, MANGALURU">JMFC IV COURT, MANGALURU</option>
        
            </select>

            <label for="fillingDate">Filing Date:</label>
            <input type="date" name="fillingDate" id="fillingDate" required>

            <label for="firstHearingDate">First Hearing Date:</label>
            <input type="date" name="firstHearingDate" id="firstHearingDate" required>

            <label for="status">Status:</label>
            <input type="text" name="status" id="status" required>

            <button type="submit" id="addButton">Add Case</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2023 Court System. All rights reserved.</p>
    </footer>

</body>

</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_sample_db1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $case_number = $_POST["case_number"];

    $partyName = $_POST["partyName"];
    $caseType = $_POST["caseType"];
    $fillingDate = $_POST["fillingDate"];
    $firstHearingDate = $_POST["firstHearingDate"];
    $status = $_POST["status"];
    $courtComplex = $_POST["courtComplex"];

    if (empty($caseNumber)) {
        $sql = "INSERT INTO cases (party_name, type, filling_date, first_hearing_date, status, court_complex)
                VALUES ('$partyName', '$caseType', '$fillingDate', '$firstHearingDate', '$status', '$courtComplex')";
    } else {
        $sql = "UPDATE cases
                SET party_name = '$partyName', type = '$caseType', filling_date = '$fillingDate',
                first_hearing_date = '$firstHearingDate', status = '$status', court_complex = '$courtComplex'
                WHERE case_number = '$case_number'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Case added/updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
