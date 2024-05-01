<!DOCTYPE html>
<html>

<head>
    <title>Color Selection</title>
    <meta name="description" content="Color Selection">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css">
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

    <h1>Color Selection</h1>

    <h2>Add a New Color</h2>
    <form action="managecolors.php" method="post">
        <label for="colorName">Name:</label>
        <input type="text" id="colorName" name="colorName" required><br>
        <label for="colorHex">Hex Value:</label>
        <input type="text" id="colorHex" name="colorHex" required><br>
        <input type="submit" name="addColor" value="Add Color">
    </form>

    <?php
    $servername = "faure.cs.colostate.edu:3306";
    $username = "bbgabel";
    $password = "835839390";
    $dbname = "bbgabel";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addColor"])) {
        $name = $_POST["colorName"];
        $hex = $_POST["colorHex"];

        $sql = "SELECT * FROM colors WHERE Name = '$name' OR HexValue = '$hex'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<p>Error: Color with the same name or hex value already exists.</p>";
        } else {

            $sql = "INSERT INTO colors (Name, HexValue) VALUES ('$name', '$hex')";
            if ($conn->query($sql) === TRUE) {
                echo "<p>New color added successfully.</p>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();
    ?>

</body>

</html>
