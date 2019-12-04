<?php

include_once("databasecon.php");
include("shoppingCartCode.php");

?>

<!DOCTYPE html>
<html>

<!-- HTML head -->
<?php include 'includes/head.php'; ?>

<!-- Header & Nav bar -->
<?php include 'includes/headernav.php'; ?>
<head>
    <link rel="stylesheet" href="style/shoppingcart.css">
</head>

<body>

<div class="page-container">
    <div id="cartOverview">
        <table border="1px solid black">
            <tr>
                <th>Artikelnummer</th>
                <th>Product naam</th>
                <th>Hoeveelheid</th>
                <th>Prijs</th>
            </tr>
            <?php
            foreach ($_SESSION['shoppingCart'] as $key=>$value) { ?>
            <tr>
                <?php
                foreach ($value as $key2 => $value2) { ?>

                    <td><?php echo $value2; ?></td>
                    <?php
                }
                }
                ?>
            </tr>
        </table>
    </div>
</div>

</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>