<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">

<!-- HTML head -->
<?php include 'includes/head.php'; ?>

<head>
    <link rel="stylesheet" href="style/betaling.css">
</head>
<?php include 'shoppingCartCode.php'; ?>

<body>

<div class="page-container">

<form method="post" action="">
    <div class="factuur"><h2>Factuurgegevens</h2><br>
        <span class="Voornaam">Voornaam:<br>
        <input class="links" type="text" name="Vnaam" required></span>
            <span class="Achternaam">Achternaam:<br>
            <input class="rechts" type="text" name="Anaam" required></span><br>
                <span class="Straatnaam">Straatnaam:<br>
                <input class="links" type="text" name="Snaam" required></span>
                    <span class="Huisnummer">Huisnr:<br>
                    <input class="rechts" type="number" name="Hnummer" required></span><br>
                        <span class="Landnaam">landnaam:<br>
                        <select class="midden" required>
                    <option value="Ned">Nederland</option>
                    <option value="Ger">Duitsland</option>
                    <option value="Fr">Frankrijk</option>
                    <option value="Esp">Spanje</option>
                    <option value="Au">Oostenrijk</option>
                    <option value="Ru">Rusland</option>
                    <option value="Ita">Italië</option>
                    <option value="Be">België</option>
                    <option value="Sw">Zwitserland</option>
                    <option value="Ovg">Overig</option>
                        </select><br>
                    <span class="Plaatsnaam">Plaats:<br>
                    <input class="links" type="text" name="Pnaam" required></span>
                <span class="Postcode">Postcode:<br>
                <input class="rechts" type="text" name="Pcode" required></span><br>
            <span class="Email-adres">Email-adres:<br>
            <input class="links" type="email" name="Email" required></span>
        <span class="Telefoonnummer">Telefoonnummer:<br>
        <input class="rechts" type="number" name="Telnr" required></span>
    </div>


    <div class="bestelling"><h2>Uw bestelling</h2><br>
        <table class="table" >
            <tr>
                <th class="head"><u>Product</u></th>
                <th class="head"><u>Totaal</u></th>
            </tr>

            <?php
            $totaal=0;
            foreach ($_SESSION["shoppingCart"] as $values) {
                $totaal=$totaal+$values["item_productprice"]
                ?>
            <tr>
                <td><?php print ($values["item_quantity"]." ".$values["item_productname"]) ?></td>
                <td><?php print("€ ".number_format((float)$values["item_productprice"], 2, '.', ''));;?></td>
            </tr>
            <?php } ?>
                <td><b><u>Totaal</u></b></td>
                <td><b><u><?php print("€ ". ($totaal)) ?></u></b></td>
            </tr>
        </table><br>

            <input type="submit" value="Bestelling plaatsen" class="Betalen">
    </div>
</div>

<input type="hidden" name="totaalPrijs" value="<?php echo $totaal ?>">

</form>


</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>
