<?php
include_once("databasecon.php");

?>
<!DOCTYPE html>
<html>
<head>
    <title>World Wide Importers</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<body>

<header> <h1>Welkom bij WWI!</h1> </header>

<div>
    <?php
    $sql = 'SELECT * FROM customers';

    foreach ($conn->query($sql) as $row) {
        print($row["CustomerID"] . "\t");
        print($row["CustomerName"] . "\t");
        print("<br>");
    }
    ?>
</div>

<footer> Copyright &copy; 2019, World Wide Importers</footer>

</body>
</html>

