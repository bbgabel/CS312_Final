<!DOCTYPE html>
<html>
<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<head>
    <title>About Us - Team 10</title>
    <meta name="description" content="About the members of Team Temp">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
    <div id="navbar">
        <nav>
            <a href="./homepage.php">Homepage</a>
            <a href="#">About us</a>
            <a href="./colorgenerator.php">Color Coordinate Generator</a>
            <a href="./manageColors.php">Manage Colors</a>
        </nav>
    </div>
    <div id="header">
        <h1>About Us</h1>
    </div>
    <div id="background">
    <main>
        <div id="team-members">
            <div class="member">
                <h2>Jeremiah Gabel</h2>
                <p>I'm Jeremiah, I'm a senior here at Colorado State University. I work at the United States Department of Agrictulture (USDA) as Programmer, and I aspire to be a full-stack software developer.</p>
                <img src="./img/JG.jpeg" alt="Jeremiah">
            </div>
            <div class = "member">
                <h2>Javier Schafer</h2>
                <p>I'm Javier and I'm a soon to be alumni of CSU this May. I work part-time as an IT professional and hope to pursue a career in tech. Otherwise, you can find me making cars fast.</p>
                <img src="./img/javier.jpeg" alt="Javier">
            </div>
          <div class="member">
                <h2>Sean Fyola</h2>
                <p>I'm Sean, and I'm a student here at CSU. I have recently taken the jump into freelancing, where I primarily do PLC control and SCADA development. </p>
                <img src="./img/SF.jpg" alt="Sean">
            </div>
          </main>
        </div>
    </main>
</div>
</body>

</html>
