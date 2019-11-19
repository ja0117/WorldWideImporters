<?php
include_once("databasecon.php");

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/indexStyle.css">
    <title>World Wide Importers</title>
</head>
<body>
<!-- Top navigation bar -->
<div class="topnav">
    <a class="active" href="#home">Home</a>
    <a href="#news">Search</a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
    <form id="search" action="us3.php">
        <input type="text" name="searchBox" placeholder="Search for anything" id="searchBox">
        <input type="submit" value="Search" id="searchButton">
    </form>
</div>


<header> <h1>Welkom bij WWI!</h1> </header>

<div>
    <!--

    $sql = 'SELECT * FROM customers';

    foreach ($conn->query($sql) as $row) {
        print($row["CustomerID"] . "\t");
        print($row["CustomerName"] . "\t");
        print("<br>");
    }

    -->
</div>

<footer> Copyright &copy; 2019, Wide World Importers</footer>

</body>
</html>

