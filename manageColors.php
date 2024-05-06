<?php
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Color Selection</title>
    <meta name="description" content="Color Selection">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="./manageColors.js"></script>
</head>



<body>

    <div id="navbar">
        <nav>
            <a href="./homepage.php">Homepage</a>
            <a href="./about.php">About us</a>
            <a href="./colorgenerator.php">Color Coordinate Generator</a>
            <a href="#">Manage Colors</a>
        </nav>
    </div>

    <div id="header">
    <h1>Color Selection</h1>
    </div>

    <div id="background">



    <div id="tableHolder">
        <table id="colorManagementTable">
            <thead>
            <tr>
                <th>Name</th>
                <th>Hex</th>
                <th>Preview </th>
                <th colspan=2></th>
            </tr>
            </thead>
            <tbody>
</tbody>
        </table>



    <div id="AddFormDiv">
    
    <form id="addForm">
    <h2>Add a New Color</h2>
        <label for="colorName">Name:</label>
        <input type="text" id="colorName" name="colorName" required><br>
        <label for="colorHex">Hex Value:</label>
        <input type="text" id="colorHex" name="colorHex" required><br>
        <input type="button" name="addColor" value="Add Color" onClick="addColors()">
        <input type="button" name="addCancel" value="Cancel" onClick="hideAdder()">
    </form>
    </div>

    <div id="EditFormDiv">
    
    
    <form id="editForm">
    <h2>Edit a color</h2>
        <span id="oldName" name="oldName">test</span><br>
        <span id="oldHex" name="oldHex">#test</span><br>
        <input type="hidden" id="CidField" name="CidField" value="-1">
        <label for="colorName">New name:</label>
        <input type="text" id="newEditName" name="newEditName" required><br>
        <label for="colorHex">New hex value:</label>
        <input type="text" id="newEditHex" name="newEditHex" required><br>
        <input type="button" name="editColor" value="Edit Color" onClick="sumbitEdit()">
        <input type="button" name="ecCancel" value="Cancel" onClick="hideEditor()">
        
    </form>
    </div>

    <div id="errorHandler">
        <span id="StatusMessage"></span>
    </div>

</div>

</body>

</html>
