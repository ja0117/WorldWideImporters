<?php include_once("databasecon.php"); ?>

<!DOCTYPE html>
<html>

<!-- HTML head -->
<?php include 'includes/searchHead.html'; ?>

<!-- Nav bar -->
<?php include 'includes/headernav.php';
?>

<body>

  </div>
</div>

<form method="post">

  <select class="select-css" name="load" onchange='this.form.submit()'>>
    <option value= "25" <?php if ($_POST['load'] == "25") echo 'selected="selected" '; ?>>25</option>
    <option value="50" <?php if ($_POST['load'] == "50") echo 'selected="selected" '; ?>>50</option>
    <option value="100" <?php if ($_POST['load'] == "100") echo 'selected="selected" '; ?>>100</option>
  </select>
  <noscript><input type="submit" value="Submit"></noscript>
</form>



   <!-- Displaying all categories -->
   <?php

    
    function isLoadLimitSet()
    {
            if(isset($_POST['load']))
            {
                return $_POST['load'] ;
            }
            else{
                return 25 ;
            }
            
    }
//Checking if the user has chosen a display limit. Otherwise it uses a default value of 25

$loadAmount = isLoadLimitSet();



    $category = $_GET['category'];

    $categoryName = "SELECT StockGroupName FROM stockgroups WHERE StockGroupID = $category";

    $products = "SELECT Product.StockItemID, StockItemName, RecommendedRetailPrice
    FROM stockitems Product
    JOIN stockitemstockgroups Cat ON Product.StockItemID = Cat.StockItemID
    WHERE StockGroupID = $category LIMIT $loadAmount";

    $result = mysqli_query($conn, $products);
    $nameQuery = mysqli_query($conn, $categoryName);

    foreach ($result as $row) { ?>
        <a href="productpagina.php?product=<?php print($row['StockItemID']); ?>">
        <div class="card">
            <img style="width:250px; height:250px" src="images/<?php print substr($row["StockItemName"], 0, 3) ?>.jpg">
            <div class="container">
                <h4><b><?= $row["StockItemName"]; ?></b></h4>
                <div id="itemPrice">
                    <?php print("&#8364;" . $row["RecommendedRetailPrice"] . ",-"); ?>
                </div>
            </div>
        </div>
        </a>
    <?php }; ?>
    </div>
</div>

</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>