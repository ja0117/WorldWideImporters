<?php include_once("databasecon.php"); ?>

<!DOCTYPE html>
<html>

<!-- HTML head -->
<?php include 'includes/searchHead.html'; ?>

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
            <img style="width:250px; height:250px" src="images/<?php print substr($row["StockItemName"], 0, 3) ?>.jpg">
            <div class="container">
                <h4><b><?= $row["StockItemName"]; ?></b></h4>
                <div id="itemPrice">
                    <?php print("&#8364;" . $row["RecommendedRetailPrice"] . ",-"); ?>
                </div>
            </div>
        </div>

    <?php }; ?>
    </div>
</div>

</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>