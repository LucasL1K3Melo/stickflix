<?php 

    require_once("./includes/config.php");
    require_once("./includes/classes/FormSanitizer.php");
    require_once("./includes/classes/Constants.php");
    require_once("./includes/classes/Account.php");

    $account = new Account($con);

    if(isset($_POST["submitButton"])){

        $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
        
        $success = $account->login($username, $password);
        
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
        <meta charset="utf-8">
        <title>Acesse o StickFlix</title>

        <link rel="stylesheet" href="./assets/style/style.css">
    </head>
    <!-- ./ -->
    <body>

        <!-- Login Panel -->
        <div class="signInContainer">
            <div class="column">

                <div class="header">
                    <img src="./assets/images/StickflixLogotipo.png" title="Logo" alt="Site logo"> <!-- Logotipo -->
                    <h3> Efetue o login! </h3>
                    <span>e continue para o StickFlix</span>
                </div>

                <!-- Register Form -->
                <form method="POST">

                    <?php echo $account->getError(Constants::$loginFailed); ?>
                    <input type="text" name="username" placeholder="Digite seu usuário" value="<?php getInputValue("username"); ?>" required>
                    
                    <input type="password" name="password" placeholder="Digite sua senha" required>

                    <input type="submit" name="submitButton" value="Entrar">
                
                </form>
                <!-- ./ End Register Form -->

                <a href="register.php" class="signInMessage">Precisa de uma conta? Registre-se agora mesmo.</a>
            </div>
        </div>
        <!-- ./ End Login Panel -->
    </body>
</html>