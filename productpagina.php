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
else{
}

?>
<!DOCTYPE html>
<html>
<!-- HTML head -->
<?php include 'includes/head.php'; ?>

<!-- Header & Nav bar -->
<?php include 'includes/headernav.php'; ?>
<head>
    <link rel="stylesheet" href="style/productpage.css">
    <link rel="stylesheet" href="style/imagezoom.css">
</head>

<?php
$products = "SELECT si.StockItemID, StockItemName, UnitPrice, StockGroupID
    FROM stockitems si
    JOIN stockitemstockgroups sisg ON si.StockItemID = sisg.StockItemID";

$resultProducts = mysqli_query($conn, $products);
?>

<body>
<?php if (isset($_GET["product"]) && mysqli_num_rows($result) > 0) { ?>
    <div class="row">
    <div class="column">
    <div class="image">
        <img style="width:400px; height:400px" src="images/<?=$category?>.jpg">
    </div>
    </div>
    <div class="column">
    <div class="naam">
    <?php
    print($name . "<br>")
    ?>
        <span style="font-size: 75%">
            <?php        if($voorraad >= 1){
            print($voorraad . " stuks op voorraad! <br>");
             }
              else{
            print("Product niet meer op voorraad! <br>");
        }
        ?>
        </span>
    </div>

    <div class="prijs">
        <?php
        print("<br> Adviesprijs: €" . $prijselders . "<br>");
        print("Onze prijs: €" .$price * $btw ."<br>");
        ?>
    </div>

    <div class="desc">
        <?php
        print("Gewicht: " .$gewicht ."kg <br>" );
        print($description);
        ?>
    </div>
    <div align="right">
        <form method="post" action="">
            <input type="hidden" name="quantity" value=1>
            <input type="hidden" name="hidden_productid" value="<?php echo $itemID; ?>" >
            <input type="hidden" name="hidden_productname" value="<?php echo str_replace('"', ' ', $name); ?>">
            <input type="hidden" name="hidden_productprice" value="<?php echo $price * $btw; ?>">
            <input type="submit" name="add_to_cart" value="Toevoegen aan winkelwagen" class="button">
        </form>
    </div>
    </div>
    </div>
    

    <div class="row">
    <div class="column">
    <div class="image">
        <img style="width:400px; height:400px" src="images/<?=$category?>.jpg">
    </div>
    </div>
    </div>
    </div>

    

    
<?php }
else { ?>

<h1>Dit product bestaat helaas niet.</h1>
<?php } ?>

</body>

<?php include 'includes/footer.php'; ?>


</html>