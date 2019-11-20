<?php
include("databasecon.php");


if (isset($_GET["product"])) {
    $statement = mysqli_prepare($conn, "SELECT * FROM stockitems WHERE StockItemID = ?");

    mysqli_stmt_bind_param($statement, 'i', $_GET["product"]);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);

    if (isset($_GET["product"])) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row["StockItemName"];
                $price = $row["UnitPrice"];
                $description = $row["MarketingComments"];
                $btw = 1 + $row["TaxRate"] / 100;
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
    print($name)
    ?>
    </div>

    <div class="prijs">
        <?php
        print(  "€" .$price * $btw)
        ?>
    </div>

    <div class="desc">
        <?php
        print($description)
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
