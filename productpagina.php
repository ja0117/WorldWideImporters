<?php
include("databasecon.php");
include("shoppingCartCode.php");


if (isset($_GET["product"])) {
    $statement = mysqli_prepare($conn, "SELECT * FROM stockitems WHERE StockItemID = ?");
    $statement2 = mysqli_prepare($conn, "SELECT QuantityOnHand FROM stockitemholdings WHERE StockItemID = ?");
    $statement3 = mysqli_prepare($conn, "SELECT StockGroupID FROM stockitemstockgroups WHERE StockItemID = ?");

    mysqli_stmt_bind_param($statement, 'i', $_GET["product"]);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);

    mysqli_stmt_bind_param($statement2, 'i', $_GET["product"]);
    mysqli_stmt_execute($statement2);
    $result2 = mysqli_stmt_get_result($statement2);

     mysqli_stmt_bind_param($statement3, 'i', $_GET["product"]);
     mysqli_stmt_execute($statement3);
     $result3 = mysqli_stmt_get_result($statement3);

    if (isset($_GET["product"])) {
        if (mysqli_num_rows($result3) > 0) {
            while ($row3 = mysqli_fetch_assoc($result3)) {
                $category = $row3["StockGroupID"];
            }
        }
    }




    if (isset($_GET["product"])) {
        if (mysqli_num_rows($result2) > 0) {
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $voorraad = $row2["QuantityOnHand"];
            }
        }
    }


    if (isset($_GET["product"])) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $itemID = $row["StockItemID"];
                $name = $row["StockItemName"];
                $price = $row["UnitPrice"];
                $description = $row["MarketingComments"];
                $btw = 1 + $row["TaxRate"] / 100;
                $gewicht = $row["TypicalWeightPerUnit"];
                $prijselders = $row["RecommendedRetailPrice"];
            }
        }
    }

}


?>




<!DOCTYPE html>
<html lang="en">

<?php include 'includes/head.php' ?>
<body>
<?php
$products = "SELECT si.StockItemID, StockItemName, UnitPrice, StockGroupID
    FROM stockitems si
    JOIN stockitemstockgroups sisg ON si.StockItemID = sisg.StockItemID";

$resultProducts = mysqli_query($conn, $products);
?>




  <?php include 'includes/nav.php' ?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

     <?php include 'includes/categorySidebar.php' ?>
        
      <!-- /.col-lg-3 -->
        
      <div class="col-lg-9">
        <div class="card mt-4 mb-10">
          <img class="card-img-top img-fluid" src="images/<?=$category?>.jpg" alt="">
          <div class="card-body">
            <h3 class="card-title"><?= $name ?></h3>
            <h4>$<?= $price ?></h4>
            <p class="card-text"><?= $description ?></p>
            <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
            4.0 stars
          </div>
        </div>       
      </div>
    
    </div>
  </div>
  </br>
  </br>
  </br>
  </br>
  </br>
  </br>
        

  <?php include 'includes/footer.php' ?>

  <!-- Bootstrap core JavaScript -->
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>