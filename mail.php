<?php
if(isset( $_POST['name']))
    $name = $_POST['name'];
if(isset( $_POST['email']))
    $email = $_POST['email'];
if(isset( $_POST['message']))
    $message = $_POST['message'];
if(isset( $_POST['subject']))
    $subject = $_POST['subject'];

$content="From: $name \n Email: $email \n Message: $message";
$recipient = "wwimporters.services@gmail.com";
$mailheader = "From: $email \r\n";
mail($recipient, $subject, $content, $mailheader) or die("Er is wat fout gegaan, probeer het opnieuw.");
echo "Email is verstuurd!";
?>