<?php include_once("databasecon.php"); ?>

<!DOCTYPE html>
<html>

<!-- HTML head -->
<?php include 'includes/head.php'; ?>

<!-- Header & Nav bar -->
<?php include 'includes/headernav.php'; ?>

<body>

<div>
    <h1> Welkom bij WWI!</h1>

    <?php
    $statement = mysqli_prepare($conn, "SELECT StockItemName, RecommendedRetailPrice, COUNT(T.StockItemID) FROM stockitems S JOIN stockitemtransactions T ON S.StockItemID = T.StockItemID  GROUP BY T.StockItemID ORDER BY COUNT(T.StockItemID) desc LIMIT 5");
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    foreach ($result as $row) {
        ?>
        <div class="card"?>
        <img style="Width: 250px; height: 250px;" src="images/<?php print substr($row["StockItemName"], 0, 3) ?>.jpg">
        <div class="container">
            <h4><b><?php print($row["StockItemName"]); ?></b></h4>
            <p><?php print("Prijs: ".$row["RecommendedRetailPrice"]); ?></p>
        </div>
        </div><?php } ?>

</div>

</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>