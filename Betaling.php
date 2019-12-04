<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">

<!-- HTML head -->
<?php include 'includes/head.php'; ?>

<!-- Header & Nav bar -->
<?php include 'includes/headernav.php'; ?>
<head>
    <link rel="stylesheet" href="style/betaling.css">
</head>

<body>

<div class="page-container">

<form method="post" action="idealbetaling.php">
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

    <?php
    $btw=21;
    $product1="boter";
    $product2="kaas";
    $prijsproduct1=4;
    $prijsproduct2=3;
    $btwproduct1=$prijsproduct1*($btw/100+1)-$prijsproduct1;
    $btwproduct2=$prijsproduct2*($btw/100+1)-$prijsproduct2;
    $btwtotaal=$btwproduct1+$btwproduct2;
    $subtotaal=$prijsproduct1+$prijsproduct2;
    $totaal=$subtotaal+$btwtotaal;
    ?>
    <input type="hidden" name="totaalPrijs" value="<?php echo $totaal ?>">

    <div class="bestelling"><h2>Uw bestelling</h2><br>
        <table>
            <tr>
                <th><u>Product</u></th>
                <th><u>Totaal</u></th>
            </tr>
            <tr>
                <td><?php print($product1) ?></td>
                <td><?php print("€ ".$prijsproduct1) ?></td>
                <td></td>
            </tr>
            <tr>
                <td><?php print($product2) ?></td>
                <td><?php print("€ ".$prijsproduct2) ?></td>
            </tr>
            <tr>
                <td><b><u>Subtotaal</u></b></td>
                <td><b><u><?php print("€ ". ($prijsproduct1+$prijsproduct2)) ?></u></b></td>
            </tr>
            <tr>
                <td><b><u><?php print($btw."% "."BTW") ?></u></b></td>
                <td><b><u><?php print("€ ".($btwtotaal)) ?></u></b></td>
            </tr>
            <tr>
                <td><b><u>Totaal</u></b></td>
                <td><b><u><?php print("€ ".($totaal)) ?></u></b></td>
            </tr>

        </table><br>

            <input class="Voorwaarden" type="checkbox" value="checkbox" required> Ik heb nogmaals naar<br>mijn producten gekeken<br>en wil ze echt bestellen<br><br>
            <input type="submit" value="Bestelling plaatsen" class="Betalen">
    </div>
</div>

</form>


</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>
