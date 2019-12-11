<?php

$price = 25;
$qty = 90;
$total = $price * $qty;
$discount = 0;
$orgPrice = "Original price is";
$priceAfter = "Price after";
$discountText = "discount is";
$EuroTeken = "€";
$DiscIs = "Discount is";
$percentage = "percent";
echo "<H4> $orgPrice $total </H4>";
if ($qty > 10 && $qty < 20) {
    $discount = 10;
}
if ($qty >= 20 && $qty < 30) {
    $discount = 15;
}
if ($qty > 30 && $qty <= 40) {
    $discount = 20;
}
if ($qty > 40) {
    $discount = 25;
}
echo "<H4> $DiscIs $discount $percentage </H4>";
echo "<H4> $priceAfter $discountText $EuroTeken", (($total * (100 - $discount) / 100)), "</H4>";
