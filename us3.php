<?php
    include("databasecon.php");

    if (isset($_GET["searchBox"])) {

        // Check if searchbox is numeric, If so: it's a Articlenumber
        if (!is_numeric($_GET["searchBox"])) {

            $statement = mysqli_prepare($conn, "SELECT * FROM stockitems WHERE StockItemName LIKE ?");

            $likevar = "%" . $_GET["searchBox"] . "%";

            mysqli_stmt_bind_param($statement, 's', $likevar);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
        }
        else {
            $statement = mysqli_prepare($conn, "SELECT * FROM stockitems WHERE StockItemID = ?");

            mysqli_stmt_bind_param($statement, 's', $_GET["searchBox"]);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
        }
    }
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
        <input type="text" name="searchBox" placeholder="Search for anything" id="searchBox">
        <input type="submit" value="Search" id="searchButton">
    </form>
</div>


<header> <h1></h1> </header>

<div>
    <?php
        if (isset($_GET["searchBox"]) && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>

                <div class="card">
                    <img style="width:250px; height:250px" src="https://i.imgur.com/oxcR3dI.jpg">
                    <div class="container">
                        <?php print($row["StockItemName"]); ?> <br>
                        <div id="itemPrice">
                            <?php print("&#8364;" . $row["RecommendedRetailPrice"] . ",-"); ?>
                        </div>
                    </div>
                </div>

                <?php
            }
        }
        else {
            ?>
            <h1>No search results.</h1>
            <?php
        }
        ?>
</div>

<footer> Copyright &copy; 2019, Wide World Importers</footer>

</body>
</html>

