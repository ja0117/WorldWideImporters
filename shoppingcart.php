<?php

include_once("databasecon.php");
include("shoppingCartCode.php");

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
    <form class="cartOverview" method="post">
        <?php

        foreach ($_SESSION["shoppingCart"] as $keys => $values) {
            echo $values["item_productid"];
            echo $values["item_productname"];
            echo $values["item_quantity"];
            echo $values["item_productprice"];
            }
            "<br>"; ?>
            <input type="submit" name="remove_from_cart" value="-">
    </form>
</div>

</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>