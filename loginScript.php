<?php
/**
 * Created by PhpStorm.
 * User: Joshua
 * Date: 14-12-2019
 * Time: 18:52
 */
include("databasecon.php");

if (empty($_SESSION["loggedin"])) {
    $_SESSION["loggedin"] = array();
}

// Unset sessie wanneer er op de uitlog knop wordt geklikt
if (isset($_POST["uitloggen"])) {
    unset($_SESSION["loggedin"]);
}

$errorCode = "";
if(isset($_POST["gebruikersemail"]) && isset($_POST["wachtwoord"])) {
    if (empty($_POST["gebruikersemail"] && $_POST["wachtwoord"])) {
        $errorCode = "Vul uw gegevens in om in te loggen.";
    }
    else {
        // de post variabelen in een variable zetten om ze makkelijker te gebruiken
        $user = $_POST["gebruikersemail"];
        $pass = $_POST["wachtwoord"];

        //Statement klaarmaken
        $statement = mysqli_prepare($conn, "SELECT * FROM useraccounts WHERE email = ?");

        // email adres binden aan de query
        mysqli_stmt_bind_param($statement, 's', $user);
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);



        // Result als Array weer kunnen geven
        $result2 = mysqli_fetch_array($result);
        $hashed = $result2["hashed_password"];

        // wachtwoord controleren met de hash in de database
        if ($pass == $hashed) {
            $logindata = array(
                "email" => $user,
                "userid" => $result2["id"],
                "voornaam" => $result2["voornaam"],
                "achternaam" => $result2["achternaam"],
                "straatnaam" => $result2["straatnaam"],
                "huisnr" => $result2["huisnr"],
                "landnaam" => $result2["landnaam"],
                "plaats" => $result2["plaats"],
                "postcode" => $result2["postcode"],
                "telefoonnummer" => $result2["telefoonnummer"]
            );

            array_push($_SESSION["loggedin"], $logindata);
        } else {
            $errorCode = "Het wachtwoord is onjuist!";
        }
    }
}
// print session
// print_r($_SESSION["loggedin"]);
//
//
//
