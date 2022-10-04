<?php 

    require_once("./includes/header.php");

    $preview = new PreviewProvider($con, $userLoggedIn);
    echo $preview->createPreviewVideo(null); 

    $containersCategory = new CategoryContainers($con, $userLoggedIn);
    echo $containersCategory->showAllCategories(); 

?>
