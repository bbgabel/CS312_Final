<!DOCTYPE html>
<html>
<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<head>
    <title>Printable View</title>
    <meta name="description" content="Print View of Color Generator">
    <meta charset="UTF-8">
    <style>
        @media print {
            @page { size: letter portrait; max-height:25%; max-width:100%}

            .printable {
                width:50%;
                height:10%;       
            }
        }
        table {
            border-collapse: collapse;
            width: 80%;
            table-layout: fixed;
        }


        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 1px;
            text-align: center;
        }



    
        

    </style>
</head>

<body class="printable">
    <h2>Color Selector Table</h2>
    <table>
        <tr>
            <th>Color</th>
            <th>Dropdown</th>
        </tr>
        <?php
        $colors = $_POST['colors'];
        for ($i = 1; $i <= $colors; $i++) {
            $selectedColor = $_POST["colorDropdown_$i"];
            echo "<tr>";
            echo "<td>Color $i</td>";
            echo "<td>$selectedColor</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h2>Color Table</h2>
    <table>
        <?php
        $rowscols = $_POST['rowscols'];
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
        ?>
    </table>

</body>

</html>
