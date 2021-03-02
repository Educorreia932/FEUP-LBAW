<?php
    include_once(__DIR__ . "/../components/head.php");
    include_once(__DIR__ . "/../components/header.php");
    include_once(__DIR__ . "/../components/footer.php");
    
    $stylesheets = array("authentication.css");
?>

<!DOCTYPE html>
<html lang="en">

    <?php site_head('Sign In', $stylesheets); ?>

    <body class="d-flex flex-column" style="min-height: 100vh;">
        
        <?php site_header(NULL, "page_signin"); ?>

        <!-- Sign in -->
        <div class="container-fluid" style="flex:auto;">
            <main>
                <div class="container-lg text-center">
                    <form class="form-signin">
                        <h1 class="mb-3">Sign In</h1>
                        <label for="inputEmail" class="sr-only float-start">Email/Username</label>
                        <input type="email" id="inputEmail" class="form-control" placeholder="" required="" autofocus="">
                        <label for="inputPassword" class="sr-only float-start">Password</label>
                        <input type="password" id="inputPassword" class="form-control" placeholder="" required="">

                        <div class="forgot-password-container ">
                            <a href="#" class="text-secondary">Forgot password?</a>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                    </form>

                    <div class="options-separator">
                            <span class="divider-text text-black-50">Or</span>
                    </div>

                    <button class="btn btn-lg btn-secondary btn-block" type="button">
                        <i class=" bi bi-github"></i>
                        Sign in with GitHub
                    </button>

                    <div class="m-2 text-secondary mt-3">
                        <p>Dont have an account?
                        <a href="signup.php" class="text-secondary fw-bold">Sign up <i class="bi bi-arrow-right"></i></a>
                    </p>
                </div>
                </div>
            </main>
        </div>

        <?php site_footer(); ?>
    </body>
</html>