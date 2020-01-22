<?php include_once("databasecon.php"); ?>
<?php
if (isset($_GET["searchBox"])) {
    // Check if searchbox is numeric, If so: it's a Articlenumber
    if (!is_numeric($_GET["searchBox"])) {

        $statement = mysqli_prepare($conn, "SELECT * FROM stockitems WHERE StockItemName LIKE ?");
        $trimmed = trim($_GET["searchBox"]);
        $likevar = "%" . $trimmed . "%";

        mysqli_stmt_bind_param($statement, 's', $likevar);
        mysqli_stmt_execute($statement);
        $resultsearch = mysqli_stmt_get_result($statement);
    }
    else {
        $statement = mysqli_prepare($conn, "SELECT * FROM stockitems WHERE StockItemID = ?");

        mysqli_stmt_bind_param($statement, 's', $_GET["searchBox"]);
        mysqli_stmt_execute($statement);
        $resultsearch = mysqli_stmt_get_result($statement);
    }
}

?>
<!-- HTML head -->
<!DOCTYPE html>
<html lang="en">

<?php include 'includes/head.php' ?>

<body>
<?php include 'includes/nav.php'; ?>
<div class="container">

    <div class="row">
        <?php include 'includes/categorySidebar.php'; ?>
        <?php include 'includes/carousel.php';?>


        <div style="font-size: 150%">
        <?php
        print("Resultaten voor: <b>" . $_GET["searchBox"] . "</b>");
        ?>
        </div>
        <div class="row">
            <?php
            if (isset($_GET["searchBox"]) && mysqli_num_rows($resultsearch) > 0) {
                foreach ($resultsearch as $row) {
                $btw = $row["TaxRate"] / 100 + 1;
                ?>
                <!--A link to its own page is created based on its ID      -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a href="productpagina.php?product=<?php print($row['StockItemID']); ?>">
                                <img class="card-img-top"  src="images/<?php print (str_replace($stringReplace, '-',$row["StockItemName"])) ?>.jpg" alt="">
                            </a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="productpagina.php?product=<?php print($row['StockItemID']); ?>"><?= $row["StockItemName"] ?></a>
                                </h4>
                                <h5>€<?= number_format((float) $row["UnitPrice"] * $btw , 2, ',', '')  ?></h5>
                                <p class="card-text"><?php echo $row["MarketingComments"] ?> </p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <h1>Geen resultaten gevonden.</h1>
            <?php } ?>
        </div>
    </div>
</div>
</div>

</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>

