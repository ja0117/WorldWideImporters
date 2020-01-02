<!DOCTYPE html>
<html>

<!-- HTML head -->
<?php include 'includes/head.php'; ?>
<?php include 'includes/nav.php'; ?>

<body>

<div class="container">
    <div class="row">
        <div class="col-8">
            <h1 class="my-4"> Klantenservice </h1>
        </div>
        <!--Section: Contact v.2-->
        <section class="mb-4">

            <!--Section heading-->
            <h2 class="h1-responsive font-weight-bold text-center my-4">Neem contact op</h2>
            <!--Section description-->
            <p class="text-center w-responsive mx-auto mb-5">Heb je vragen? Stel ze gerust. Vul dit formulier in en we proberen binnen één dag antwoord te geven.
                </p>

            <div class="row">

                <!--Grid column-->
                <div class="col-md-9 mb-md-0 mb-5">
                    <form id="contact-form" name="contact-form" action="mail.php" method="post">

                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <input type="text" id="name" name="name" class="form-control" required>
                                    <label for="name" class="">Voor- en achternaam </label>
                                </div>
                            </div>
                            <!--Grid column-->

                            <!--Grid column-->
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <input type="text" id="email" name="email" class="form-control" required>
                                    <label for="email" class="">E-mail</label>
                                </div>
                            </div>
                            <!--Grid column-->

                        </div>
                        <!--Grid row-->

                        <!--Grid row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form mb-0">
                                    <input type="text" id="subject" name="subject" class="form-control" required>
                                    <label for="subject" class="">Onderwerp</label>
                                </div>
                            </div>
                        </div>
                        <!--Grid row-->

                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-12">

                                <div class="md-form">
                                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea" required></textarea>
                                    <label for="message">Uw bericht</label>
                                </div>

                            </div>
                        </div>
                        <!--Grid row-->



                    <div class="text-center text-md-left">
                        <input type="submit" class="btn btn-primary" name="formSubmit" value="Verzenden">
                    </div>
                    <div class="status"></div>
                </div>
            </form>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-3 text-center">
                    <ul class="list-unstyled mb-0">
                        <li><i class="fas fa-map-marker-alt fa-2x"></i>
                            <p>Campus 2, 8017 CA Zwolle</p>
                        </li>

                        <li><i class="fas fa-phone mt-4 fa-2x"></i>
                            <p>+31 8 12345678</p>
                        </li>

                        <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                            <p>wwimporters.services@gmail.com</p>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->

            </div>

        </section>
        <!--Section: Contact v.2-->
    </div>
</div>

</body>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</html>