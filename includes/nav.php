<?php
// Code om het aantal unieke items weer te geven als getal naast de shopping cart
    $shoppincartItems = "";
    if(isset($_SESSION["shoppingCart"])) {
        $shoppincartItems = count($_SESSION["shoppingCart"]);
    }

    //
include("loginscript.php"); ?>
<!-- Log in Modal -->

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Inloggen op de webshop</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="modal-title text-warning"><?php echo $errorCode;?></h5><br>

                <form action="" method="post" class="needs-validation-login" novalidate>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Email" name="gebruikersemail" required>
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon2"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="Wachtwoord" name="wachtwoord" required>
                    </div>
                    <input type="submit" class="btn btn-success float-lg-right" value="Inloggen">
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            var forms = document.getElementsByClassName('needs-validation-login');
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
</script>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="index.php"><img class="rounded-corners" src="images/wwilogo.png" alt="Logo" style="width:60%;"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto mx-auto">
              <form action="search.php" method="get" style="margin:0; padding: 0;">
              <div class="input-group mb-2">
                 <li class="nav-item">
                     <input class="form-control rounded-left" type="text" name="searchBox" placeholder="Product zoeken...">
                </li>
                    <input type="submit" class="btn btn-primary rounded-right" value="Zoek">
              </div>
              </form>

          </ul>
          <ul class="navbar-nav ml-auto">
            <?php if (!isset($_SESSION["loggedin"][0])) { ?>
                <li>
                    <a class="nav-link" href="signup.php">Aanmelden</a>
                </li>
                <li>
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">Inloggen</a>
                </li>
            <?php }
                else { ?>
                <li>
                    <form style="margin: 0; padding: 0;" name="logoutform" method="post">
                        <a onclick="document.logoutform.submit();" style="cursor: pointer;" class="nav-link text-danger">Uitloggen</a>
                        <input type="hidden" value="true" name="uitloggen">
                    </form>
                </li>
                <li>
                    <a class="nav-link" href="myPurchases.php">Uw Bestellingen</a>
                </li>
            <?php } ?>
          <li class="nav-item">
            <a class="nav-link" href="shoppingcart.php">Winkelmand <i class="fas fa-shopping-cart"></i> <?php print($shoppincartItems); ?></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>