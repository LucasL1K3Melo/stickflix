<?php 

    require_once("./includes/header.php");

    if(!isset($_GET["id"])){
        ErrorMessage::show("ERROR: No ID passed into page.");
    }
    $entityId = $_GET["id"];
    $entity = new Entity($con, $entityId);

    $preview = new PreviewProvider($con, $userLoggedIn);
    echo $preview->createPreviewVideo($entity); 

    $seasonProvider = new  SeasonProvider($con, $userLoggedIn);
    echo $seasonProvider->create($entity);
?>