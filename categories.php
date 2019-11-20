<?php include_once("databasecon.php"); ?>

<!DOCTYPE html>
<html>

<!-- HTML head -->
<?php include 'includes/searchHead.html'; ?>

<!-- Header & Nav bar -->
<?php include 'includes/headernav.php'; ?>

<body>

<div id="page-container">
   <div id="content-wrap">
       <h2> Categorieën </h2>

       <!-- Displaying all categories -->
        <?php
        $sql = "SELECT StockGroupID, StockGroupName FROM stockgroups ORDER BY StockGroupID";
        $result = mysqli_query($conn, $sql);

        foreach ($result as $row) { ?>
            <div class="card">
                <a href="./CategoryPage.php?category=<?= $row['StockGroupID'];?>">
                    <img style="width:250px; height:250px" src="images/<?php print substr($row["StockGroupName"], 0, 3) ?>.jpg">

                    <div class="container">
                    <h4><b><?= $row["StockGroupName"]; ?></b></h4></a>
                </div>
            </div>

        <?php }; ?>
    </div>
</div>

</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>