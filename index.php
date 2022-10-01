<?php 

    require_once("./includes/config.php");
    require_once("./includes/classes/PreviewProvider.php");

    // Verify if the user have an account and is logged 
    //      if false, return to the register page.
    if(!isset($_SESSION["userLoggedIn"])){
        header("Location: register.php");
    }

    $userLoggedIn = $_SESSION["userLoggedIn"];
    $preview = new PreviewProvider($con, $userLoggedIn);
    echo $preview->createPreviewVideo();

?>