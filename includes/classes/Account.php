<?php

    class Account {

        private $con;
        private $errorArray = array();

        public function __construct($con){
            $this->con = $con;
        }

        // Login the user function.
        public function login($un, $pw){

            $pw = hash("sha512", $pw);

            $query = $this->con->prepare("SELECT * FROM users WHERE username=:un AND password=:pw");

            $query->bindValue(":un", $un);
            $query->bindValue(":pw", $pw);

            $query->execute();

            if($query->rowCount() == 1){
                return true;
            }

            array_push($this->errorArray, Constants::$loginFailed);
            return false;
        
        }

        // Register the user function.
        public function register($fn, $ln, $un, $em, $em2, $pw, $pw2){
            $this->validateFirstName($fn);
            $this->validateLastName($ln);
            $this->validateUsername($un);
            $this->validateEmails($em, $em2);
            $this->validatePassword($pw, $pw2);

            // Verify if the arrow is empty.
            if(empty($this->errorArray)){
                return $this->insertUserDetails($fn, $ln, $un, $em, $pw);
            }

            return false;
        }

        // Insert User Details.
        private function insertUserDetails($fn, $ln, $un, $em, $pw){

            $pw = hash("sha512", $pw);
            
            $query = $this->con->prepare("INSERT INTO users (firstName, lastName, username, email, password)
                                        VALUES (:fn, :ln, :un, :em, :pw)");

            $query->bindValue(":fn", $fn);
            $query->bindValue(":ln", $ln);
            $query->bindValue(":un", $un);
            $query->bindValue(":em", $em);
            $query->bindValue(":pw", $pw);

            return $query->execute();
        }

        // Validate Password.
        private function validatePassword($pw, $pw2){

            if($pw != $pw2){ // Verify if the pw and pw2 are the same.
                array_push($this->errorArray, Constants::$passwordDontMatch);
                //return;
            }

            /*
            //   VALIDAR ERRO AO REGISTRAR ACCOUNT
            if(strlen($pw < 8) || strlen($pw > 32)){ // Verify the pw length.
                array_push($this->errorArray, Constants::$passwordLenInvalid);
            }
            */

        }   

        // Validate the first name from user.
        private function validateFirstName($fn){

            if(strlen($fn) < 2 || strlen($fn) > 25){
                array_push($this->errorArray, Constants::$firstNameCharacters); // Error message
            }
        
        }

        // Validate the last name from user.
        private function validateLastName($ln){

            if(strlen($ln) < 2 || strlen($ln) > 25){
                array_push($this->errorArray, Constants::$lastNameCharacters); // Error message
            }
        
        }

        // Validate the username from user.
        private function validateUsername($un){

            if(strlen($un) < 2 || strlen($un) > 25){
                array_push($this->errorArray, Constants::$usernameCharacters); // Error message
                return;
            }

            $query = $this->con->prepare("SELECT * FROM users WHERE username=:un");
            $query->bindValue(":un", $un);
            $query->execute(); 

            if($query->rowCount() != 0){
                array_push($this->errorArray, Constants::$usernameTaken);
            }
        
        }

        // Validate the e-mail
        public function validateEmails($em, $em2){
            
            if($em != $em2){
                array_push($this->errorArray, Constants::$emailDontMatch);
                return;
            }

            if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
                array_push($this->errorArray, Constants::$invalidEmail);
                return;
            }

            $query = $this->con->prepare("SELECT * FROM users WHERE email=:em");
            $query->bindValue(":em", $em);
            $query->execute(); 

            if($query->rowCount() != 0){
                array_push($this->errorArray, Constants::$emailTaken);
            }

        }

        // Get error function
        public function getError($error){
            if(in_array($error, $this->errorArray)){
                return "<span class='errorMessage'>" . $error . "</span>";
            }
        }
    
    }
?>