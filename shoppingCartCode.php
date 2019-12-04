<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION["shoppingCart"])) {
    $_SESSION["shoppingCart"] = array();
}

// If "+" button is pressed, make an array $itemdata inside the shoppingCart session
if (isset($_POST["add_to_cart"])) {
    $itemdata = array(
        "item_productid"    =>    $_POST["hidden_productid"],
        "item_productname"  =>    $_POST["hidden_productname"],
        "item_quantity"     =>    $_POST["quantity"],
        "item_productprice" =>    $_POST["hidden_productprice"],
        "item_singlePrice"   =>    $_POST["hidden_productprice"]
    );
    $exists = false;

    // If shoppingCart is empty, push the item data inside the array, else add up the specified quantity
    if (empty($_SESSION["shoppingCart"])) {
        array_push($_SESSION["shoppingCart"], $itemdata);
        $exists = true;
    } else {
        foreach ($_SESSION["shoppingCart"] as $index => $values) {
            if ($values["item_productid"] === $_POST["hidden_productid"]) {
                $values["item_quantity"] += 1;
                $price = $_POST["hidden_productprice"];
                $values["item_productprice"] = $values["item_quantity"] * $price;
                $_SESSION["shoppingCart"][$index] = $values;
                $exists = true;
                break;
            }
        }
    }

    if (!$exists) {
        array_push($_SESSION["shoppingCart"], $itemdata);
    }
}

// If "-" button is pressed, remove by the specified quantity. If quantity gets below 1, remove the item from shoppingCart
if (isset($_POST["decreaseQuantity"])) {
    foreach ($_SESSION["shoppingCart"] as $index => $values) {
        if ($values["item_productid"] === $_POST["hidden_productid"]) {
            if ($values["item_quantity"] > 1) {
                $values["item_quantity"] -= 1;
                $values["item_productprice"] -= $values["item_singlePrice"];
                $_SESSION["shoppingCart"][$index] = $values;
            } else {
                unset($_SESSION["shoppingCart"][$index]);
            }
        }
    }
}

// If "-" button is pressed, remove by the specified quantity. If quantity gets below 1, remove the item from shoppingCart
if (isset($_POST["increaseQuantity"])) {
    foreach ($_SESSION["shoppingCart"] as $index => $values) {
        if ($values["item_productid"] === $_POST["hidden_productid"]) {
            if ($values["item_quantity"] >= 1) {
                $values["item_quantity"] += 1;
                $values["item_productprice"] += $values["item_singlePrice"];
                $_SESSION["shoppingCart"][$index] = $values;
            } else {
                unset($_SESSION["shoppingCart"][$index]);
            }
        }
    }
}

// If "Remove" button is pressed, remove item completely from shoppingCart
if (isset($_POST["remove"])) {
    foreach ($_SESSION["shoppingCart"] as $index => $values) {
        if ($values["item_productid"] === $_POST["hidden_productid"]) {
            unset($_SESSION["shoppingCart"][$index]);
        }
    }
}

