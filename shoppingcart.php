<?php

    include_once("databasecon.php");
    session_start();

    if (empty($_SESSION["shoppingCart"])) {
        $_SESSION["shoppingCart"] = array();
    }

    if (isset($_POST["add_to_cart"])) {
        array_push($_SESSION["shoppingCart"], $_POST["add_to_cart"] );
    }

    if (isset($_POST["remove_to_cart"])) {
        foreach ($_SESSION["shoppingCart"] as $keys => $values) {
            if ($values === $_POST["remove_to_cart"]) {
                unset($_SESSION["shoppingCart"] [$keys]);
            }
        }
    }

    print_r($_SESSION["shoppingCart"]);

?>

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

    <?php

    $products = "SELECT Product.StockItemID, StockItemName, RecommendedRetailPrice, StockGroupID
    FROM stockitems Product
    JOIN stockitemstockgroups Cat ON Product.StockItemID = Cat.StockItemID
    LIMIT 5";

    $result = mysqli_query($conn, $products);

    foreach ($result as $row) { ?>
    <div class="card">
        <form method="post" action="">
            <div>
                <img style="width:250px; height:250px" src="images/<?= $row['StockGroupID'] ?>.jpg">
                <div class="container">
                    <h4><b><?= $row["StockItemName"]; ?></b></h4>
                    <div id="itemPrice">
                        <?php print("&#8364;" . $row["RecommendedRetailPrice"] . ",-"); ?>
                    </div>
                </div>
            </div>
            <input type="text" name="quantity" value="1">
            <input type="hidden" name="hidden_id" value="<?php print $row["StockItemID"]; ?>" >
            <input type="submit" name="add_to_cart" value="<?php print $row["StockItemID"]; ?>" >
            <input type="submit" name="remove_to_cart" value="<?php print $row["StockItemID"]; ?>" >
        </form>
    </div>
    <?php }; ?>

</div>

</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>