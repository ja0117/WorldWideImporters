<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<?php

include_once("databasecon.php");
include("shoppingCartCode.php");

?>

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

<div class="container mb-4">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Product</th>
                            <th scope="col" class="text-center">Aantal</th>
                            <th scope="col" class="text-right">Prijs</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $subtotaal = 0;
                    foreach ($_SESSION["shoppingCart"] as $values) {
                    $subtotaal = $subtotaal + $values["item_productprice"];
                    ?>
                    <form method="post">
                        <tr>
                        <input type="hidden" name="hidden_productid" value="<?= $values["item_productid"] ?>">
                            <td><img src="https://dummyimage.com/50x50/55595c/fff" /> </td>
                            <td><?= $values["item_productname"] ?></td>
                            <td><input class="form-control" type="text" value="<?=$values["item_quantity"]?>" /></td>
                            <td> <button type ="submit" name ="increaseQuantity" class="btn btn-succes"> <i class="fas fa-plus"> </i> </button> </td>
                            <td class="text-right">€<?= $values["item_productprice"] ?></td>
                            <td> <button type ="submit" name ="decreaseQuantity" class="btn btn-succes"> <i class="fas fa-minus"> </i> </button> </td>
                            <td class="text-right"><button type ="submit" name="remove" class="btn btn-sm btn-danger"> <i class="fa fa-trash"> </i> </button> </td>
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
                            <td class="text-right">€ Komt nog</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td class="text-right"><strong>346,90 €</strong></td>
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
                <div class="col-sm-12 col-md-6 text-right">
                    <button class="btn btn-lg btn-block btn-success text-uppercase">Betalen</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include 'includes/footer.php' ?>