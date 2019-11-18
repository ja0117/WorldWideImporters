<?php
    include("databasecon.php");

    if (isset($_GET["searchBox"])) {
        $sql = 'SELECT ';
        $stmt = $conn->prepare("SELECT * FROM stockitems WHERE StockItemName = ':search'");
        $stmt->bindParam(":search",$_GET["searchBox"] );
        $result = $stmt->fetchAll();
        print_r($result);
    }
