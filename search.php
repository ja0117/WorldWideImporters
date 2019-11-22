<?php
    include("databasecon.php");

    if (isset($_GET["searchBox"])) {

        // Check if searchbox is numeric, If so: it's a Articlenumber
        if (!is_numeric($_GET["searchBox"])) {

            $statement = mysqli_prepare($conn, "SELECT * FROM stockitems WHERE StockItemName LIKE ?");
            $trimmed = trim($_GET["searchBox"]);
            $likevar = "%" . $trimmed . "%";

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

<!-- HTML head -->
<?php include 'includes/searchHead.html'; ?>

<!-- Header & Nav bar -->
<?php include 'includes/headernav.php'; ?>

<body>

<div style="font-size: 150%">
<?php
print("Je hebt gezocht op: " . $_GET["searchBox"]);
?>
</div>

<div>
    <?php
        if (isset($_GET["searchBox"]) && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <a href="productpagina.php?product=<?php print($row['StockItemID']); ?>">
                <div class="card">
                    <img style="width:250px; height:250px" src="images/<?php print substr($row["StockItemName"], 0, 3) ?>.jpg">
                    <div class="container">
                        <?php print($row["StockItemName"]); ?> <br>
                        <div id="itemPrice">
                            <?php print("&#8364;" . $row["UnitPrice"] . ",-"); ?>
                        </div>
                    </div>
                </div>
                </a>
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

</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>

