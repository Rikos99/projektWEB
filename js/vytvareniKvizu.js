$(document).ready(function(){

    $("#updateButton").on("click", updateVyslednehoKvizu)

    $("#vytvoritOtazku").on("click", function() { // pridani otazky
        /*let idOtazky = $("#grafickeVkladaniDiv div.otazka").map(function(){return $(this).attr("idOtazky")}).get()
        console.log(idOtazky)*/

        let div = $("<div>", {class: "otazka"/*, idOtazky: idOtazky*/}); // vytvoreni divu

        let otazkaInputLabel = $("<label>", {for: "otazkaInput",class: "otazkaInputLabel", text: /*idOtazky+*/"Otazka: "});
        let otazkaInput = $("<input>", {type: "text", class: "otazkaInput"});

        let odpovediDiv = $("<div>", {class: "odpovediDiv"});
        let pridatOdpovedButton = $("<button>", {text: "PridatOdpoved", class: "pridatOdpovedButton", type: "button"});


        let select = $("<select>", {class: "druhInputu"}); // pridani selektoru na pridani druhu odpovedi
        let options = [
            ("<option value='jedna'>Jedna spravna odpoved</option>"),
            ("<option value='vice'>Vice spravnych odpovedi</option>")
        ]
        select.append(options);

        let odebratOtazkuButton = $("<button>", {text: "Odebrat Otazku", class: "odebratOtazkuButton", type: "button"});

        let pridatOtazkuButton = $("<button>", {text: "Pridat Otazku", class: "pridatOtazkuButton", type: "button"});

        div.append(otazkaInputLabel)
        div.append(otazkaInput)
        div.append("<br>")
        div.append(select);
        div.append("<br>")
        div.append(odpovediDiv)
        div.append("<br>")
        div.append(pridatOdpovedButton);
        div.append("<br>")
        div.append(pridatOtazkuButton);
        div.append(odebratOtazkuButton);


        $("#vytvoritOtazku").before(div); // pripojeni divu pred tlactiko na vlozeni otazky

        updateOtazkyOrder()

        //div.find(".pridatOtazkuButton").on("click", (event) => pridatOtazku(event.target))

        div.find(".odebratOtazkuButton").on("click", (event) => odebratOtazku(event.target))
        div.find(".pridatOdpovedButton").on("click", (event) => pridatMoznouOdpoved(event.target))
        div.find(".druhInputu").on("change", (event) => zmenaDruhuInputu(event.target))
    });

    function updateOtazkyOrder(){
        $("#grafickeVkladaniDiv div.otazka").each(function(index) {
            $(this).children(".otazkaInputLabel").text((index + 1) + ". Otazka: ");
            $(this).attr("idOtazky", index + 1);
        });
    }
    function updateOdpovediOrder(){
        $("#grafickeVkladaniDiv div.otazka").each(function(index) {
            $(this).children(".odpovedInputLabel").text((index + 1) + ". Odpoved: ");
            $(this).attr("idOdpovedi", index + 1);
        });
    }


    function zmenaDruhuInputu(target){
        checboxy = $(target).parent().find(".odpovedInputSpravna")
        console.log(checboxy)
        checboxy.prop("disabled", false)
        console.log($(target).val())
        if($(target).val() === "jedna"){
            checboxy.prop("checked", false)
        }
    }

    function odebratOtazku(odebratButton){
        $(odebratButton).parent(".otazka").remove();
        console.log($(`#formOtazka [idotazky="${$(odebratButton).parent(".otazka").attr("idOtazky")}"]`))
        $("#strukturaFormulare").find(".formOtazka" + `[idotazky=${$(odebratButton).parent(".otazka").attr("idOtazky")}]`).remove();
        updateOtazkyOrder()
    }

/*
    function pridatOtazku(target){
        //let textarea = $("#htmlTextDiv textarea");
        let divOtazky = $(target).parent();
        let formDiv = $("#strukturaFormulare")

        console.log(divOtazky)
        console.log(formDiv)

        validita = otazkaValidni(divOtazky)

        if (validita !== true){
            if (divOtazky.children(".chybovyTextOtazky").length === 0){
                divOtazky.append($("<p>", {class: "chybovyTextOtazky", text: validita}));
            }
            else {
                divOtazky.children(".chybovyTextOtazky").text(validita)
            }
            return
        }
        else{
            divOtazky.children(".chybovyTextOtazky").remove()
        }

        let formOtazka = $("<div>", {class: "formOtazka", idOtazky: divOtazky.attr("idOtazky")});

        formOtazka.append($("<h2>", {class: "otazkaH2", text:divOtazky.find(".otazkaInput").val()}));
        if(divOtazky.find(".druhInputu").val() === "jedna"){divOtazky.attr("idOtazky")
            $(divOtazky).children(".odpovediDiv").children(".odpovedDiv").each(function(i,e){ // prokazdou odpoved
                formOtazka.append($("<label>", {for: "otazka"+divOtazky.attr("idotazky"), text: $(e).find(".odpovedInput").val()}));
                formOtazka.append($("<input>", {type: "radio", name: "otazka="+divOtazky.attr("idotazky"), value: $(e).find(".odpovedInput").val()}));
            })
        }
        else{
            $(divOtazky).children(".odpovediDiv").children(".odpovedDiv").each(function(i,e){
                formOtazka.append($("<label>", {for: "otazka"+divOtazky.attr("idotazky"), text: $(e).find(".odpovedInput").val()}));
                formOtazka.append($("<input>", {type: "checkbox", name: "otazka="+divOtazky.attr("idotazky")+";odpoved="+$(e).attr("idOdpovedi"), value: $(e).find(".odpovedInput").val()}));
            })
        }

        formOtazkaHTML = formOtazka.wrap("<p>").parent().html()

        stejne = formDiv.children(`[idOtazky='${formOtazka.attr("idOtazky")}']`)

        if (stejne.length > 0){
            formDiv.children(`[idOtazky='${formOtazka.attr("idOtazky")}']`).replaceWith(formOtazka);
        }
        else{
            formDiv.append(formOtazka);
        }

        spravneOdpovedi = $(divOtazky).find(".odpovedInputSpravna:checked").map(function(){
            return $(this).parent("div").attr("idOdpovedi")}
        ).get();

        let spravneOdpovediInput = $("#spravneOdpovediInput");
        let jsonData;

        try {
            jsonData = JSON.parse(spravneOdpovediInput.val());
        } catch (error) {
            jsonData = {};
        }

        jsonData[formOtazka.attr("idOtazky")] = spravneOdpovedi;

        spravneOdpovediInput.val(JSON.stringify(jsonData));

        console.log(spravneOdpovediInput.val())

    }*/

    function updateVyslednehoKvizu(){
        $("#strukturaFormulare").empty()

        $("#grafickeVkladaniDiv div.otazka").each(function(i,jednOtazkaDiv){
            if(praceSValiditou(jednOtazkaDiv)){
                $("#strukturaFormulare").append(vytvoritFormOtazku(jednOtazkaDiv))
                pridatSpranvneOdpovedProOtazku(jednOtazkaDiv)
            }
        })
    }

    function pridatSpranvneOdpovedProOtazku(divOtazky){
        spravneOdpovedi = $(divOtazky).find(".odpovedInputSpravna:checked").map(function(){
            return $(this).parent("div").attr("idOdpovedi")}
        ).get();

        let spravneOdpovediInput = $("#spravneOdpovediInput");
        let jsonData;

        try {
            jsonData = JSON.parse(spravneOdpovediInput.val());
        } catch (error) {
            jsonData = {};
        }

        jsonData[$(divOtazky).attr("idOtazky")] = spravneOdpovedi;

        spravneOdpovediInput.val(JSON.stringify(jsonData));jsonData[formOtazka.attr("idOtazky")] = spravneOdpovedi;

        spravneOdpovediInput.val(JSON.stringify(jsonData));
    }

    function otazkaValidni(div){
        if($(div).find(".otazkaInput").val() === ""){
            return "Otazka nesmi byt prazdna"
        }

        jsouOdpovediPrazdne = $(div).find(".odpovedInput").map(function(i,e){return $(e).val() === "";}).get()
        console.log(jsouOdpovediPrazdne)
        if (jsouOdpovediPrazdne.includes(true)){
            console.log("Musi byt vyplneny vsechny odpovedi")
            return `Odpoved nesmi byt prazdna (${jsouOdpovediPrazdne.indexOf(true) + 1}. odpoved je prazdna)`;
        }

        if($(div).find(".odpovedInputSpravna:checked").length === 0){
            return "Musi byt vybrana spravna odpoved"
        }

        return true
    }

    function praceSValiditou(jednOtazkaDiv){
        validita = otazkaValidni(jednOtazkaDiv)
        divOtazky = $("div.otazka")

        if (validita !== true){
            if (divOtazky.children(".chybovyTextOtazky").length === 0){ // vytvor p jestli neni
                divOtazky.append($("<p>", {class: "chybovyTextOtazky", text: validita}));
            }
            else {
                divOtazky.children(".chybovyTextOtazky").text(validita)
            }
            return false
        }
        divOtazky.children(".chybovyTextOtazky").remove()
        return true
    }



    function vytvoritFormOtazku(divOtazky){

        divOtazky = $(divOtazky)
        let formOtazka = $("<div>", {class: "formOtazka", idOtazky: divOtazky.attr("idOtazky")}); // divu


        formOtazka.append($("<h2>", {class: "otazkaH2", text:divOtazky.find(".otazkaInput").val()})); // text otazky
        if(divOtazky.find(".druhInputu").val() === "jedna"){divOtazky.attr("idOtazky") // jestlize muze byt jenom jedna odpoved spravne
            $(divOtazky).children(".odpovediDiv").children(".odpovedDiv").each(function(i,e){ // prokazdou odpoved
                formOtazka.append($("<label>", {for: "otazka"+divOtazky.attr("idotazky"), text: $(e).find(".odpovedInput").val()})); // label
                formOtazka.append($("<input>", {type: "radio", name: "otazka="+divOtazky.attr("idotazky"), value: $(e).find(".odpovedInput").val()})); // input checkbox
            })
        }
        else{ // pokud vice spranych odpovedi
            $(divOtazky).children(".odpovediDiv").children(".odpovedDiv").each(function(i,e){ // pro vsechny odpovedi
                formOtazka.append($("<label>", {for: "otazka"+divOtazky.attr("idotazky"), text: $(e).find(".odpovedInput").val()})); //bael
                formOtazka.append($("<input>", {type: "checkbox", name: "otazka="+divOtazky.attr("idotazky")+";odpoved="+$(e).attr("idOdpovedi"), value: $(e).find(".odpovedInput").val()})); // pridat jako radio
            })
        }

        return formOtazka

    }

    function pridatMoznouOdpoved(target){
        console.log(target)

        let pocetOdpovedi = $(target).find(".odpovedInput").length + 1

        let odpovedDiv = $("<div>", {class: "odpovedDiv", idOdpovedi: `${pocetOdpovedi}`});

        odpovedDiv.append($("<label>", {for: `odpovedInput${pocetOdpovedi}`,class: "odpovedInputLabel" , text: `Odpoved ${pocetOdpovedi}: `}));
        odpovedDiv.append($("<input>", {type: "text", class: "odpovedInput", id: `odpovedInput${pocetOdpovedi}`}));
        odpovedDiv.append($("<input>", {type: "checkbox", class: "odpovedInputSpravna", id: `odpovedInputSpravna${pocetOdpovedi}`}));
        odpovedDiv.append($("<label>", {for: `odpovedInputSpravna${pocetOdpovedi}`, text: "Spravna"}));
        odpovedDiv.append($("<button>", {text: "Odstranit odpoved", class: "smazatOdpovedButton", id: `smazatOdpovedButton${pocetOdpovedi}`, type: "button"}));

        odpovedDiv.append($("<br>"))

        $(target).siblings(".odpovediDiv").append(odpovedDiv);

        otazkaDiv = odpovedDiv.parent().parent(".otazka")

        if (otazkaDiv.find(".odpovedInputSpravna:checked").length > 0 && otazkaDiv.find(".druhInputu").val() === "jedna"){
            $(odpovedDiv).children(".odpovedInputSpravna").prop("disabled", true)
        }

        updateOdpovediOrder()

        otazkaDiv.find(`#odpovedInputSpravna${pocetOdpovedi}`).on("change", (event) => vybratSpravnouOdpoved(event.target));
        otazkaDiv.find(`#smazatOdpovedButton${pocetOdpovedi}`).on("click", (event) => odebratOdpoved(event.target));
    }
    function vybratSpravnouOdpoved(target){
        otazkaDiv = $(target).parent("div").parent("div").parent(".otazka")

        //console.log(otazkaDiv)

        if (otazkaDiv.find(".odpovedInputSpravna:checked").length > 0){
            if(otazkaDiv.find(".druhInputu").val() === "jedna"){
                otazkaDiv.find(".odpovedInputSpravna").prop("disabled", true)
                $(target).prop("disabled", false)
            }
            else if($(".druhInputu").val() === "vice"){
                otazkaDiv.find(".odpovedInputSpravna").prop("disabled", false)
            }
        }
        else {
            $(".odpovedInputSpravna").prop("disabled", false)
        }
    }

    function odebratOdpoved(button){
        $(button).parent(".odpovedDiv").remove();
        updateOdpovediOrder()
    }

    $("#vyrvoritKviz").on("click", (event) => {
        $("form #teloKvizu").val($("#strukturaFormulare").html())

    });


})