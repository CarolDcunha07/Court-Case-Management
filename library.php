<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="library.css"> 
    <title>Legal Resource Library</title>
</head>

<body>

    <header>
        <h1>Legal Resource Library</h1>
    </header>

    <div id="resourceLibrary">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "login_sample_db1";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM legal_resources";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='document'>";
                echo "<h2>{$row['title']}</h2>";
                echo "<a href='{$row['document_link']}' target='_blank'>View Document</a>";
                echo "<p>{$row['description']}</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No legal documents found.</p>";
        }

        $conn->close();
        ?>
    </div>

    <footer>
        <p>&copy; 2023 Legal System. All rights reserved.</p>
    </footer>

</body>

</html>
