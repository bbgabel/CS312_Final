<!DOCTYPE html>
<html>
<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<head>
    <title>Team 10 homepage</title>
    <meta name="description" content="Final project for CS312 at CSU">
    <meta name="keywords" content="HTML5, CS312, Colorado State University, Final Project, Group Project">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>

<body>
    <div id="navbar">
        <nav>
            <a href="#">Homepage</a>
            <a href="./about.php">About us</a>
            <a href="./colorgenerator.php">Color Coordinate Generator</a>
        </nav>
    </div>
    <div id="header">
    <h1>Team 10</h1>
    </div>
    <div id="background">
    <main>
        
        <div id="introparagraph">
            <p>Team 10 was created for the purpose of the Final Project in CS312 
                at Colorado State University. We seek to grow our understanding of 
                web development and team skills by working together on this project
                to make us better programmers for our future work. Please click on the
                about us page to learn more about our team members, where we are from, and 
                what we seek to do with our skills in programming. 
            </p>
            <p id="Color generator explaination">
                We have created a color coordinate generator. Given that your input of columns (n), rows (m), 
                and colors (X) are all within the allowed values, this page will display two tables. The first
                table will be 2 columns by X rows, where X is the number of colors that you provided. The 
                second table will have a table nxm. These cells will be labeled, and you will be able to
                see the selected colors from the first table. Finally, there will be a button near the 
                bottom of the page that will allow you to see a printable version of your tables. 
            </p>
        </div>
    </div>
    </main>
    

</body>

</html>