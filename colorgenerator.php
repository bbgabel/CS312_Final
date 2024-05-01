<!DOCTYPE html>
<html>

<head>
    <title>Color Coordinate Generation</title>
    <meta name="description" content="color coordinate generator">
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
                color.selectedIndex = 0;
                document.getElementById("dupColorMsg").style.display = "block";
                setTimeout(function() {
                    document.getElementById("dupColorMsg").style.display = "none";
                }, 2000);
            } else {
                updateCellColors(color.id, selectedColor);
            }
        }

        function updateCellColors(colorId, newColor) {
            var oldColor = document.querySelector('input[name="selectedColor"]:checked').value;
            var cells = document.querySelectorAll('td[data-color="' + oldColor + '"]');
            for (let i = 0; i < cells.length; i++) {
                cells[i].style.backgroundColor = newColor;
                cells[i].setAttribute('data-color', newColor);
            }
            document.querySelector('input[id="' + colorId + '_radio"]').checked = true;
        }

        function handleCellClick(cell) {
            var selectedColor = document.querySelector('input[name="selectedColor"]:checked').value;
            var oldColor = cell.getAttribute('data-color');
            cell.style.backgroundColor = selectedColor;
            cell.setAttribute('data-color', selectedColor);

            var coordinate = cell.getAttribute('data-coord');
            var coordList = document.querySelector('td[data-color-list="' + selectedColor + '"]');

            // Remove coordinate from the old color's list
            if (oldColor) {
                var oldCoordList = document.querySelector('td[data-color-list="' + oldColor + '"]');
                if (oldCoordList) {
                    var oldCoords = oldCoordList.innerHTML.split(', ');
                    var index = oldCoords.indexOf(coordinate);
                    if (index > -1) {
                        oldCoords.splice(index, 1);
                        oldCoordList.innerHTML = oldCoords.join(', ');
                    }
                }
            }

            // Add coordinate to the new color's list
            if (!coordList.innerHTML.includes(coordinate)) {
                if (coordList.innerHTML) {
                    coordList.innerHTML += ', ';
                }
                coordList.innerHTML += coordinate;

                var coords = coordList.innerHTML.split(', ');
                coords.sort(function(a, b) {
                    if (a.charAt(0) !== b.charAt(0)) {
                        return a.charAt(0).localeCompare(b.charAt(0));
                    }
                    return Number(a.substr(1)) - Number(b.substr(1));
                });
                coordList.innerHTML = coords.join(', ');
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
            <a href="./manageColors.php">Manage Colors</a>
        </nav>
    </div>
    <div id="header">
        <h1>Color Coordinate Generation</h1>
    </div>
    <div id="background">
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
                $errorMsg = "";

                if ($rowscols < 1 || $rowscols > 26) {
                    $errorMsg .= "<p>Error: The dimensions of Rows & Columns must be between 1 and 26</p>";
                    $error = true;
                }

                if ($colors < 1 || $colors > 10) {
                    $errorMsg .= "<p>Error: The number of colors specified must be between 1 and 10</p>";
                    $error = true;
                }

                if ($error) {
                    echo $errorMsg;
                } else {
                    echo "<p id='dupColorMsg' style='display:none; color:red;'>Color already chosen. Please select a different color.</p>";
                    echo "<h2>Color Selector Table</h2>";
                    echo "<form action='printview.php' method='post'>";
                    echo "<table class='color-table'>";
                    echo "<tr><th>Color</th><th>Dropdown</th><th>Selected</th><th>Coordinate</th></tr>";

                    $servername = "faure.cs.colostate.edu:3306";
                    $username = "bbgabel";
                    $password = "835839390";
                    $dbname = "bbgabel";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM colors";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $availableColors = [];
                        while ($row = $result->fetch_assoc()) {
                            $color = [
                                "name" => $row["Name"],
                                "hexValue" => $row["HexValue"]
                            ];
                            array_push($availableColors, $color);
                        }
                        shuffle($availableColors);


                        $conn->close();

                        for ($i = 1; $i <= $colors; $i++) {
                            $dropdownId = "colorDropdown_$i";
                            $radioId = "colorDropdown_$i" . "_radio";
                            $color = array_pop($availableColors);
                            echo "<tr><td>Color $i</td><td>";
                            echo "<select id='$dropdownId' name='$dropdownId' onchange='handleColorChange(this)'>";
                            echo "<option value='{$color["hexValue"]}'>{$color["name"]}</option>";
                            foreach ($availableColors as $remainingColor) {
                                echo "<option value='{$remainingColor["hexValue"]}'>{$remainingColor["name"]}</option>";
                            }
                            echo "</select>";
                            echo "</td>";
                            echo "<td><input type='radio' id='$radioId' name='selectedColor' value='{$color["hexValue"]}' " . ($i == 1 ? 'checked' : '') . "></td>";
                            echo "<td data-color-list='{$color["hexValue"]}'></td>";
                            echo "</tr>";
                        }                        
                    } else {
                        echo "No results";
                    }
                    echo "</table>";
                    echo "<input type='hidden' name='rowscols' value='$rowscols'>";
                    echo "<input type='hidden' name='colors' value='$colors'>";
                    echo "<input type='submit' value='Printable View'>";
                    echo "</form>";

                    echo "<h2>Color Table</h2>";
                    echo "<table class='color-table'>";
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
                                $coord = chr(64 + $j) . $i;
                                echo "<td class='color-cell' data-coord='$coord' onclick='handleCellClick(this)'></td>";
                            }
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            }
            ?>
        </main>
    </div>
</body>

</html>