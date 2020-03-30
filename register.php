<?php
require('./includes/config.php');
require('./includes/classes/Constants.php');
require('./includes/classes/Account.php');
$account = new Account($con);
require('./includes/handlers/register-handler.php');
require('./includes/handlers/login-handler.php');


function getInputValue($name)
{
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Slotify</title>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/css/register.css">
</head>

<body>

    <?php

    if (isset($_POST['registerButton'])) {

        echo '<script>
                $(document).ready(() => {
                    $("#loginForm").hide();
                    $("#registerForm").show();
                })
            </script>';
    }

    if (isset($_POST['loginButton'])) {
        echo '<script>
                $(document).ready(() => {
                    $("#loginForm").show();
                    $("#registerForm").hide();
                })
            </script>';
    }

    ?>


    <div id="background">
        <div id="loginContainer">

            <div id="inputContainer">
                <form action="register.php" method="POST" id="loginForm">
                    <h2>Login to your account</h2>
                    <p>
                        <?php echo $account->getError(Constants::$loginFail); ?>
                        <label for="loginUsername">Username</label>
                        <input id="loginUsername" name="loginUsername" type="text" placeholder="Username" value="<?php echo getInputValue('loginUsername'); ?>" required>
                    </p>

                    <p>
                        <label for="loginPassword">Password</label>
                        <input id="loginPassword" name="loginPassword" type="password" autocomplete="new-password" required>
                    </p>

                    <button type="submit" name="loginButton">Login</button>
                    <div class="hasAccountText">
                        <span id="hideLogin">Don't have an account yet? Signup here.</span>
                    </div>
                </form>


                <form action="register.php" method="POST" id="registerForm">
                    <h2>Create your free account</h2>

                    <p>
                        <?php echo $account->getError(Constants::$userNameCharacters); ?>
                        <?php echo $account->getError(Constants::$userNameTaken); ?>
                        <label for="registerUsername">Username</label>
                        <input id="registerUsername" name="registerUsername" type="text" placeholder="Username" value="<?php echo getInputValue('registerUsername'); ?>" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                        <label for="register">First Name</label>
                        <input id="registerFirstName" name="registerFirstName" type="text" placeholder="First Name" value="<?php echo getInputValue('registerFirstName'); ?>" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                        <label for="registerLastName">Last Name</label>
                        <input id="registerlastName" name="registerLastName" type="text" placeholder="Last Name" value="<?php echo getInputValue('registerLastName'); ?>" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$emailInvalid); ?>
                        <?php echo $account->getError(Constants::$emailTaken); ?>
                        <label for="registerEmail">Email</label>
                        <input id="registerEmail" name="registerEmail" type="email" placeholder="Email" value="<?php echo getInputValue('registerEmail'); ?>" required>
                    </p>

                    <p>
                        <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                        <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                        <?php echo $account->getError(Constants::$passwordCharacters); ?>
                        <label for="registerPassword">Password</label>
                        <input id="registerPassword" name="registerPassword" type="password" placeholder="Password" autocomplete="new-password" required>
                    </p>
                    <p>
                        <label for="registerPassword2">Confirm Password</label>
                        <input id="registerPassword2" name="registerPassword2" type="password" placeholder="Password" required>
                    </p>

                    <button type="submit" name="registerButton">Sign Up</button>

                    <div class="hasAccountText">
                        <span id="hideRegister">Already have an account? Log in here.</span>
                    </div>
                </form>
            </div>

            <div id="loginText">
                <h1>Get Great Music, Right Now!</h1>
                <h2>Listen to loads of songs for free</h2>
                <ul>
                    <li>
                        <svg id="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z" /></svg>
                        Discover music you'll fall in love with
                    </li>
                    <li>
                        <svg id="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z" /></svg>
                        Create your own playlists</li>
                    <li>
                        <svg id="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z" /></svg>
                        Follow artists to keep up to date</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="./assets/js/register.js"></script>
</body>

</html>