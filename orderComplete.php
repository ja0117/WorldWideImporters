<!------ Include the above in your HEAD tag ---------->
<?php

include 'includes/head.php';



$orderStatus = $_SESSION["orderStatus"];

if($orderStatus === "Success")
{



$generatedOrderID = random_int(100000000, 999999999);

if(!empty($_SESSION["loggedin"][0]["userid"]))
{


// If the user is logged in and a userID has been found, pass it along
foreach($_SESSION["orderedProductInfo"] as $keys => $products)
        {

//            print($_SESSION["loggedin"][0]["userid"]);
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

// If no user id is found, leave the customerID field NULL
else{
    foreach($_SESSION["orderedProductInfo"] as $keys => $products){

        $orderLineIDQuery = $conn->query("SELECT * FROM customerorders");
        $orderLineID = mysqli_num_rows($orderLineIDQuery)   ;

    $orderID = $generatedOrderID;
    $stockItemID = $products["item_productid"];
    $description = $products["item_productname"];
    $quantity = $products["item_quantity"];
    $productPrice= $products["item_productprice"];



    $updateStockItemHoldings = "UPDATE stockitemholdings SET QuantityOnHand = QuantityOnHand - $quantity WHERE StockItemID = $stockItemID ;";


    $placeGuestOrder = "INSERT INTO customerorders(OrderLineID, OrderID, StockItemID, CustomerID, Description, Quantity, UnitPrice)
    VALUES ($orderLineID, '$orderID', $stockItemID, NULL, '$description', $quantity, '$productPrice') ;";




    if ($conn->query($updateStockItemHoldings) === TRUE) {
        // echo "Record updated successfully";
    } else {
         echo "Error updating record: " . $conn->error;
    }

    if ($conn->query($placeGuestOrder) === TRUE) {
        // echo "Record updated successfully";
    } else {
         echo "Error updating record: " . $conn->error;
    }
}

}
}

function displayOrderMessage($orderMessage)
{
    switch($orderMessage)
    {
        case "Success":
            echo "Order geslaagd!";


        break;

        // case "Pending":
        //     echo "Order geslaagd";
        // break;

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
        <!-- Might put a switch case here for displaying the appropriate status message depending on whether the payment succeeded or not -->
        <h1 class="jumbotron-heading"><?php displayOrderMessage($orderStatus); ?></h1>
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
                            <td><img src="https://dummyimage.com/50x50/55595c/fff" /> </td>
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
                <form method="post" action="idealPayment.php">
                    <?php
                    // Only show try again button of order has not succeeded
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