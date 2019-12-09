<?php

$price = 25;
$qty = 41;
$total = $price * $qty;
$discount = 0;
echo "<H4>Original price is $total </H4>";
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
echo "<H4>Discount is $discount percent</H4>";
echo "<H4>Price after discount is €", (($total * (100 - $discount) / 100)), "</H4>";
