<!DOCTYPE html>
<html>

<head>
    <title>About Us - Team Temp</title>
    <meta name="description" content="color cooridnate generator">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="navbar">
        <nav>
            <a href="./homepage.php">Homepage</a>
            <a href="./about.php">About us</a>
            <a href="#">Color Coordinate Generator</a>
        </nav>
    </div>
    <div id="header">
        <h1>Color Coordinate Generation</h1>
    </div>
    <main>
        <form action="colorgenerator.php" method="post">
            <label for="rowscols">Number of Rows & Columns (1-26):</label>
            <input type="number" id="rowscols" name="rowscols" min="1" max="26" required>

            <label for="colors">Number of Colors (1-10):</label>
            <input type="number" id="colors" name="colors" min="1" max="10" required>
            <input type="submit" value="Generate">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $rowscols = $_POST["rowscols"];
            $colors = $_POST["colors"];
            $error = false;

            if ($rowscols < 1 || $rowscols > 26){
                echo "<p>Error: The dimensions of Rows & Columns must be between 1 and 26</p>";
                $error = true;
            }

            if ($colors < 1 || $colors > 10) {
                echo "<p>Error: The number of colors specifed must be between 1 and 10</p>";
                $error = true;
            }
        }
        ?>
    </main>
</body>

</html>