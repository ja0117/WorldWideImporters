<?php
    include("databasecon.php");

    $isset = true;
    if (isset($_GET["searchBox"])) {

        $statement = mysqli_prepare($conn, "SELECT * FROM stockitems WHERE StockItemName LIKE ?");

        $likevar = "%" . $_GET["searchBox"] . "%";

        mysqli_stmt_bind_param($statement, 's', $likevar);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
    }
    else
    {
        $isset = false;
    }
//        $result = mysqli_query($conn, $sql);
//
//        if (mysqli_num_rows($result) > 0)
//        {
//            while ($row = mysqli_fetch_assoc($result))
//            {
//                echo("name: " . $row["StockItemName"]);
//            }
//        }
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/searchStyle.css">
    <title>World Wide Importers</title>
</head>
<body>
<!-- Top navigation bar -->
<div class="topnav">
    <a href="#home">Home</a>
    <a class="active" href="#news">Search</a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
    <form id="search" action="us3.php">
        <input type="text" name="searchBox" placeholder="Search for anything">
        <input type="submit" value="Search" id="searchButton">
    </form>
</div>


<header> <h1>Items die op </h1> </header>

<div>
    <?php
        if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result))
        {
            ?>
    <div class="card">
        <img style="width:250px; height:250px" src="https://i.imgur.com/oxcR3dI.jpg">
        <div class="container">
            <?php print($row["StockItemName"]); ?>
        </div>
    </div>

    <?php
        }
    }
        ?>
</div>

<footer> Copyright &copy; 2019, Wide World Importers</footer>

</body>
</html>

