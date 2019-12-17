<?php include_once("databasecon.php"); ?>



<!-- HTML head -->
<?php include 'includes/head.php'; ?>

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
            <div class="col-auto"><p class="badge badge-danger" style="width: 825px">Populaire producten</p></div>
        </div>
        <div class="row">

        <?php
            $statement = mysqli_prepare($conn, "SELECT T.StockItemID, StockItemName, TaxRate, COUNT(T.StockItemID), UnitPrice
            FROM stockitems S JOIN stockitemtransactions T ON S.StockItemID = T.StockItemID
            GROUP BY T.StockItemID ORDER BY COUNT(T.StockItemID) desc LIMIT 9");
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
                <p6 class="card-title">
                <a href="productpagina.php?product=<?php print($row['StockItemID']); ?>"><?= $row["StockItemName"] ?></a>
            </p6>
            <h4><?= "€" . number_format((float) $row["UnitPrice"] * $btw , 2, ',', '') ?></h4>

              </div>
              <div class="card-footer">
                  <form method="post">
                      <input type="hidden" name="hidden_productid" value="<?= $row['StockItemID']; ?>">
                      <input type="hidden" name="hidden_productname" value="<?= str_replace('"', '',$row['StockItemName']) ?>">
                      <input type="hidden" name="hidden_productprice" value="<?= $row["UnitPrice"]?>">
                      <input type="hidden" name="hidden_taxrate" value="<?= $row['TaxRate']; ?>">
                      <input type="hidden" name="quantity" value="1">
                      <input type="submit" name="add_to_cart" class="btn btn-primary" value="Toevoegen aan winkelmand">
                  </form>
              </div>
            </div>
          </div>

<?php } ?>
            <div class="col-auto"><p class="badge badge-danger" style="width: 825px;">Producten in de aanbieding</p></div>
            </div>
            <div class="row">

        <?php
            $statement = mysqli_prepare($conn, "SELECT T.StockItemID, StockItemName, DiscountPercentage, TaxRate, S.UnitPrice, EndDate
            FROM stockitems S JOIN specialdeals T ON S.StockItemID = T.StockItemID LIMIT 9");
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            foreach ($result as $row) {
                $btw = $row["TaxRate"] / 100 + 1;
                ?>
                <!--A link to its own page is created based on its ID      -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100" style="height: 420px">
                        <a href="productpagina.php?product=<?php print($row['StockItemID']); ?>"><img class="card-img-top" src="images/<?php print substr(str_replace('"', '',$row["StockItemName"]), 0, 3) ?>.jpg" alt=""></a>
                        <div class="card-body">
                            <p6 class="card-title"><a href="productpagina.php?product=<?php print($row['StockItemID']); ?>"><?= $row["StockItemName"] ?></a></p6>
                                <h4 style="color: red"><strike style="color: black"><?= "€" . number_format((float)($row['UnitPrice'] * $btw), 2, ',', '') ?></strike> -<?php print(number_format((float)($row['DiscountPercentage']), 0, ',', '')).'%'?>
                                    <h4><?= "€" . number_format((float)($row['UnitPrice'] * $btw)*(1-$row["DiscountPercentage"]/100), 2, ',', '') ?></h4>
                                        <p6 class="badge badge-danger">Geldig tot <?php print($row['EndDate']);?></p6>

                        </div>
                        <div class="card-footer">
                            <form method="post">
                                <input type="hidden" name="hidden_productid" value="<?= $row['StockItemID']; ?>">
                                <input type="hidden" name="hidden_productname" value="<?= str_replace('"', '',$row['StockItemName']) ?>">
                                <input type="hidden" name="hidden_productprice" value="<?= $row["UnitPrice"] * $btw ?>">
                                <input type="hidden" name="quantity" value="1">
                                <input type="submit" name="add_to_cart" class="btn btn-primary" value="Toevoegen aan winkelmand">
                            </form>
                        </div>
                    </div>
                </div>

            <?php } ?>

          </div>
      </div>
    </div>
  </div>

  <?php include 'includes/footer.php' ?>

  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>