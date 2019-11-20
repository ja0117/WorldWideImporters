<?php include_once("databasecon.php"); ?>

<!DOCTYPE html>
<html>

<!-- HTML head -->
<?php include 'includes/head.php'; ?>

<!-- Header & Nav bar -->
<?php include 'includes/headernav.php'; ?>

<body>

<div>
    <h1><Marquee>Populaire producten - 24/7 geopend!</Marquee></h1>

    <?php
    $statement = mysqli_prepare($conn, "SELECT T.StockItemID, StockItemName, TaxRate, COUNT(T.StockItemID), UnitPrice 
FROM stockitems S JOIN stockitemtransactions T ON S.StockItemID = T.StockItemID  
GROUP BY T.StockItemID ORDER BY COUNT(T.StockItemID) desc LIMIT 5");
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    foreach ($result as $row) {
        $btw = $row["TaxRate"] / 100 + 1;
        ?>
        <a href="productpagina.php?product=<?php print($row['StockItemID']); ?>">
            <div class="card">
            <i><img style="Width: 250px; height: 250px;" src="images/<?php print substr($row["StockItemName"], 0, 3) ?>.jpg"></i>
            <div class="container">
                <h4><b><?php print($row["StockItemName"]); ?></b></h4>
                <p><?php print("Prijs: ".$row["UnitPrice"] * $btw); ?></p>
            </div>
            </div>
        </a>
            <?php } ?>

</div>

</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>