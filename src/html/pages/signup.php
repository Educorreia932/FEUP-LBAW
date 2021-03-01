<?php
    include_once("../components/head.php");
    include_once("../components/header.php");
    include_once("../components/footer.php");
    
    $stylesheets = array("authentication.css");
?>

<!DOCTYPE html>
<html lang="en">
    <?php site_head('Sign Up', $stylesheets); ?>

    <body>
        <?php site_header(NULL, "page_signup"); ?>

        <!-- Sign up -->
        <main class="d-flex align-items-center justify-content-center">
            <div class="container-lg text-center">
                <form class="form-signup">
                    <h1 class="mb-3">Sign Up</h1>
                    <label for="inputName" class="sr-only float-start">Name</label>
                    <input type="text" id="inputName" class="form-control" placeholder="" required autofocus="">
                    <label for="inputEmail" class="sr-only float-start">Email</label>
                    <input type="email" id="inputEmail" class="form-control" placeholder="" required autofocus="">
                    <label for="inputPhone" class="sr-only float-start">Phone Number</label>
                    <input type="phone" id="inputPhone" class="form-control" placeholder="" required>
                    <label for="inputPassword" class="sr-only float-start">Password</label>
                    <input type="password" id="inputPassword" class="form-control" placeholder="" required>
                    <label for="confirmation" class="sr-only float-start">Comfirm Password</label>
                    <input type="password" id="confirmation" class="form-control" placeholder="" required>
                    <div class="d-flex flex-row terms-of-service mt-2">
                        <input type="checkbox" id="termsCheckbox" class="me-2" value="" required>
                        <label for="termsCheckbox"> I have read and agree with this site's
                            <a href="#">terms of service</a>
                        </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">Sign Up</button>
                </form>

                 <div class="options-separator">
                        <span class="divider-text text-black-50">Or</span>
                </div>

                <button class="btn btn-lg btn-secondary btn-block" type="button">
                    <i class=" bi bi-github"></i>
                    Sign up with GitHub
                </button>

                <div class="m-2 text-secondary mt-3 mb-5">
                    <p>Already have an account?
                        <a href="signin.php" class="text-secondary fw-bold">Sign in <i class="bi bi-arrow-right"></i></a>
                    </p>
                </div>
            </div>
        </main>

        <?php site_footer(); ?>
    </body>
</html>