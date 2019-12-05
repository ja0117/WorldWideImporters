<?php

include_once("databasecon.php");
include("shoppingCartCode.php");

?>

<!DOCTYPE html>
<html>

<!-- HTML head -->
<?php include 'includes/head.php'; ?>

<!-- Header & Nav bar -->
<?php include 'includes/headernav.php'; ?>

<head>
  <link rel="stylesheet" href="style/shoppingcart.css">
</head>

<body>

  <div class="page-container">

    <div class="shopping-cart">
      <!-- Title -->
      <div class="title">
        Winkelmand

      </div>

        <?php
        foreach ($_SESSION["shoppingCart"] as $values) { ?>
        <form method="post">
          <!-- Product #1 -->
          <table width="100%">
            <tr>
                <input type="hidden" name="hidden_productid" value="<?= $values["item_productid"] ?>">
                <div class="image">
                <th>
                  <img src="images/<?php print substr($values["item_productname"], 0, 3) ?>.jpg" width="128" height="128" />
                  </th>
                </div>



                <div class="description">
                <th>
                  <input type="text" size="45" value="<?= $values["item_productname"] ?>" readonly>
                  </th>
                </div>



              <div class="quantity">

                <th>
                  <input type="submit" name="increaseQuantity" value="+">
                </th>
                <th>
                  <input type="text" size="2" name="name" value="<?= $values["item_quantity"] ?>" readonly>
                </th>
                <th>
                  <input type="submit" name="decreaseQuantity" value="-">
                </th>
                <th>
                <input type="text" size="2" value="€<?= $values["item_productprice"] ?>" readonly>
                <input type="hidden" name="hidden_productprice" value="$<?= $values["item_singlePrice"] ?>">
                </th>
              </div>
    </div>
    </tr>


  </form>
  <?php } ?>
</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>