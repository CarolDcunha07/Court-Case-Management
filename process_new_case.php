<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $partyName = $_POST["partyName"];
    $caseType = $_POST["caseType"];
    $courtComplex = $_POST["courtComplex"];
    $fillingDate = $_POST["fillingDate"];
    

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "login_sample_db1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO cases (party_name, type, court_complex, filling_date)
            VALUES ('$partyName', '$caseType', '$courtComplex', '$fillingDate')";

    if ($conn->query($sql) === TRUE) {
        echo "Case added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
