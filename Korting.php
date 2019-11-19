<?php

$price = 200;
$qty = 10;
echo "<H4>Original price is $price</H4>";
if ($qty = 10) {
    $discount = 10;
} elseif ($qty <= 20) {
    $discount = 15;
} elseif (qty <= 30) {
    $discount = 20;
} elseif ($qty <= 40) {
    $discount = 25;
}
echo "<H4>Discount is $discount percent</H4>";
echo "<H4>Price after discount is ", (($price * (100 - $discount) / 100)), "</H4>";
