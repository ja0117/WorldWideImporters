<?php include_once("databasecon.php"); ?>



<!-- HTML head -->
<?php include 'includes/head.php'; ?>

<!-- Header & Nav bar -->
<?php include 'includes/headernav.php'; ?>
<?php include 'shoppingCartCode.php'; ?>
<!DOCTYPE html>
<html lang="en">

<?php include 'includes/head.php' ?>

<body>

  <!-- Navigation -->
  <?php include 'includes/nav.php' ?>

  <div class="container">

    <div class="row">

      <?php include 'includes/categorySidebar.php' ?>

      <?php include 'includes/carousel.php' ?>

        <div class="row">

        <?php
            $statement = mysqli_prepare($conn, "SELECT T.StockItemID, StockItemName, TaxRate, COUNT(T.StockItemID), UnitPrice
            FROM stockitems S JOIN stockitemtransactions T ON S.StockItemID = T.StockItemID
            GROUP BY T.StockItemID ORDER BY COUNT(T.StockItemID) desc LIMIT 5");
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            foreach ($result as $row) {
                $btw = $row["TaxRate"] / 100 + 1;
                ?>
                <!--A link to its own page is created based on its ID      -->
                <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                <a href="productpagina.php?product=<?php print($row['StockItemID']); ?>"><img class="card-img-top" src="images/<?php print substr(str_replace('"', '',$row["StockItemName"]), 0, 3) ?>.jpg" alt=""></a>
                <div class="card-body">
                <h4 class="card-title">
                <a href="productpagina.php?product=<?php print($row['StockItemID']); ?>"><?= $row["StockItemName"] ?></a>
            </h4>
            <h5><?= $row["UnitPrice"] * $btw ?></h5>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
            <form method="post">
                    <?php print("Prijs: " . $row["UnitPrice"] * $btw); ?>
                    <input type="hidden" name="hidden_productid" value="<?= $row['StockItemID']; ?>">
                    <input type="hidden" name="hidden_productname" value="<?= str_replace('"', '',$row['StockItemName']) ?>">
                    <input type="hidden" name="hidden_productprice" value="<?= $row["UnitPrice"] * $btw ?>">
                    <input type="hidden" name="quantity" value="1">
                    <input type="submit" name="add_to_cart" class="btn btn-primary" value="toevoegen aan winkelmand">
                    </form>
              </div>
              <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
              </div>
            </div>
          </div>

<?php } ?>

          </div>
      </div>
    </div>
  </div>

  <?php include 'includes/footer.php' ?>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>