<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_sample_db1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the case_number is provided in the URL
if (isset($_GET["case_number"])) {
    $caseNumber = $_GET["case_number"];

    // Retrieve the case details based on the case_number
    $sql = "SELECT * FROM cases WHERE case_number = '$caseNumber'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Display the form for editing the case details
        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="edit_case.css"> <!-- Include the CSS file -->
            <title>Edit Case - <?php echo $row["case_number"]; ?></title>
        </head>

        <body>

            <header>
                <h1>Edit Case - <?php echo $row["case_number"]; ?></h1>
            </header>

            <div id="editCaseForm">
                <form action="update_case.php" method="post">
                    <!-- Add form fields based on your case structure -->
                    <input type="hidden" name="caseNumber" value="<?php echo $row["case_number"]; ?>">
                    <label for="partyName">Party Name:</label>
                    <input type="text" name="partyName" value="<?php echo $row["party_name"]; ?>" required><br>

                    <label for="caseType">Case Type:</label>
                    <input type="text" name="caseType" value="<?php echo $row["type"]; ?>" required><br>

                    <label for="fillingDate">Filing Date:</label>
                    <input type="text" name="fillingDate" value="<?php echo $row["filling_date"]; ?>" required><br>

                    <label for="firstHearingDate">First Hearing Date:</label>
                    <input type="text" name="firstHearingDate" value="<?php echo $row["first_hearing_date"]; ?>" required><br>

                    <label for="status">Status:</label>
                    <input type="text" name="status" value="<?php echo $row["status"]; ?>" required><br>

                    <button type="submit" id="updateButton">Update</button>
                </form>
            </div>
            <footer>
        <p>&copy; 2023 Court System. All rights reserved.</p>
    </footer>

        </body>

        </html>

        <?php
    } else {
        echo "Case not found.";
    }
} else {
    echo "Case number not provided.";
}

$conn->close();
?>
