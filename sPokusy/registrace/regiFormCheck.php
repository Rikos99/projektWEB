<?php

use phpMailer\phpMailerController;

if(isset($_POST["jmeno"])){
    echo "ch".checkRegisterFom();
}


function checkRegisterFom(){
    //if($_POST["password1"] != $_POST["password2"]){return -1;}

    session_start();

    require("phpMailer\phpMailerController.php");

    phpMailerController::initialize();//

    $_SESSION["authCode"] = phpMailerController::sendAuthenticationEmail($_POST["email"]);

    header( "Location: ".(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."?authWindow" );

    return 1;
}
