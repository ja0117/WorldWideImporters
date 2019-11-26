<?php

    include_once("databasecon.php");
    session_start();

    if (isset($_POST["add_to_cart"])) {
         if (isset($_SESSION["shopping_cart"])) {
               $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
               if (!in_array($_GET["id"], $item_array_id)) {
                   $count = count($_SESSION["shopping_cart"]);
                   $item_array = array(
                       'item_id'             =>     $_GET["id"],
                       'item_name'           =>     $_POST["hidden_name"],
                       'item_price'          =>     $_POST["hidden_price"],
                       'item_quantity'       =>     $_POST["quantity"]
                   );
                   $_SESSION["shopping_cart"][$count] = $item_array;
               }
               else {
               }
         }
         else {
             $item_array = array (
                 'item_id'          => $_GET["id"],
                 'item_name'        => $_POST["hidden_name"],
                 'item_price'       => $_POST["hidden_price"],
                 'item_quantity'    => $_POST["quantity"]
             );
             $_SESSION["shopping_cart"] [0] = $item_array;
         }
    }

    if(isset($_POST["remove_from_cart"]))
    {


            foreach($_SESSION["shopping_cart"] as $keys => $values)
            {
                print_r($_SESSION["shopping_cart"]);

                if($values["item_id"] == $_POST["id"])
                {
                    unset($_SESSION["shopping_cart"][$keys]);
                }
            }

    }
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
    $rand = rand(1,240);

    $products = "SELECT Product.StockItemID, StockItemName, RecommendedRetailPrice
    FROM stockitems Product
    JOIN stockitemstockgroups Cat ON Product.StockItemID = Cat.StockItemID
    WHERE Product.StockItemID= $rand LIMIT 5";

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
            <input type="text" name="quantity" value="1" >
            <input type="hidden" name="hidden_name" value="<?php print $row["StockItemName"]; ?>" >
            <input type="hidden" name="hidden_price" value="<?php print $row["RecommendedRetailPrice"]; ?>" >
            <input type="submit" name="add_to_cart" value="Voeg toe aan winkelmand">
        </form>
    </div>
    <?php }; ?>

    <h3>Order Details</h3>
    <div>
        <table>
            <tr>
                <th width="40%">Item Name</th>
                <th width="10%">Quantity</th>
                <th width="20%">Price</th>
                <th width="15%">Total</th>
                <th width="5%">Action</th>
            </tr>
            <?php
            if(!empty($_SESSION["shopping_cart"]))
            {
                $total = 0;
                foreach($_SESSION["shopping_cart"] as $keys => $values)
                {
                    ?>
                    <form method="post" action="">
                        <tr>
                            <td><?php echo $values["item_name"]; ?></td>
                            <td><?php echo $values["item_quantity"]; ?></td>
                            <td>$ <?php echo $values["item_price"]; ?></td>
                            <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
                            <td><a href="shoppingcart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span>Remove</span></a></td>
                            <td> <input type="submit" name="remove_from_cart" value="<?php echo $values["item_id"]; ?>"> </td>
                        </tr>
                    </form>
                    <?php
                    $total = $total + ($values["item_quantity"] * $values["item_price"]);
                }
                ?>
                <tr>
                    <td align="right">Total</td>
                    <td align="right">$ <?php echo number_format($total, 2); ?></td>
                    <td></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>

</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>