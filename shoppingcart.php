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

    <?php

    $products = "SELECT si.StockItemID, StockItemName, UnitPrice, StockGroupID
    FROM stockitems si
    JOIN stockitemstockgroups sisg ON si.StockItemID = sisg.StockItemID
    LIMIT 5";

    $result = mysqli_query($conn, $products);

    foreach ($result as $row) { ?>
        <div class="card">
            <form method="post" action="">
                <div>
                    <img style="width:250px; height:250px" src="images/.jpg">
                    <div class="container">
                        <h4><b><?= $row["StockItemName"]; ?></b></h4>
                        <div id="itemPrice">
                            <?php print("&#8364;" . $row["UnitPrice"] . ",-"); ?>
                        </div>
                    </div>
                </div>
                <input type="number" name="quantity" value=1>
                <input type="hidden" name="hidden_productid" value="<?php print $row["StockItemID"]; ?>" >
                <input type="hidden" name="hidden_productname" value="<?php print $row["StockItemName"]; ?>">
                <input type="hidden" name="hidden_productprice" value="<?php print $row["UnitPrice"]; ?>">
                <input type="submit" name="add_to_cart" value="+" >
                <input type="submit" name="remove_from_cart" value="-" >
                <input type="submit" name="remove" value="Remove">

            </form>
        </div>
    <?php }; ?>
    <div id="cartOverview">
        <table border="1px solid black">
            <tr>
                <th>Artikelnummer</th>
                <th>Product naam</th>
                <th>Hoeveelheid</th>
                <th>Prijs</th>
            </tr>
            <?php
            foreach ($_SESSION['shoppingCart'] as $key=>$value) { ?>
            <tr>
                <?php
                foreach ($value as $key2 => $value2) { ?>

                    <td><?php echo $value2; ?></td>
                    <?php
                }
                }
                ?>
            </tr>
        </table>
    </div>
</div>

</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>