<?php include_once("databasecon.php"); ?>



<!-- HTML head -->
<?php include 'includes/head.php'; ?>

<?php include 'shoppingCartCode.php'; ?>
<!DOCTYPE html>
<html lang="en">

<?php include 'includes/head.php' ?>

<body>

<!-- Navigation -->
<?php include 'includes/nav.php' ?>

<div class="container">

    <div class="row">


            <div class="col-md-12">
        <!-- The dropdown from which you can select how many products you want to load per page. Form is submitted upon selection  -->
         <div class="form-group">
        <form method="post">
            <!--The PHP compares each option with the current display amount setting and displays the corresponding one as selected  -->
            <label for="">Aantal producten per pagina</label>
            <select class="form-control" name="load" onchange='this.form.submit()'>>

                <?php $aantal = 25;
                if (isset($_POST['load'])){
                    $aantal = $_POST['load'];
                }
                ?>

                <option value= "25" <?php if ($aantal == "25") echo 'selected="selected" '; ?>>25</option>
                <option value="50" <?php if ($aantal == "50") echo 'selected="selected" '; ?>>50</option>
                <option value="100" <?php if ($aantal == "100") echo 'selected="selected" '; ?>>100</option>
            </select>
            <br>
            <!--All the javascript does is wait until an option has been selected and submits the form when it is -->
            <noscript><input type="submit" value="Submit"></noscript>
        </form>

        <form method="post">
            <!--The PHP compares each option with the current display amount setting and displays the corresponding one as selected  -->
            <label for="">Sorteren op prijs</label>
            <select class="form-control" name="orderby" onchange='this.form.submit()'>>

                <?php $orderBy = "";
                if (isset($_POST['orderby'])){
                    $orderBy = $_POST['orderby'];
                }
                ?>

                <option value= "oplopend" <?php if ($orderBy == "oplopend") echo 'selected="selected" '; ?>>Laag-Hoog</option>
                <option value="aflopend" <?php if ($orderBy == "aflopend") echo 'selected="selected" '; ?>>Hoog-Laag</option>
            </select>
            <br>
            <!--All the javascript does is wait until an option has been selected and submits the form when it is -->
            <noscript><input type="submit" value="Submit"></noscript>
        </form>
         </div>
            </div>





        <!-- Checks if the user has set a display limit. If not it will return 25 as a value to be used by default -->
        <?php

        $loadAmount = isLoadLimitSet();
        $startAmount = starterAmount($loadAmount);
        $paginaNu = currentPage();
        $orderBy = OrderBy();


        function isLoadLimitSet()
        {
            if(isset($_POST['load']))
            {
                return $_POST['load'] ;
            }
            else{
                return 25 ;
            }

        }

        function OrderBy(){
            if(!isset($_POST["orderby"])){
                return $orderBy = "";
            }
            if ($_POST["orderby"] == "oplopend"){
                return $orderBy = "ORDER BY Product.UnitPrice ASC";
            }
            if ($_POST["orderby"] == "aflopend"){
                return $orderBy = "ORDER BY Product.UnitPrice DESC";
            }



        }


        function starterAmount($loadAmount){

            if(!isset($_POST["page"])){
                return $startAmount = 0;
            }
            if($_POST["page"] == 1) {
                return $startAmount = 0;

            }
            if($_POST["page"] == 2) {
                return $startAmount = $loadAmount;

            }
            if($_POST["page"] == 3) {
                return $startAmount = $loadAmount + $loadAmount;

            }
            if($_POST["page"] == 4) {
                return $startAmount = $loadAmount + $loadAmount + $loadAmount;

            }
            if($_POST["page"] == 5) {
                return $startAmount = $loadAmount + $loadAmount + $loadAmount + $loadAmount;

            }
            if($_POST["page"] == 6) {
                return $startAmount = $loadAmount + $loadAmount + $loadAmount + $loadAmount + $loadAmount;

            }
        }

        function currentPage(){
            if(!isset($_POST["page"])){
                return $paginaNu = 1;
            }

            if($_POST["page"] == 1) {
                return $paginaNu = 1;

            }
            if($_POST["page"] == 2) {
                return $paginaNu = 2;

            }
            if($_POST["page"] == 3) {
                return $paginaNu = 3;

            }
            if($_POST["page"] == 4) {
                return $paginaNu = 4;

            }
            if($_POST["page"] == 5) {
                return $paginaNu = 5;

            }
            if($_POST["page"] == 6) {
                return $paginaNu = 6;

            }
        }

        //print substr($row["StockItemName"], 0, 3)


        //     Get the category ID from the URL. This ID has been passed through the card link on the category page
        //     Default categorie 1 ingeladen wanneer categorie ontbreekt in de URL
        $category = isset($_GET['category']) ? $_GET['category'] : "1";

        //$categoryName = "SELECT StockGroupName FROM stockgroups WHERE StockGroupID = $category";

        // It then fetches all products that are in the category with the ID fetched from the URL
        $products = "SELECT  Product.StockItemID, Product.UnitPrice, Product.TaxRate, StockItemName, RecommendedRetailPrice, MarketingComments
    FROM stockitems Product
    JOIN stockitemstockgroups Cat ON Product.StockItemID = Cat.StockItemID
    WHERE StockGroupID = $category 
    $orderBy
    LIMIT $startAmount, $loadAmount";

        $products2 = "SELECT stockitems.StockItemID
    FROM stockitems 
    JOIN stockitemstockgroups  ON stockitems.StockItemID = stockitemstockgroups.StockItemID
    WHERE StockGroupID = $category";

        $result = mysqli_query($conn, $products);
        $result2 = mysqli_query($conn, $products2);


        $totaalgeladen = 0;
        foreach ($result2 as $loadedItem){
            $totaalgeladen = $totaalgeladen + 1;
        }
        $paginas = ceil($totaalgeladen / $loadAmount);
        foreach ($result as $row) {
            $btw = $row["TaxRate"] / 100 + 1;
            ?>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="productpagina.php?product=<?php print($row['StockItemID']); ?>"><img class="card-img-top"  src="images/<?php print (str_replace($stringReplace, '-',$row["StockItemName"])) ?>.jpg" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="productpagina.php?product=<?php print($row['StockItemID']); ?>"><?= $row["StockItemName"] ?></a>
                        </h4>
                        <h5>€<?= number_format((float) $row["UnitPrice"] * $btw , 2, ',', '')  ?></h5>
                        <p class="card-text"><?php echo $row["MarketingComments"] ?> </p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    </div>
                </div>
            </div>


        <?php }; ?>
    </div>

</div>

<div style="margin-bottom: 45px; margin-top: 15px; text-align: center">
    <form method="POST">
        <?php
        print("Je zit nu op pagina ". $paginaNu . " van " . $paginas . "<br>");
        for($i = 1; $i <= $paginas; $i++){ ?>

            <input type="submit" name="page" value="<?php print($i); ?>">

            <?php
        }

        ?>
        <input type="hidden" name="load" value="<?php echo $loadAmount ?>"/>
        <input type="hidden" name="orderby" value="<?php echo $orderBy ?>"/>

    </form>
</div>

</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>
