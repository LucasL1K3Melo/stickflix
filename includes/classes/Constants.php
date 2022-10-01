<?php 

class Constants{

    /*
     *
     * Error Messages <!>
     *
    */

    // First name error message.
    public static $firstNameCharacters = "Your first name must be between 2 and 25 characters";
    
    // Last name error message.
    public static $lastNameCharacters = "Your last name must be between 2 and 25 characters";

    // Username error message.
    public static $usernameCharacters = "Your username must be between 2 and 25 characters";

    // Username error message already taken.
    public static $usernameTaken = "This username is already in use";

    // E-mail don't match.
    public static $emailDontMatch = "Your e-mail don't match";

    // Invalid e-mail.
    public static $invalidEmail = "Your e-mail is invalid";

    // E-mail already in use.
    public static $emailTaken = "This e-mail already in use";

    // Password don't match.
    public static $passwordDontMatch = "The passwords don't match";

    // Password length invalid.
    public static $passwordLenInvalid = "The password must be between 8 and 32 characters";

    // Login Failed.
    public static $loginFailed = "The username or password is incorrect";
}
?>