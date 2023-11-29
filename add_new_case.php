<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add_new_case.css"> 
    <title>Add New Case</title>
</head>

<body>

    <header>
        <h1>CaseManagement Dashboard</h1>
    </header>

    <div id="addNewCaseForm">
        <form action="process_new_case.php" method="post">
            <label for="caseNumber">Case Number:</label>
            <input type="text" name="caseNumber" id="caseNumber" required>

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

            <label for="fillingDate">Filling Date:</label>
            <input type="date" name="fillingDate" id="fillingDate" required>

          

            <button type="submit" name="submit" id="addButton">Add Case</button>
        </form>
    </div>

    <button id="addNewCaseButton" onclick="location.href='casemanagement.php'">Back to Case Management</button>

    <footer>
        <p>&copy; 2023 Court System. All rights reserved.</p>
    </footer>

</body>

</html>
