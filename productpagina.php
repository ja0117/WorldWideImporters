<?php
include("databasecon.php");


if (isset($_GET["product"])) {
    $statement = mysqli_prepare($conn, "SELECT * FROM stockitems WHERE StockItemID = ?");
    $statement2 = mysqli_prepare($conn, "SELECT QuantityOnHand FROM stockitemholdings WHERE StockItemID = ?");

    mysqli_stmt_bind_param($statement, 'i', $_GET["product"]);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);

    mysqli_stmt_bind_param($statement2, 'i', $_GET["product"]);
    mysqli_stmt_execute($statement2);
    $result2 = mysqli_stmt_get_result($statement2);

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

<body>
<?php if (isset($_GET["product"]) && mysqli_num_rows($result) > 0) { ?>

    <div class="image">
        <img src="images/<?php print(substr($name, 0, 3)); ?>.jpg" alt="Avatar" style="width:100%">

    </div>

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
        <button class="button" onclick="alert('dit is helaas nog niet af')">Add to cart</button>
    </div>
<?php }
else { ?>

<h1>Dit product bestaat helaas niet.</h1>
<?php } ?>

</body>

<?php include 'includes/footer.php'; ?>
</html>
