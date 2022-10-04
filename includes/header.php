<?php

    require_once("./includes/config.php");
    require_once("./includes/classes/PreviewProvider.php");
    require_once("./includes/classes/CategoryContainers.php");
    require_once("./includes/classes/Entity.php");


    // Verify if the user have an account and is logged 
    //      if false, return to the register page.
    if(!isset($_SESSION["userLoggedIn"])){
        header("Location: register.php");
    }

    $userLoggedIn = $_SESSION["userLoggedIn"];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>StickFlix - Página inicial</title>

        <link rel="stylesheet" href="./assets/style/style.css">
    </head>
    <!-- ./ -->
    <body>
        <div class="wrapper">

        <!-- Scripts Area -->
        <script>
            function volumeToggle(button){
                let muted = $(".previewVideo").prop("muted");
                $(".previewVideo").prop("muted", !muted);
            
                $(button).find("i").toggleClass("fa-volume-xmark");
                $(button).find("i").toggleClass("fa-volume-high");
            }
            
            function previewEnded(){
                $(".previewVideo").toggle();
                $(".previewImage").toggle();
            }

        </script>
        <!-- Script End ./ -->

        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/5c7654e0c9.js" crossorigin="anonymous"></script>