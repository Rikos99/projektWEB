<?php


class RegistraceModel
{
    function checkRegisterFom(){
        //if($_POST["password1"] != $_POST["password2"]){return -1;}
    
        session_start();

    
        phpMailerModel::initialize();//
    
        $_SESSION["authCode"] = phpMailerModel::sendAuthenticationEmail($_POST["email"]);
    
        header( "Location: ".(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."?authWindow" );
    }

    function checkAuthFom(){
        session_start();

        echo $_POST["authCode"];
        echo $_SESSION["authCode"];
        if($_POST["authCode"] == $_SESSION["authCode"]){
            $this->createUser(); // uz databaze
            session_destroy();
            header( "Location: "."uspesnaRegistrace" );
        }
        else {
            header( "Location: ".(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."&spatnaAutentikace" );
        }

    }


    function createUser() {

    }

}