document.addEventListener("DOMContentLoaded", function(event){
    let CP = document.getElementById("chybnePrihlaseni");


    let URLparams = window.location.href.split("?")[1].split("&");

    if(URLparams.includes("chybnePrihlaseni")){
        CP.style.display = "block";
    }

});
//////////////////// pridat checkovani hesel