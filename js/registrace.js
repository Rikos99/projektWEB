document.addEventListener("DOMContentLoaded", function(event){
    let AO = document.getElementById("autentikacniOkenkoDiv");
    let spatnaAutentikaceText = document.getElementById("chybaAutentikaceP");

    let URLparams = window.location.href.split("?")[1].split("&");

    if(URLparams.includes("authWindow")){
        AO.style.display = "block"; //////////////////////////////////////////
    }
    if(URLparams.includes("spatnaAutentikace")){//////////////////NEFUNGUJE
        spatnaAutentikaceText.style.display = "block";
    }

});
