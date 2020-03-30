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
</head>

<body>
    <div id="inputContainer">

        <form action="register.php" method="POST" id="loginForm">
            <h2>Login to your account</h2>

            <p>
                <label for="loginUsername">Username</label>
                <input id="loginUsername" name="loginUsername" type="text" placeholder="Username" required>
            </p>

            <p>
                <label for="loginPassword">Password</label>
                <input id="loginPassword" name="loginPassword" type="password" required>
            </p>

            <button type="submit" name="loginButton">Login</button>
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
                <input id="registerPassword" name="registerPassword" type="password" placeholder="Password" required>
            </p>
            <p>
                <label for="registerPassword2">Confirm Password</label>
                <input id="registerPassword2" name="registerPassword2" type="password" placeholder="Password" required>
            </p>

            <button type="submit" name="registerButton">Sign Up</button>
        </form>
    </div>
</body>

</html>