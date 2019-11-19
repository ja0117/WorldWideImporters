<?php
    include("databasecon.php");


    $statement = mysqli_prepare($conn, "SELECT * FROM stockitems WHERE StockItemName LIKE '%?%'");

    mysqli_stmt_bind_param($statement, 's', $_GET["searchBox"]);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    print_r($result);

//        $result = mysqli_query($conn, $sql);
//
//        if (mysqli_num_rows($result) > 0)
//        {
//            while ($row = mysqli_fetch_assoc($result))
//            {
//                echo("name: " . $row["StockItemName"]);
//            }
//        }


