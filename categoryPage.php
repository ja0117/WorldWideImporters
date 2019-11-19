<?php
include_once("databasecon.php");
?>

<!-- HTML head -->
<?php include 'includes/head.php'; ?>

<body>
<!-- Nav bar -->
<?php include 'includes/nav.php'; ?>

<div id="page-container">
   <div id="content-wrap">


   <!-- Displaying all categories -->
    <?php
    $category = $_GET['category'];
    $categoryName = 'SELECT StockGroupName FROM stockgroups WHERE StockGroupID = $category';
    $products = "SELECT Product.StockItemID, StockItemName, RecommendedRetailPrice
    FROM stockitems Product
    JOIN stockitemstockgroups Cat ON Product.StockItemID = Cat.StockItemID
    WHERE StockGroupID = $category";



    $result = mysqli_query($conn, $products);


    foreach ($result as $row) { ?>
        <div class="card">
        <img src="img_avatar.jpg" alt="Avatar" style="width:100%">
        <div class="container">
        <h4><b><?= $row["StockItemName"]; ?></b></h4>
        <p><?= $row["RecommendedRetailPrice"]; ?>
        </div>
        </div>

    <?php }; ?>
    </div>
</div>

<footer> Copyright &copy; 2019, Wide World Importers</footer>

</body>
</html>