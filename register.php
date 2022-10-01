<?php 

    require_once("./includes/config.php");    
    require_once("./includes/classes/FormSanitizer.php");
    require_once("./includes/classes/Constants.php");
    require_once("./includes/classes/Account.php");


    $account = new Account($con);

    if(isset($_POST["submitButton"])){
        
        $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
        $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
        $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
        $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
        $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
        $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);
        
        $success = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);
        
        if($success){
            // Store session
            $_SESSION["userLoggedIn"] = $username;
            header("Location: index.php");
        }
    }

    function getInputValue($name){
        if(isset($_POST[$name])){
            echo $_POST[$name];
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Registrar no StickFlix</title>

        <link rel="stylesheet" href="./assets/style/style.css">
    </head>
    <!-- ./ -->
    <body>

        <!-- Login Panel -->
        <div class="signInContainer">
            <div class="column">

                <!-- HEADER AREA -->
                <div class="header">
                    <img src="./assets/images/StickflixLogotipo.png" title="Logo" alt="Site logo"> <!-- Logotipo -->
                    <h3> Registre-se! </h3>
                    <span>para acessar o StickFlix</span>
                </div>

                <!-- REGISTER FORM -->
                <form method="POST">

                    <!-- FIRST NAME AREA -->
                    <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                    <input type="text" name="firstName" placeholder="Primeiro nome" value="<?php getInputValue("firstName"); ?>" minlength="2" required>
                    
                    <!-- LAST NAME AREA -->
                    <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                    <input type="text" name="lastName" placeholder="Último nome" value="<?php getInputValue("lastName"); ?>" minlength="2" required>
                    
                    <!-- USERNAME AREA -->
                    <?php echo $account->getError(Constants::$usernameCharacters); ?>
                    <?php echo $account->getError(Constants::$usernameTaken); ?>
                    <input type="text" name="username" placeholder="Nome de usuário" value="<?php getInputValue("username"); ?>" required>
                    
                    <!-- E-MAIL AREA -->
                    <?php echo $account->getError(Constants::$emailDontMatch); ?>
                    <?php echo $account->getError(Constants::$invalidEmail); ?>
                    <?php echo $account->getError(Constants::$emailTaken); ?>
                    <input type="email" name="email" placeholder="Seu e-mail" value="<?php getInputValue("email"); ?>" required>
                    
                    <!-- CONFIRM E-MAIL AREA -->
                    <input type="email" name="email2" placeholder="Confirme seu e-mail" required>
                    
                    <!-- PASSWORD AREA -->
                    <?php echo $account->getError(Constants::$passwordDontMatch); ?>
                    <?php echo $account->getError(Constants::$passwordLenInvalid); ?>
                    <input type="password" name="password" placeholder="Crie uma senha segura." required>
                    
                    <!-- CONFIRM PASSWORD AREA -->
                    <input type="password" name="password2" placeholder="Confirme sua senha." required>

                    <!-- REGISTER BUTTON AREA -->
                    <input type="submit" name="submitButton" value="Registrar">
                
                </form>
                <!-- ./ End Register Form -->

                <a href="login.php" class="signInMessage">Já possui uma conta? Faça o login! </a>
            </div>
        </div>
        <!-- ./ End Login Panel -->
    </body>
</html>