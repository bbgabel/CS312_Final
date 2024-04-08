<!DOCTYPE html>
<html>
<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<head>
    <title>About Us - Team Temp</title>
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
                <h2>Nathan Bennick</h2>
                <p>I'm Nate, a senior at Colorado State University. I am currently employeed with Amergint Technologies, an areospace company based in Colorado Springs, as a software engineering intern and a UTA for CSU.</p>
                <img src="./img/nate.jpeg" alt="Nate">
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
