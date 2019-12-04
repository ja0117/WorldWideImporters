<?php include_once("databasecon.php"); ?>

<!DOCTYPE html>
<html>

<!-- HTML head -->
<?php include 'includes/head.php'; ?>

<!-- Header & Nav bar -->
<?php include 'includes/headernav.php'; ?>
<?php include 'shoppingCartCode.php'; ?>



<body>

    <div class="page-container">
        <div>
            <h1>
                <marquee behavior="alternate">Populaire producten - Webshop 24/7 geopend! - De goedkoopste!</marquee>
            </h1>
            <!--This fetches the products with the most sales and orders them by quantity starting at the highest one. Limiting the query at 5        -->
            <?php
            $statement = mysqli_prepare($conn, "SELECT T.StockItemID, StockItemName, TaxRate, COUNT(T.StockItemID), UnitPrice
FROM stockitems S JOIN stockitemtransactions T ON S.StockItemID = T.StockItemID
GROUP BY T.StockItemID ORDER BY COUNT(T.StockItemID) desc LIMIT 5");
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            foreach ($result as $row) {?>

                    <?php
                $btw = $row["TaxRate"] / 100 + 1;
                ?>
                <!--A link to its own page is created based on its ID      -->
                <a href="productpagina.php?product=<?php print($row['StockItemID']); ?>">
                    <div class="card">
                        <i><img style="Width: 250px; height: 250px;" src="images/<?php print substr(str_replace('"', '',$row["StockItemName"]), 0, 3) ?>.jpg"></i>
                        <div class="container">
                            <h4><b><?php print(str_replace('"', '',$row["StockItemName"])); ?></b></h4>
                </a>
                <p>
                <form method="post">
                    <?php print("Prijs: " . $row["UnitPrice"] * $btw); ?>
                    <input type="submit" class="addToCartButton" name="add_to_cart" value="toevoegen">
                    <input type="hidden" name="hidden_productid" value="<?= $row['StockItemID']; ?>">
                    <input type="hidden" name="hidden_productname" value="<?= str_replace('"', '',$row['StockItemName']) ?>">
                    <input type="hidden" name="hidden_productprice" value="<?= $row["UnitPrice"] * $btw ?>">
                    <input type="hidden" name="quantity" value="1">
                    </form>
                </p>
        </div>
    </div>

<?php } ?>

</div>
</div>

</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>