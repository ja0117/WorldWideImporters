<div class="col-lg-3">
        <h1 class="my-4">Categorieën</h1>
        <div class="list-group">
            <?php
        $sql = "SELECT StockGroupID, StockGroupName FROM stockgroups ORDER BY StockGroupID";
        $result = mysqli_query($conn, $sql);

        foreach ($result as $row) { ?>
          <a href="./CategoryPage.php?category=<?= $row['StockGroupID'];?>" class="list-group-item"><?= $row["StockGroupName"]; ?></a>
        <?php } ?>
        </div>
      </div>