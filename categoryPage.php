<?php include_once("databasecon.php"); ?>

<!DOCTYPE html>
<html>

<!-- HTML head -->
<?php include 'includes/head.php'; ?>

<!-- Nav bar -->
<?php include 'includes/headernav.php';
?>

<body>

</div>
</div>
<!-- The dropdown from which you can select how many products you want to load per page. Form is submitted upon selection  -->
<form method="post">
    <!--The PHP compares each option with the current display amount setting and displays the corresponding one as selected  -->
    <select class="select-css" name="load" onchange='this.form.submit()'>>
        <option value= "25" <?php if ($_POST['load'] == "25" || !isset ($_POST['load'])) echo 'selected="selected" '; ?>>25</option>
        <option value="50" <?php if ($_POST['load'] == "50") echo 'selected="selected" '; ?>>50</option>
        <option value="100" <?php if ($_POST['load'] == "100") echo 'selected="selected" '; ?>>100</option>
    </select>
    <!--All the javascript does is wait until an option has been selected and submits the form when it is -->
    <noscript><input type="submit" value="Submit"></noscript>
</form>



<!-- Checks if the user has set a display limit. If not it will return 25 as a value to be used by default -->
<?php

$loadAmount = isLoadLimitSet();
$startAmount = starterAmount($loadAmount);


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

function starterAmount($loadAmount){

    if(!isset($_POST["page"])){
        return $startAmount = 0;
    }

    if($_POST["page"] == 1) {
        return $startAmount = 0;

    }

    if($_POST["page"] == 2) {
        return $startAmount = $loadAmount;

    }

    if($_POST["page"] == 3) {
        return $startAmount = $loadAmount + $loadAmount;

    }
}


//print substr($row["StockItemName"], 0, 3)


//     Get the category ID from the URL. This ID has been passed through the card link on the category page
$category = $_GET['category'];

//$categoryName = "SELECT StockGroupName FROM stockgroups WHERE StockGroupID = $category";

// It then fetches all products that are in the category with the ID fetched from the URL
$products = "SELECT Product.StockItemID, StockItemName, RecommendedRetailPrice
    FROM stockitems Product
    JOIN stockitemstockgroups Cat ON Product.StockItemID = Cat.StockItemID
    WHERE StockGroupID = $category LIMIT $startAmount, $loadAmount";

$result = mysqli_query($conn, $products);

foreach ($result as $row) { ?>
    <a href="productpagina.php?product=<?php print($row['StockItemID']); ?>">
        <div class="card">
            <img style="width:250px; height:250px" src="images/<?=$category?>.jpg">
            <div class="container">
                <h4><b><?= $row["StockItemName"];?></b></h4>
                <div id="itemPrice">
                    <?php print("&#8364;" . $row["RecommendedRetailPrice"] . ",-"); ?>
                </div>
            </div>
        </div>
    </a>
<?php }; ?>
</div>

</div>

<div style="margin-bottom: 45px; margin-top: 15px; text-align: center">
    <form method="POST">
        <input type="submit" name="page" value="1">
        <input type="submit" name="page" value="2">
        <input type="submit" name="page" value="3">

    </form>
    <?php print_r($result);?>
</div>

</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>
