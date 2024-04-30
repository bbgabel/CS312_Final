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
            <th>Hex Code</th>
        </tr>
        <?php
        $colors = $_POST['colors'];
        for ($i = 1; $i <= $colors; $i++) {
            $selectedColor = $_POST["colorDropdown_$i"];
            // Get hex code of the color
            $hexCode = '';
            switch ($selectedColor) {
                case 'red':
                    $hexCode = '#FF0000';
                    break;
                case 'orange':
                    $hexCode = '#FFA500';
                    break;
                case 'yellow':
                    $hexCode = '#FFFF00';
                    break;
                case 'green':
                    $hexCode = '#008000';
                    break;
                case 'blue':
                    $hexCode = '#0000FF';
                    break;
                case 'purple':
                    $hexCode = '#800080';
                    break;
                case 'grey':
                    $hexCode = '#808080';
                    break;
                case 'brown':
                    $hexCode = '#A52A2A';
                    break;
                case 'black':
                    $hexCode = '#000000';
                    break;
                case 'teal':
                    $hexCode = '#008080';
                    break;
                default:
                    $hexCode = '#FFFFFF'; // Default to white
                    break;
            }
            echo "<tr>";
            echo "<td>Color $i</td>";
            echo "<td>$selectedColor ($hexCode)</td>";
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
