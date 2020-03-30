<?php
require('./includes/classes/Constants.php');
require('./includes/classes/Account.php');
$account = new Account();
require('./includes/handlers/register-handler.php');
require('./includes/handlers/login-handler.php');
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
                <?php echo $account->getError("Your username must be between 5 and 25 characters"); ?>
                <label for="registerUsername">Username</label>
                <input id="registerUsername" name="registerUsername" type="text" placeholder="Username" required>
            </p>
            <p>
                <?php echo $account->getError("Your first name must be between 5 and 25 characters"); ?>
                <label for="register">First Name</label>
                <input id="registerFirstName" name="registerFirstName" type="text" placeholder="First Name" required>
            </p>
            <p>
                <?php echo $account->getError("Your last name must be between 5 and 25 characters"); ?>
                <label for="registerLastName">Last Name</label>
                <input id="registerlastName" name="registerlastName" type="text" placeholder="Last Name" required>
            </p>
            <p>
                <?php echo $account->getError("Email is invalid"); ?>
                <label for="registerEmail">Email</label>
                <input id="registerEmail" name="registerEmail" type="email" placeholder="Email" required>
            </p>

            <p>
                <?php echo $account->getError("Your passwords do not match"); ?>
                <?php echo $account->getError("Your passwords can only contain numbers and letters"); ?>
                <?php echo $account->getError("Your password must be between 5 and 25 characters"); ?>
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