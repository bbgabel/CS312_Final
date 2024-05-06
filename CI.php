<?php
    #Color interface - methods to manage db.

    if ($_SERVER["REQUEST_METHOD"]== "GET") {
        header("Location: ./manageColors.php");
        die();
    }
    
    $servername = "faure.cs.colostate.edu:3306";
    $username = "bbgabel";
    $password = "835839390";
    $dbname = "bbgabel";
    $minRecords = 2;
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["countColor"])) {
        $listQuery = "SELECT * FROM colors"; 
        $listResult = $conn->query($listQuery);
        header('Content-type: application/json');
        echo json_encode($listResult->num_rows);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["getColor"])) {
        $Cid = $_POST["Cid"];
        $listQuery = "SELECT * FROM colors WHERE Id = '$Cid'"; 
        $listResult = $conn->query($listQuery); #refresh list for json return
        if ($listResult->num_rows == 0) {
            echo "<p>Error: No colors found.</p>";
        } else {
            $listArray = array();
            while($row = $listResult->fetch_assoc()) {
                $listArray[] = $row;
            }
            header('Content-type: application/json');
            echo json_encode($listArray);
        };
    }



    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["listColor"])) {
        $listQuery = "SELECT * FROM colors"; 
        $listResult = $conn->query($listQuery);
        if ($listResult->num_rows == 0) {
            echo "<p>Error: No colors found.</p>";
        } else {
            $listArray = array();
            while($row = $listResult->fetch_assoc()) {
                $listArray[] = $row;
            }
            header('Content-type: application/json');
            echo json_encode($listArray);
            
        };
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editColor"])) {
        $Cid = $_POST["Cid"];
        $newName = $_POST["newName"];
        $newHex = $_POST["newHex"];
        $verifyQuery = "SELECT * FROM colors WHERE (Name = '$newName' Or HexValue = '$newHex') And Id <> '$Cid'";
        $listQuery = "SELECT * FROM colors"; 
        $editQuery = "UPDATE colors SET Name = '$newName' , HexValue= '$newHex' WHERE Id = '$Cid'";
        $verifyResult = $conn->query($verifyQuery);
        if ($verifyResult->num_rows == 0) {
            if (preg_match('/[^a-zA-Z_0-9]/', $newName)) {
                header('HTTP/1.1 500 Internal Server Error');
                header('Content-Type: application/json; charset=UTF-8');
                die(); #Limit name to alphanumeric to make sql injection more difficult.
            }
            if (preg_match('/[^A-Fa-f0-9#]/', $newHex)) {
                header('HTTP/1.1 500 Internal Server Error');
                header('Content-Type: application/json; charset=UTF-8');
                die(); #Limit hex to hex chars and pound to make sql injection more difficult.
            }
            if (strlen($newHex) !=7 ) {
                header('HTTP/1.1 500 Internal Server Error');
                header('Content-Type: application/json; charset=UTF-8');
                die(); #limit hex string to fit db. 
            }
            $update = $conn->query($editQuery);
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json; charset=UTF-8');
            die();
        }
        $updateResult = $conn->query($listQuery); #refresh list for json return
        if ($updateResult->num_rows == 0) {
            echo "<p>Error: No colors found.</p>";
        } else {
            $updateArray = array();
            while($row = $updateResult->fetch_assoc()) {
                $updateArray[] = $row;
            }
            header('Content-type: application/json');
            echo json_encode($updateArray);
        };
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["removeColor"])) {
        $Cid = $_POST["Cid"];
        $listQuery = "SELECT * FROM colors"; 
        $removeQuery = "DELETE FROM colors WHERE Id = '$Cid'";
        $listResult = $conn->query($listQuery); #get initial count as backup to client-side verification.
        if ($listResult->num_rows >= $minRecords) {
            $update = $conn->query($removeQuery);
        }
        $listResult = $conn->query($listQuery); #refresh list for json return
        if ($listResult->num_rows == 0) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json; charset=UTF-8');
        } else {
            $listArray = array();
            while($row = $listResult->fetch_assoc()) {
                $listArray[] = $row;
            }
            header('Content-type: application/json');
            echo json_encode($listArray);
        };
    }



    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addColor"])) {
        $name = $_POST["addName"];
        $hex = $_POST["addHex"];

        $sql = "SELECT * FROM colors WHERE Name = '$name' OR HexValue = '$hex'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json; charset=UTF-8');
            die(); #Send failure back to Ajax. 
        } else {
            if (preg_match('/[^a-zA-Z_0-9]/', $name)) {
                header('HTTP/1.1 500 Internal Server Error');
                header('Content-Type: application/json; charset=UTF-8');
                die(); #Limit name to alphanumeric to make sql injection more difficult.
            }
            if (preg_match('/[^A-Fa-f0-9#]/', $hex)) {
                header('HTTP/1.1 500 Internal Server Error');
                header('Content-Type: application/json; charset=UTF-8');
                die(); #Limit hex to hex chars and pound to make sql injection more difficult.
            }
            if (strlen($hex) !=7 ) {
                header('HTTP/1.1 500 Internal Server Error');
                header('Content-Type: application/json; charset=UTF-8');
                die(); #limit hex string to fit db. 
            }
            $sql = "INSERT INTO colors (Name, HexValue) VALUES ('$name', '$hex')";          
            if ($conn->query($sql) === TRUE) {
                $listQuery = "SELECT * FROM colors"; 
                $updateResult = $conn->query($listQuery); #refresh list for json return

                $updateArray = array();
                while($row = $updateResult->fetch_assoc()) {
                $updateArray[] = $row;
                }
                header('Content-type: application/json');
                echo json_encode($updateArray);

            } else {
                header('HTTP/1.1 500 Internal Server Error');
                header('Content-Type: application/json; charset=UTF-8');
                die(); #Send failure back to Ajax. 
            }
        }
    }


    $conn->close();
    ?>