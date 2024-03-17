<?php

if(isset($_POST["authCode"])){
    checkAuthFom();

}

function checkAuthFom(){
    session_start();

    echo $_POST["authCode"];
    echo $_SESSION["authCode"];
    if($_POST["authCode"] == $_SESSION["authCode"]){
        //createUser() // uz databaze
        session_destroy();
        header( "Location: "."uspesnePrihlaseni" );
    }
    else {
        // pridat counter na spatne pokusy (dat promennou do session jako array(zacatekBanu (datum/timestamp), delkaBanu))
        header( "Location: ".(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."&spatnaAutentikace" );

    }

}