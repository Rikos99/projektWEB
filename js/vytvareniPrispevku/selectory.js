var predlohaText = "";
var predlohaCesta = "../PredlohyPrispevku";

document.addEventListener("DOMContentLoaded", function(event){

    chceteZahoditTextButtonsSetup()

    const selector = document.getElementById("typPrispevkuId");

    selector.addEventListener("change", function(){
        changeTextArea(selector.value);
    })

})

function changeTextArea(typ){

    //let textArea = document.getElementById("hlavniEditor");

    switch (typ) {
        case "R":{
            setPredlohu(predlohaCesta + "/rozbor.html");
        }break;
        case "C":{
            setPredlohu(predlohaCesta + "/ctenarsky.html");
        }break;
        case "Z":{
            setPredlohu(predlohaCesta + "/zapisky.html");
        }
    }
}

function setPredlohu(nazevSouboru) {
    console.log(nazevSouboru);
    fetch(nazevSouboru)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(text => {

            novyTextVeHlavnimEditoru(text)

        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}


function novyTextVeHlavnimEditoru(t){
    if (CKEDITOR.instances["hlavniEditor"].getData() === ""){
        CKEDITOR.instances["hlavniEditor"].setData(t);
    }
    else {
        chceteZahoditTextZobrazitOkenko(t)
    }
}
function chceteZahoditTextZobrazitOkenko(t){
    document.getElementById("zahoditOkenko").hidden = false;
    predlohaText = t;
    console.log(predlohaText);
}


function chceteZahoditTextButtonsSetup() {
    okenko = document.getElementById("zahoditOkenko");

    document.getElementById("zahoditA").addEventListener("click", () => {
        CKEDITOR.instances["hlavniEditor"].setData(predlohaText);
        okenko.hidden = true;
        console.log("zahozeno");
    });
    document.getElementById("zahoditN").addEventListener("click", () => {
        okenko.hidden = true;
        console.log("nezahozeno");
    });
}

