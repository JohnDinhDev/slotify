<?php

function sanatizeUsername($text) {
    $result = strip_tags($text);
    $result = str_replace(" ", "", $result);
    return $result;
}

function sanatizeString($text) {
    $result = strip_tags($text);
    $result = str_replace(" ", "", $result);
    $result = ucfirst(strtolower($result));
    return $result;
}

function sanatizePassword($text) {
    $result = strip_tags($text);
    return $result;
}



if (isset($_POST['registerButton'])) {
    $username = sanatizeUsername($_POST['registerUsername']);
    $firstName = sanatizeString($_POST['registerFirstName']);
    $lastName = sanatizeString($_POST['registerLastName']);    
    $email = sanatizeString($_POST['registerEmail']);
    $password = sanatizePassword($_POST['registerPassword']);
    $password2 = sanatizePassword($_POST['registerPassword2']);

    $wasSuccessful = $account->register($username, $firstName, $lastName, $email, $password, $password2);

    if ($wasSuccessful) {
        header("Location: index.php");
    }

}



?>