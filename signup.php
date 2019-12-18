<?php include_once("databasecon.php"); ?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<?php include 'includes/nav.php'; ?>
<!-- Insert created user into the database -->
<?php

$errorMessage = "";
$successMessage = "";
    if (isset($_POST["voornaam"]) &&
        isset($_POST["achternaam"]) &&
        isset($_POST["straatnaam"])&&
        isset($_POST["huisnr"])&&
        isset($_POST["landnaam"])&&
        isset($_POST["plaats"])&&
        isset($_POST["postcode"])&&
        isset($_POST["telefoon"])&&
        isset($_POST["email"])&&
        isset($_POST["wachtwoord1"])&&
        isset($_POST["wachtwoord2"])) {

        // Wachtwoorden op de backend met elkaar vergelijken als de frontend faalt
        if ($_POST["wachtwoord1"] != $_POST["wachtwoord2"]) {
            $errorMessage = "De wachtwoorden komen niet overeen!";
        }
        else {
            // HAshpass werkt nog niet!! wachtwoorden worden plain opgeslagen
            $hashPass = password_hash(strtolower($_POST["wachtwoord2"]), PASSWORD_DEFAULT);
            $hashPass = strtolower($_POST["wachtwoord2"]);
            $statement = mysqli_prepare($conn, "INSERT INTO useraccounts (voornaam, achternaam, straatnaam, huisnr, landnaam, plaats, postcode, email, telefoonnummer, hashed_password) VALUES (?,?,?,?,?,?,?,?,?,?)");
            if ($statement == false)
                die("<pre>".mysqli_error($conn).PHP_EOL.$statement."</pre>");
            // Variabelen binden aan de INSERT query
            mysqli_stmt_bind_param($statement, 'ssssssssss', $_POST["voornaam"], $_POST["achternaam"], $_POST["straatnaam"], $_POST["huisnr"], $_POST["landnaam"], $_POST["plaats"],$_POST["postcode"],strtolower($_POST["email"]),$_POST["telefoon"],$hashPass);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            $successMessage = "Uw account is aangemaakt!";
        }
    }
?>

<body>

<div class="container">
    <div class="col-md-6 mx-auto text-center">
        <div class="header-title">
            <h1 class="wv-heading--title">
                Account aanmaken
            </h1>
            <h1 class="text-danger">
                <?php echo $errorMessage; ?>
            </h1>
            <h1 class="text-success">
                <?php echo $successMessage; ?>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="myform form">
                <form action="" method="post" name="login" class="needs-validation" novalidate>
                    <div class="form-group">
                        <input type="text" name="voornaam"  class="form-control my-input" id="voornaam" placeholder="Voornaam" required="true">
                    </div>
                    <div class="form-group">
                        <input type="text" name="achternaam"  class="form-control my-input" id="achternaam" placeholder="Achternaam" required="true">
                    </div>
                    <div class="form-group">
                        <input type="text" name="straatnaam"  class="form-control my-input" id="straatnaam" placeholder="Straatnaam" required="true">
                    </div>
                    <div class="form-group">
                        <input type="text" name="huisnr"  class="form-control my-input" id="huisnr" placeholder="Huisnr" required="true">
                    </div>
                    <div class="form-group">
                        <input type="text" name="landnaam"  class="form-control my-input" id="landnaam" placeholder="Landnaam" required="true">
                    </div>
                    <div class="form-group">
                        <input type="text" name="plaats"  class="form-control my-input" id="plaats" placeholder="Plaats" required="true">
                    </div>
                    <div class="form-group">
                        <input type="text" name="postcode"  class="form-control my-input" id="postcode" placeholder="Postcode" required="true">
                    </div>
                    <div class="form-group">
                        <input type="number" min="0" name="telefoon" id="phone"  class="form-control my-input" placeholder="Telefoon" required="true">
                    </div>
                    <hr>
                    <div class="form-group">
                        <input type="email" name="email"  class="form-control my-input" id="email" placeholder="Email" required="true">
                        <small id="emailHelp" class="form-text text-muted">Dit email adres gebruikt u voortaan om in te loggen</small>
                    </div>
                    <div class="form-group">
                        <input type="password" minlength="6" name="wachtwoord1"  class="form-control my-input" id="wachtwoord1" placeholder="wachtwoord" required="true" oninput="validate_ww2(this)">
                    </div>
                    <div class="form-group">
                        <input type="password" minlength="6" name="wachtwoord2"  class="form-control my-input" id="wachtwoord2" placeholder="herhaal wachtwoord" required="true" oninput="validate_ww2(this)">
                        <div id="errorMessage" class="form-text text-danger"></div>
                        <small id="pwHelp" class="form-text text-muted">Herhaal uw wachtwoord</small>

                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-block btn-primary send-button tx-tfm">Account aanmaken</button>
                    </div>
                </form>
                <br><br><br>
            </div>
        </div>
    </div>
</div>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    function validate_ww2(t) {
        let ww1 = document.getElementById("wachtwoord1");
        let ww2 = document.getElementById("wachtwoord2");
        let Message = "Wachtwoorden komen niet overeen!";
        let appendDiv = document.getElementById("errorMessage");
        if (ww2.value !== ww1.value) {
            if (appendDiv.innerText !== Message) {
                appendDiv.innerText = Message;
                ww2.setCustomValidity("invalid");
            }
        }
        else {
            appendDiv.innerText = "";
            ww2.setCustomValidity("");
        }
    }
</script>
</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>