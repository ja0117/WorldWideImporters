<?php include 'includes/head.php';

$price = $_SESSION["orderCost"];


$subtotaal = 0;
$totaalbtw = 0;
$btwproduct = 0;
foreach ($_SESSION["shoppingCart"] as $values)
{
$subtotaal = $subtotaal + $values["item_productprice"];
$btwproduct = $values["item_productprice"] * $values["item_taxrate"] / 100;
$totaalbtw = $totaalbtw + $btwproduct;
}
$dePamirConstante = $subtotaal + $totaalbtw;


//if($dePamirConstante != $price){
//    header("Location: orderComplete.php");}



?>


<html>

<body cz-shortcut-listen="true">

<div class="card text-center" style="margin-top: 120px">
    <div class="card-header">
        <h2>iDEAL Payment</h2>
    </div>
    <div class="card-body" style="text-align: center">
        <p class="card-text"><img src="ideal/betaling_files/ideal.png" style="height: 175px; 225px"></p>
        <form method="post">
            <input name="form" type="hidden" value="payment">
            <input name="url_success" type="hidden" value="https://www.ideal-checkout.nl/demo/idealcheckout-betaalformulier/idealcheckout/return.php?transaction_id=f7Di1F5HqWSATjcXeLY8l0Bz1MpbMU41&amp;transaction_code=0dJ2MjrqaproZ4w9vBPaQRtGmCczWqXf&amp;status=SUCCESS">
            <input name="url_pending" type="hidden" value="https://www.ideal-checkout.nl/demo/idealcheckout-betaalformulier/idealcheckout/return.php?transaction_id=f7Di1F5HqWSATjcXeLY8l0Bz1MpbMU41&amp;transaction_code=0dJ2MjrqaproZ4w9vBPaQRtGmCczWqXf&amp;status=PENDING">
            <input name="url_cancel" type="hidden" value="https://www.ideal-checkout.nl/demo/idealcheckout-betaalformulier/idealcheckout/return.php?transaction_id=f7Di1F5HqWSATjcXeLY8l0Bz1MpbMU41&amp;transaction_code=0dJ2MjrqaproZ4w9vBPaQRtGmCczWqXf&amp;status=CANCELLED">
            <input name="url_error" type="hidden" value="https://www.ideal-checkout.nl/demo/idealcheckout-betaalformulier/idealcheckout/return.php?transaction_id=f7Di1F5HqWSATjcXeLY8l0Bz1MpbMU41&amp;transaction_code=0dJ2MjrqaproZ4w9vBPaQRtGmCczWqXf&amp;status=FAILURE">
                <tr >
                    <td width="150"><b>Betaalmethode:</b></td>
                    <td>iDEAL</td>
                </tr><br>
                <tr>
                    <td width="150"><b>Order ID:</b></td>
                    <td>28759</td>
                </tr><br>
                <tr>
                    <td width="150"><b>Description:</b></td>
                    <td>Bestelling 28759</td>
                </tr><br>
                <tr>
                    <td width="150"><b>Amount:</b></td>
                    <td>€ <?= number_format((float) $dePamirConstante , 2, ',', '')?> </td>
                </tr><br>
                <b>Status:</b>
                <input class="btn btn-primary" name="submitStatus" type="submit" value="Success" style="margin-right: 10px; background-color: green">
                <input class="btn btn-primary" name="submitStatus" type="submit" value="Pending" style="margin-right: 10px; background-color: orange">
                <input class="btn btn-primary" name="submitStatus" type="submit" value="Cancel" style="margin-right: 10px; background-color: red">
                <input class="btn btn-primary" name="submitStatus" type="submit" value="Error" style="margin-right: 10px; cursor: not-allowed; background-color: darkred">
                </form>
                </div>
            <div class="card-footer text-muted" style="padding: 5px">
            <div class="footer"><a href="https://www.ideal-checkout.nl/" target="_blank">https://www.ideal-checkout.nl</a>
        </div>
    </div>
</div>

</body>
</html>