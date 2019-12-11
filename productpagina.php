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
            <h2 class="card-title"><?= $name ?></h2>
              <h3 style="font-size: 100%">
              <?php
               if ($voorraad >= 250){
                   print("Op voorraad!");
               }
               if($voorraad > 0 && $voorraad < 250){
                   print("Bijna uitverkocht!");
               }
               if ($voorraad == 0){
                   print("Niet op voorraad");
               };
               ?>
              </h3>
              <h4 style="color: red"><strike> <?php echo "€" . $prijselders ?> </strike></h4>
              <h3>Incl. BTW € <?php echo number_format((float) $price * $btw , 2, '.', '')?> </h3>
            <h3>Excl. BTW €<?= $price ?></h3>
              <h4><?php $description ?> </h4>
            <p class="card-text"><?= $description ?></p>
            <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
            4.0 stars
          </div>
        </div>       
      </div>
    
    </div>
      <div align="right">
          <form method="post" action="">
              <input type="hidden" name="quantity" value=1>
              <input type="hidden" name="hidden_productid" value="<?php echo $itemID; ?>" >
              <input type="hidden" name="hidden_productname" value="<?= str_replace('"', '',$row['StockItemName']) ?>">
              <input type="hidden" name="hidden_productname" value="<?php echo str_replace('"', ' ', $name); ?>">
              <input type="hidden" name="hidden_productprice" value="<?php echo $price * $btw; ?>">
              <input type="submit" name="add_to_cart" value="Toevoegen aan winkelwagen" class="button">
          </form>
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