<!-- HTML head -->
<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/nav.php';

$myOrders = mysqli_prepare($conn, "SELECT * FROM customerorders  WHERE  CustomerID= ?");
mysqli_stmt_bind_param($myOrders, 'i', $_SESSION["loggedin"][0]["userid"]);
mysqli_stmt_execute($myOrders);
$result = mysqli_stmt_get_result($myOrders);

?>

<section class="jumbotron text-center">
    <div class="container">
        <!-- Might put a switch case here for displaying the appropriate status message depending on whether the payment succeeded or not -->
        <h1 class="jumbotron-heading">Uw orders</h1>
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
                            <th scope="col" >Aantal</th>
                            <th scope="col">Bestelnummer</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $subtotaal = 0;
                    $totaalbtw = 0;
                    $btwproduct = 0;
                    foreach ($result as $values) {

                    ?>
                        <tr>
                            <td><img src="https://dummyimage.com/50x50/55595c/fff" /> </td>
                            <td><?= $values["Description"] ?></td>
                            <td><?=$values["Quantity"]?></td>
                            <td><?=$values["OrderID"]?></td>

                            <!-- Hidden total cost -->

                        </tr>
                        </form>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include 'includes/footer.php' ?>