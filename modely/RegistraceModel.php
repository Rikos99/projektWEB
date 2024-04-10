<?php


class RegistraceModel
{
    function checkRegisterForm($SpravceUzivatelu){
        if($_POST["heslo"] != $_POST["heslo2"]){return -1;}
        if(in_array($_POST["email"], array_column($SpravceUzivatelu->vratVsechnyUzivatele(), 'email'))){return -2;}

        phpMailerModel::initialize();//
    
        $_SESSION["authCode"] = phpMailerModel::sendAuthenticationEmail($_POST["email"]);

        $_SESSION["prevPost"] = $_POST;

        header( "Location: ".(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."?authWindow" );
    }

    function checkAuthForm(){

        echo $_POST["authCode"];
        echo $_SESSION["authCode"];
        if($_POST["authCode"] == $_SESSION["authCode"]){
            return 1;
        }
        return 0;

    }


}