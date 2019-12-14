<?php
/**
 * Created by PhpStorm.
 * User: Joshua
 * Date: 14-12-2019
 * Time: 18:52
 */
include("databasecon.php");

$errorCode = "";
if(isset($_POST["gebruikersemail"]) && isset($_POST["wachtwoord"])) {
    $user = $_POST["gebruikersemail"];
    $pass = $_POST["wachtwoord"];

    //Statement klaarmaken
    $statement = mysqli_prepare($conn, "SELECT * FROM useraccounts WHERE email = ?");

    mysqli_stmt_bind_param($statement, 's', $user);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $result2 = mysqli_fetch_array($result);
    print_r($result2);

    if(password_verify($pass, $result2["hashed_password"])){
        $errorCode = "Het ingevoerde wachtwoord is juist.";
    }
//
}