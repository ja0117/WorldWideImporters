<?php include_once("databasecon.php"); ?>

<!DOCTYPE html>
<html>

<!-- HTML head -->
<?php include 'includes/head.php'; ?>

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
                <img src="images/img_avatar.jpg" alt="Avatar" style="width:100%">
                <div class="container">
                    <h4><b><?= $row["StockGroupName"]; ?></b></h4>
                </div>
            </div>

        <?php }; ?>
    </div>
</div>

</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>