<?php
include_once("databasecon.php");


if (isset($_GET["test"])) {
    $statement = mysqli_prepare($conn, "SELECT * FROM stockitems WHERE StockItemID = ?");

    mysqli_stmt_bind_param($statement, 'i', $_GET["test"]);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);

    if (isset($_GET["test"])) {
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
    print("Product niet gevonden!");
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
</head>

<body>

<div class="image">
    <img src="images/img_avatar.jpg" alt="Avatar" style="width:100%">

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

<div class="button">
<button type="button" onclick="alert('dit is helaas nog niet af')">Add to cart</button>
</div>

</body>

<?php include 'includes/footer.php'; ?>
</html>
