<?php
include_once("databasecon.php");
?>

<!-- HTML head -->
<?php include 'includes/head.php'; ?>

<body>
<!-- Nav bar -->
<?php include 'includes/nav.php'; ?>

<div id="page-container">
   <div id="content-wrap">
   <h2> Categorieën </h2>

   <!-- Displaying all categories -->
    <?php
    $sql = 'SELECT * FROM stockgroups';
    $result = mysqli_query($conn, $sql);

    foreach ($result as $row) { ?>
        <div class="card">
        <img src="img_avatar.jpg" alt="Avatar" style="width:100%">
        <div class="container">
        <h4><b><?= $row["StockGroupName"]; ?></b></h4>
        <a href="./CategoryPage.php?category=<?= $row['StockGroupID'] ?>">
        </div>
        </div>

    <?php }; ?>
    </div>
</div>

<footer> Copyright &copy; 2019, Wide World Importers</footer>

</body>
</html>

