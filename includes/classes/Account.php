<?php

    class Account {

        private $errorArray;

        public function __construct() {
            $this->errorArray = array();
        }

        public function register($username, $firstName, $lastName, $email, $password, $password2) {
            $this->validateUsername($username);
            $this->validateFirstName($firstName);
            $this->validateLastName($lastName);
            $this->validateEmail($email);
            $this->validatePasswords($password, $password2);

            if(empty($this->errorArray)) {
                // Insert into db
                return true;
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

        private function validateUsername($username) {
            if (strlen($username) > 25 || strlen($username) < 5) {
                array_push($this->errorArray, Constants::$userNameCharacters);
                return;
            }

            // TODO: check username exists
        }

        private function validateFirstName($firstName) {
            if (strlen($firstName) > 25 || strlen($firstName) < 2) {
                array_push($this->errorArray, Constants::$firstNameCharacters);
                return;
            }
        }

        private function validateLastName($lastName) {
            if (strlen($lastName) > 25 || strlen($lastName) < 5) {
                array_push($this->errorArray, Constants::$lastNameCharacters);
                return;
            }
        }

        private function validateEmail($email) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($this->errorArray, Constants::$emailInvalid);
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
