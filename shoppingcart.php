<?php

include_once("databasecon.php");
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION["shoppingCart"])) {
    $_SESSION["shoppingCart"] = array();
}

// If "+" button is pressed, make an array $itemdata inside the shoppingCart session
if (isset($_POST["add_to_cart"])) {
    $itemdata = array (
        "item_productid"    =>    $_POST["hidden_productid"],
        "item_productname"  =>    $_POST["hidden_productname"],
        "item_quantity"     =>    $_POST["quantity"],
        "item_productprice" =>    $_POST["hidden_productprice"]
    );
    $exists=false;

// If shoppingCart is empty, push the item data inside the array, else add up the specified quantity
    if (empty($_SESSION["shoppingCart"])) {
        array_push($_SESSION["shoppingCart"], $itemdata);
        $exists=true;
    }  else {
        foreach ($_SESSION["shoppingCart"] as $index => $values) {
            if ($values["item_productid"] === $_POST["hidden_productid"]) {
                $values["item_quantity"] += $_POST["quantity"];
                $price = $_POST["hidden_productprice"];
                $values["item_productprice"] = $values["item_quantity"] * $price;
                $_SESSION["shoppingCart"][$index]=$values;
                $exists = true;
                break;
            }
        }
    }

    if(!$exists) {
        array_push($_SESSION["shoppingCart"], $itemdata);
    }
}

// If "-" button is pressed, remove by the specified quantity. If quantity gets below 1, remove the item from shoppingCart
if (isset($_POST["remove_from_cart"])) {
    foreach ($_SESSION["shoppingCart"] as $index => $values) {
        if ($values["item_productid"] === $_POST["hidden_productid"]) {
            if ($values["item_quantity"] > 1) {
                $values["item_quantity"] -= $_POST["quantity"];
                $price = $_POST["hidden_productprice"];
                $values["item_productprice"] = $values["item_quantity"] * $price;
                $_SESSION["shoppingCart"][$index] = $values;
            } else {
                unset($_SESSION["shoppingCart"][$index]);
            }
        }
    }
}

// If "Remove" button is pressed, remove item completely from shoppingCart
if (isset($_POST["remove"])) {
    foreach ($_SESSION["shoppingCart"] as $index => $values) {
        if ($values["item_productid"] === $_POST["hidden_productid"]) {
            unset($_SESSION["shoppingCart"][$index]);
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