<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<!DOCTYPE html>
<html>

<!-- HTML head -->
<?php include 'includes/head.php'; ?>

<body>

<?php include 'includes/nav.php' ?>

<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Winkelmand</h1>
     </div>
</section>



<?php
if(empty($_SESSION["shoppingCart"]))
{?>
    <section class="jumbotron text-center">
    <div class="container">
        <h3 class="jumbotron-heading">Uw winkelmand is leeg!</h3>
     </div>
</section>

<?php
}
else{
    ?>


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
                    foreach ($_SESSION["shoppingCart"] as $values) {
                    $subtotaal = $subtotaal + $values["item_productprice"];
                    $btwproduct = $values["item_productprice"] * $values["item_taxrate"] / 100;
                    $totaalbtw = $totaalbtw + $btwproduct;
                    ?>
                    <form method="post">
                        <tr>
                        <input type="hidden" name="hidden_productid" value="<?= $values["item_productid"] ?>">
                            <td> </td>
                            <td><?= $values["item_productname"] ?></td>
                            <td> <button type ="submit" name ="increaseQuantity" class="btn btn-succes"> <i class="fas fa-plus-square"> </i> </button> </td>
                            <td><?=$values["item_quantity"]?></td>
                            <td> <button type ="submit" name ="decreaseQuantity" class="btn btn-succes"> <i class="fas fa-minus-square"> </i> </button> </td>

                            <td class="text-right">€<?= $values["item_productprice"] ?></td>
                            <td class="text-right"><button type ="submit" name="remove" class="btn btn-sm btn-danger"> <i class="fa fa-trash"> </i> </button> </td>

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
                            <td class="text-right">€<?= number_format((float) $subtotaal , 2, ',', '') ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>BTW</td>
                            <td class="text-right"><?php print("€"); echo number_format((float) $totaalbtw , 2, ',', '')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Totaal</strong></td>
                            <td class="text-right"><strong> <?php print("€"); echo number_format((float) $subtotaal + $totaalbtw , 2, ',', '') ?> </strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                    <form action="index.php">
                        <button type="submit" class="btn btn-block btn-light">Verder Winkelen</button>
                    </form>
                </div>
            </div>
        </div>

                <div class="col-sm-12 col-md-6 text-right">
                <form method="post" action="idealPayment.php">
                    <button type="submit" name="submitOrder" class="btn btn-lg btn-block btn-success text-uppercase">Betalen</button>
                    <input type="hidden" name="totalCost" value="<?= $totaalbtw + $subtotaal ?>">
                </form>
                </div>
            </div>
        </div>

<?php
}
?>



<!-- Footer -->
<!-- -->
</body>
</html>