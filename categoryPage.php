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
  <select name="load">
    <option value=25>25</option>
    <option value=50>50</option>
    <option value=100>100</option>
  </select>
  <input type="submit" value="Submit">
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

    $loadAmount = isLimitSet();

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