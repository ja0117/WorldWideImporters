
<?php $valueVorigePagina = $_POST["totaalPrijs"]; ?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>iDEAL Checkout Simulator - iDEAL</title>


    <meta name="description" content="Met behulp van de iDEAL simulator kunt u de implementatie van iDEAL binnen uw website/webshop testen zonder hiervoor eerst een iDEAL account te moeten aanschaffen.">
    <meta name="keywords" content="iDEAL, iDEAL Simulator, iDEAL Lite, iDEAL Basic">
    <meta name="robots" content="noindex/follow">
    <link rel="stylesheet" href="ideal/betaling_files/payment.css" type="text/css">
</head>
<body cz-shortcut-listen="true">
<div class="header"><h1>iDEAL Payment <br><em>iDEAL inc</em></h1></div>
<div class="content">
    <p align="center" style="width: 400px;"><img alt="" border="0" src="ideal/betaling_files/ideal.png"></p>
    <p align="center">&nbsp;</p>

    <form action="ideal/success.html" method="post">
        <input name="form" type="hidden" value="payment">
        <input name="url_success" type="hidden" value="https://www.ideal-checkout.nl/demo/idealcheckout-betaalformulier/idealcheckout/return.php?transaction_id=f7Di1F5HqWSATjcXeLY8l0Bz1MpbMU41&amp;transaction_code=0dJ2MjrqaproZ4w9vBPaQRtGmCczWqXf&amp;status=SUCCESS">
        <input name="url_pending" type="hidden" value="https://www.ideal-checkout.nl/demo/idealcheckout-betaalformulier/idealcheckout/return.php?transaction_id=f7Di1F5HqWSATjcXeLY8l0Bz1MpbMU41&amp;transaction_code=0dJ2MjrqaproZ4w9vBPaQRtGmCczWqXf&amp;status=PENDING">
        <input name="url_cancel" type="hidden" value="https://www.ideal-checkout.nl/demo/idealcheckout-betaalformulier/idealcheckout/return.php?transaction_id=f7Di1F5HqWSATjcXeLY8l0Bz1MpbMU41&amp;transaction_code=0dJ2MjrqaproZ4w9vBPaQRtGmCczWqXf&amp;status=CANCELLED">
        <input name="url_error" type="hidden" value="https://www.ideal-checkout.nl/demo/idealcheckout-betaalformulier/idealcheckout/return.php?transaction_id=f7Di1F5HqWSATjcXeLY8l0Bz1MpbMU41&amp;transaction_code=0dJ2MjrqaproZ4w9vBPaQRtGmCczWqXf&amp;status=FAILURE">
        <table border="0" cellpadding="0" cellspacing="5">
            <tbody><tr>
                <td width="150"><b>Betaalmethode:</b></td>
                <td>iDEAL</td>
            </tr>
            <tr>
                <td width="150"><b>Order ID:</b></td>
                <td>28759</td>
            </tr>
            <tr>
                <td width="150"><b>Description:</b></td>
                <td>Bestelling 28759</td>
            </tr>
            <tr>
                <td width="150"><b>Amount:</b></td>
                <td>€ <?php print($valueVorigePagina) ?> </td>
            </tr>
            <tr>
                <td width="150"><b>Status:</b></td>
                <td><input name="status" type="submit" value="Success" style="margin-right: 10px;"><input name="status" type="submit" value="Pending" style="margin-right: 10px;"><input name="status" type="submit" value="Cancel" style="margin-right: 10px;"><input name="status" type="submit" value="Error" style="margin-right: 10px;"></td>
            </tr>
            </tbody></table>
    </form></div>
<div class="footer"><a href="https://www.ideal-checkout.nl/" target="_blank">https://www.ideal-checkout.nl</a></div>

</body></html>