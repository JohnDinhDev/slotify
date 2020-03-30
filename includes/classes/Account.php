<?php

    class Account {

        private $con;
        private $errorArray;

        public function __construct($con) {
            $this->con = $con;
            $this->errorArray = array();
        }

        public function login($username, $password) {
            // Fetch hashed password from DB
            $query = "SELECT password FROM users WHERE username='$username';";

            $hashedPassword = mysqli_query($this->con, $query);
            $hashedPassword = mysqli_fetch_row($hashedPassword)[0];

            // Verify password
            if (password_verify($password, $hashedPassword)) {
                return true;
            } else {
                array_push($this->errorArray, Constants::$loginFail);
                return false;
            }

        }

        public function register($username, $firstName, $lastName, $email, $password, $password2) {
            $this->validateUsername($username);
            $this->validateFirstName($firstName);
            $this->validateLastName($lastName);
            $this->validateEmail($email);
            $this->validatePasswords($password, $password2);

            if(empty($this->errorArray)) {
                // Insert into db
                return $this->insertUserDetails($username, $firstName, $lastName, $email, $password);
            } else {
                return false;
            }
        }

        public function getError($error) {
            if(!in_array($error, $this->errorArray)) {
                $error = "";
            } else {
                return "<span class='errorMessage'>$error</span>";
            }
        }

        private function insertUserDetails($username, $firstName, $lastName, $email, $password) {
            $encryptedPassword = password_hash($password, PASSWORD_BCRYPT);
            $profile = "assets/images/profile-pics/head_emerald.png";
            $date = date("Y-m-d");

            $query = "INSERT INTO users(username, firstname, lastName, email, password, signUpDate, profilePic) ";
            $query .= "VALUES ('$username', '$firstName', '$lastName', '$email', '$encryptedPassword', '$date', '$profile');";

            $result = mysqli_query($this->con, $query);

            return $result;
        }

        private function validateUsername($username) {
            if (strlen($username) > 25 || strlen($username) < 5) {
                array_push($this->errorArray, Constants::$userNameCharacters);
                return;
            }

            $checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$username';");



            if (mysqli_num_rows($checkUsernameQuery) !== 0) {
                array_push($this->errorArray, Constants::$userNameTaken);
                return;
            }
        }

        private function validateFirstName($firstName) {
            if (strlen($firstName) > 25 || strlen($firstName) < 2) {
                array_push($this->errorArray, Constants::$firstNameCharacters);
                return;
            }
        }

        private function validateLastName($lastName) {
            if (strlen($lastName) > 25 || strlen($lastName) < 2) {
                array_push($this->errorArray, Constants::$lastNameCharacters);
                return;
            }
        }

        private function validateEmail($email) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($this->errorArray, Constants::$emailInvalid);
                return;
            }

            $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$email';");


            if (mysqli_num_rows($checkEmailQuery) !== 0) {
                array_push($this->errorArray, Constants::$emailTaken);
                return;
            }
        }

        private function validatePasswords($pw, $pw2) {
            if ($pw !== $pw2) {
                array_push($this->errorArray, Constants::$passwordsDoNotMatch);
                return;
            }

            if(preg_match('/[^A-Za-z0-9]/', $pw)) {
                array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
                return;
            }

            if (strlen($pw) > 30 || strlen($pw) < 5) {
                array_push($this->errorArray, Constants::$passwordCharacters);
                return;
            }
        }

        
    }
