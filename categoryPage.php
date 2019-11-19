<?php include_once("databasecon.php"); ?>

<!DOCTYPE html>
<html>

<!-- HTML head -->
<?php include 'includes/head.php'; ?>

<!-- Nav bar -->
<?php include 'includes/headernav.php'; ?>

<body>

<div id="page-container">
   <div id="content-wrap">

   <!-- Displaying all categories -->
    <?php
    $category = $_GET['category'];

    $categoryName = "SELECT StockGroupName FROM stockgroups WHERE StockGroupID = $category";

    $products = "SELECT Product.StockItemID, StockItemName, RecommendedRetailPrice
    FROM stockitems Product
    JOIN stockitemstockgroups Cat ON Product.StockItemID = Cat.StockItemID
    WHERE StockGroupID = $category";

    $result = mysqli_query($conn, $products);
    $nameQuery = mysqli_query($conn, $categoryName);

    foreach ($result as $row) { ?>
        <div class="card">
            <img src="images/img_avatar.jpg" alt="Avatar" style="width:100%">
            <div class="container">
                <h4><b><?= $row["StockItemName"]; ?></b></h4>
                <p><?= $row["RecommendedRetailPrice"]; ?>
            </div>
        </div>

    <?php }; ?>
    </div>
</div>

</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>