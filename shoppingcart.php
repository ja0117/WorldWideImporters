<?php include_once("databasecon.php"); ?>

<!DOCTYPE html>
<html>

<!-- HTML head -->
<?php include 'includes/head.php'; ?>

<!-- Header & Nav bar -->
<?php include 'includes/headernav.php'; ?>
<head>
    <link rel="stylesheet" href="style/shoppingcart.css">
</head>

<body>

<div class="page-container">

    <?php $products = "SELECT Product.StockItemID, StockItemName, RecommendedRetailPrice
    FROM stockitems Product
    JOIN stockitemstockgroups Cat ON Product.StockItemID = Cat.StockItemID
    LIMIT 4";

    $result = mysqli_query($conn, $products);

    foreach ($result as $row) { ?>
    <div class="card">
        <form method="post" action="shoppingcart.php?action=add&id="<?php print $row["StockItemID"]; ?> >
            <div>
                <img style="width:250px; height:250px" src="images/<?php print substr($row["StockItemName"], 0, 3) ?>.jpg">
                <div class="container">
                    <h4><b><?= $row["StockItemName"]; ?></b></h4>
                    <div id="itemPrice">
                        <?php print("&#8364;" . $row["RecommendedRetailPrice"] . ",-"); ?>
                    </div>
                </div>
            </div>
            <input type="hidden" name="hidden_name" value="<?php print $row["StockItemName"]; ?>" >
            <input type="hidden" name="hidden_price" value="<?php print $row["RecommendedRetailPrice"]; ?>" >
            <input type="submit" name="add_to_cart" value="Voeg toe aan winkelmand">
        </form>
    </div>
    <?php }; ?>

</div>

</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>