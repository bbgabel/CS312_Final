<!DOCTYPE html>
<html>

<head>
    <title>Color Coordinate Generation</title>
    <meta name="description" content="color cooridnate generator">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css">

    <script>
        function handleColorChange(color) {

            var selectedColor = color.value;

            var selectedColors = [];
            var dropdowns = document.querySelectorAll("select");
            for (let i = 0; i < dropdowns.length; i++) {
                if (dropdowns[i] !== color) {
                    selectedColors.push(dropdowns[i].value);
                }
            }

            if (selectedColors.includes(selectedColor)) {
                alert("Color already chosen.");
                color.selectedIndex = 0;
            }
        }
    </script>


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


            if (!$error) {
                echo "<h2>Color Selector Table</h2>";
                echo "<table>";
                echo "<tr><th>Color</th><th>Dropdown</th></tr>";
                
                $availableColors = ['red', 'orange', 'yellow', 'green', 'blue', 'purple', 'grey', 'brown', 'black', 'teal'];

                shuffle($availableColors);

                for ($i = 0; $i < $colors; $i++) {
                    $dropdownId = "colorDropdown_$i";
                    $color = array_pop($availableColors);
                    echo "<tr><td>Color " . ($i + 1) . "</td><td>";
                    echo "<select id='$dropdownId' onchange='handleColorChange(this)'>";
                    echo "<option value='$color'>$color</option>";
                    foreach ($availableColors as $remainingColor) {
                        echo "<option value='$remainingColor'>$remainingColor</option>";
                    }
                    echo "</select>";
                    echo "</td></tr>";
                }
 
                echo "</table>";
    
                echo "<h2>Color Table</h2>";
                echo "<table>";
                for ($i = 0; $i <= $rowscols; $i++) {
                    echo "<tr>";
                    for ($j = 0; $j <= $rowscols; $j++) {
                        if ($i == 0 && $j == 0) {
                            echo "<td></td>";
                        } elseif ($i == 0) {
                            echo "<td>" . chr(64 + $j) . "</td>";
                        } elseif ($j == 0) {
                            echo "<td>$i</td>";
                        } else {
                            echo "<td></td>";
                        }
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }

        }
        ?>
    </main>
</body>

</html>