<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<!-- saved from url=(0147)https://www.ideal-checkout.nl/demo/idealcheckout-betaalformulier/idealcheckout/setup.php?order_id=28759&order_code=pM4Pr7qrLmOmJ8yu6a5DL2pXvQse2DfO -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>iDEAL Checkout</title>

		<style type="text/css">

html, body, form, div
{
	margin: 0px;
	padding: 0px;
}

div.wrapper
{
	padding: 50px 0px 0px 0px;
	text-align: center;
}

div.error
{
	margin: 10px 0px 10px 0px;
	padding: 8px 8px 8px 8px;
	text-align: center;

	font-family: Arial;
	font-size: 12px;
	background-color: #FFE0E0;
	border: #FF0000 dashed 1px;
}

p
{
	font-family: Arial;
	font-size: 15px;
}

a
{
	color: #CC0066 !important;
}

td
{
	font-family: Arial;
	font-size: 12px;
}

		</style>

	</head>
	<body cz-shortcut-listen="true">

		<!--

			This iDEAL Checkout script is developed by:

			iDEAL Checkout

			Support & Information:
			W. http://www.ideal-checkout.nl
			E. info@ideal-checkout.nl
			T. 0522 - 746 060

		-->

		<div class="wrapper">
			<p><img alt="iDEAL Checkout" border="0" src="ideal/checkout_files/ideal.png"></p>

<p><b>Direct online afrekenen via uw eigen bank.</b></p>
<form action="ideal/betaling.html" method="post">
	<input name="gateway_code" type="hidden" value="ideal">
	<input name="order_id" type="hidden" value="28759">
	<input name="order_description" type="hidden" value="Bestelling 300000">
	<input name="order_amount" type="hidden" value="<?php $totaal ?>">
	<input name="url_success" type="hidden" value="https://www.ideal-checkout.nl/demo/idealcheckout-betaalformulier/idealcheckout/return.php?transaction_id=f7Di1F5HqWSATjcXeLY8l0Bz1MpbMU41&amp;transaction_code=0dJ2MjrqaproZ4w9vBPaQRtGmCczWqXf&amp;status=SUCCESS">
	<input name="url_pending" type="hidden" value="https://www.ideal-checkout.nl/demo/idealcheckout-betaalformulier/idealcheckout/return.php?transaction_id=f7Di1F5HqWSATjcXeLY8l0Bz1MpbMU41&amp;transaction_code=0dJ2MjrqaproZ4w9vBPaQRtGmCczWqXf&amp;status=PENDING">
	<input name="url_cancel" type="hidden" value="https://www.ideal-checkout.nl/demo/idealcheckout-betaalformulier/idealcheckout/return.php?transaction_id=f7Di1F5HqWSATjcXeLY8l0Bz1MpbMU41&amp;transaction_code=0dJ2MjrqaproZ4w9vBPaQRtGmCczWqXf&amp;status=CANCELLED">
	<input name="url_error" type="hidden" value="https://www.ideal-checkout.nl/demo/idealcheckout-betaalformulier/idealcheckout/return.php?transaction_id=f7Di1F5HqWSATjcXeLY8l0Bz1MpbMU41&amp;transaction_code=0dJ2MjrqaproZ4w9vBPaQRtGmCczWqXf&amp;status=FAILURE">
	<input type="submit" value="Verder &gt;&gt;">
</form>

		</div>


</body></html>
