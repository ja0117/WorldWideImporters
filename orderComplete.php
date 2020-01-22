<!------ Include the above in your HEAD tag ---------->
<?php

include 'includes/head.php';

$orderStatus = $_SESSION["orderStatus"];

if($orderStatus === "Success") {

    $generatedOrderID = random_int(100000000, 999999999);

    if(!empty($_SESSION["loggedin"][0]["userid"])) {
        // You can only order when logged in
        foreach($_SESSION["orderedProductInfo"] as $keys => $products) {
            $orderLineIDQuery = $conn->query("SELECT * FROM customerorders");
            $orderLineID = mysqli_num_rows($orderLineIDQuery);

            $customerID = $_SESSION["loggedin"][0]["userid"];
            $orderID = $generatedOrderID;
            $stockItemID = $products["item_productid"];
            $description =  $products["item_productname"];
            $quantity = $products["item_quantity"];
            $productPrice= $products["item_productprice"];

            $placeCustomerOrder = "INSERT INTO customerorders(OrderLineID, OrderID, CustomerID, StockItemID, Description, Quantity, UnitPrice)
            VALUES ($orderLineID, '$orderID', $customerID, $stockItemID, '$description', $quantity, '$productPrice')";

            $updateStockItemHoldings = "UPDATE stockitemholdings SET QuantityOnHand = QuantityOnHand - $quantity WHERE StockItemID = $stockItemID";

            if ($conn->query($placeCustomerOrder) === TRUE) {
//                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }

            if ($conn->query($updateStockItemHoldings) === TRUE) {
//                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    }
}

function displayOrderMessage($orderMessage) {
    switch($orderMessage) {
        case "Success":
            echo "Order geslaagd!";
        break;

        case "Cancel":
            echo "Order geannuleerd!";
        break;

        case "Error":
            echo "Order mislukt!";
        break;

        default:
        echo "Uw Order overzicht";
    }
}

?>

<!DOCTYPE html>
<html>

<!-- HTML head -->
<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/nav.php' ?>

<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading"><?php if($orderStatus == "Success" && empty($_SESSION["loggedin"][0]["userid"])) {
            echo "Je hebt een account nodig om te bestellen";
            } else {
                (displayOrderMessage($orderStatus));
            }; ?></h1>
     </div>
</section>

<div class="container mb-4">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Product</th>
                            <th></th>
                            <th scope="col" class="text-center">Aantal</th>
                            <th></th>
                            <th scope="col" class="text-right">Prijs</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $subtotaal = 0;
                    $totaalbtw = 0;
                    $btwproduct = 0;
                    foreach ($_SESSION["orderedProductInfo"] as $values) {
                    $subtotaal = $subtotaal + $values["item_productprice"];
                    $btwproduct = $values["item_productprice"] * $values["item_taxrate"] / 100;
                    $totaalbtw = $totaalbtw + $btwproduct;
                    ?>
                    <form method="post">
                        <tr>
                        <input type="hidden" name="hidden_productid" value="<?= $values["item_productid"] ?>">
                            <td> </td>
                            <td><?= $values["item_productname"] ?></td>
                            <td><?=$values["item_quantity"]?></td>
                            <td class="text-right">€<?= $values["item_productprice"] ?></td>

                            <!-- Hidden total cost -->

                        </tr>
                        </form>
                        <?php
                        }
                        ?>


                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Sub-Totaal</td>
                            <td class="text-right">€<?= $subtotaal ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>BTW</td>
                            <td class="text-right"><?php print("€"); echo $totaalbtw?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Totaal</strong></td>
                            <td class="text-right"><strong> <?php print("€"); print($subtotaal + $totaalbtw) ?> </strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                    <form action="index.php">
                        <button type="submit" class="btn btn-block btn-primary">Verder Winkelen</button>
                    </form>
                </div>

                <div class="col-sm-12 col-md-6 text-right">
                <form method="post" action="signup.php">
                    <?php
                    // If not logged in, prompt user to make an account to be able to order
                    if($orderStatus == "Success" && empty($_SESSION["loggedin"][0]["userid"]))
                    {?>
                        <button type="submit" class="btn btn-lg btn-block btn-success text-uppercase">Maak een account aan</button>
                    <?php
                    }?>
                </form>

                <form method="post" action="idealPayment.php">
                    <?php
                    if($orderStatus !== "Success")
                    {?>
                        <button type="submit" name="submitOrder" class="btn btn-lg btn-block btn-success text-uppercase">Opnieuw proberen</button>
                    <?php
                    }?>

                    <input type="hidden" name="totalCost" value="<?= $totaalbtw + $subtotaal ?>">
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include 'includes/footer.php' ?>