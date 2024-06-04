$(".dropbtn1").on("click",function(){

    $(this).next().toggleClass("show");

})

filtrovaniAutori = []
filtrovaneObdobi = []

$("document").ready(function(){

    $("#TextFilterKnihy").on("input", function(event) { // text filter pro knihy
        var searchTerm = event.target.value.toLowerCase();
        $(".knihaDiv").each(function() {
            var linkText = $(this).children("a").text().toLowerCase();
            if (linkText.includes(searchTerm)) {
                $(this).parent().show();
            } else {
                $(this).parent().hide();
            }
        });
        moznaNejsouKnizky()

        });

    $("#TextFilterAutori").on("input", function(event) { // text filter pro autory
        var searchTerm = event.target.value.toLowerCase();
        $(".autorFilter").each(function(i, e) {
            console.log(e)
            var linkText = $(e).children("label").text().toLowerCase();

            if (linkText.includes(searchTerm)) {
                $(this).show(); // Show the parent of the .autorFilter element
            } else {
                $(this).hide(); // Hide the parent of the .autorFilter element
            }
        });
        moznaNejsouKnizky()
    });

    //// AUTORI FILTER
    $(".autorFilter").children("input").on("change", function() {
        filtrovaniAutori = []
        $(".autorFilter").each(function(i, e) {
            if ($(e).children("input").is(":checked")) {
                filtrovaniAutori.push($(e).attr("autorId"))
            }
        })
        showFiltorovaneAutory()

    })

    function showFiltorovaneAutory(){
        if (filtrovaniAutori.length == 0) {
            $(".knihainfo").show();
            return
        }

        $(".knihainfo").each(function(i, e) {
            if( filtrovaniAutori.includes($(e).attr("autorid"))){
                $(e).show();
            }else{
                $(e).hide();
            }
        });
    }

    //obdobi

    $(".obdobiFilter").children("input").on("change", function() {
        filtrovaneObdobi = []
        $(".obdobiFilter").each(function(i, e) {
            if ($(e).children("input").is(":checked")) {
                filtrovaneObdobi.push($(e).attr("obdobiId"))
            }
        })
        showFiltorovaneObdobi()

    })

    function showFiltorovaneObdobi(){
        if (filtrovaneObdobi.length == 0) {
            $(".knihainfo").show();
            return
        }

        $(".knihainfo").each(function(i, e) {
            if( filtrovaneObdobi.includes($(e).attr("obdobiId"))){
                $(e).show();
            }else{
                $(e).hide();
            }
        });
    }

    $("#povinneKnihyInput").on("change", function() {
        console.log("povinneKnihyInput changed")
        checked = $(this).is(":checked")

        if (checked){
            $("povinnostKnihy").each(function(i, e) {
                if (parseInt($(e).attr("val")) == 1) {
                    console.log("show")
                    $(e).parent().show();
                } else {
                    console.log("hide")
                    $(e).parent().hide();
                }
            })
        }
        else{
            $("povinnostKnihy").each(function(i, e) {
                $(e).parent().show();
            })
        }
        moznaNejsouKnizky()
    })

    function moznaNejsouKnizky(){
        if ($(".knihainfo:hidden").length === $(".knihainfo").length) {
            $("#zadneKnihy").show();
        }
        else {
            $("#zadneKnihy").hide();
        }
    }



    /*$("#TextFilterObdobi").on("input", function(event) {
        var searchTerm = event.target.value.toLowerCase();
        $(".obdobiFilter").each(function(i, e) {
            console.log(e)
            var linkText = $(e).children("label").text().toLowerCase();

            console.log(linkText)
            console.log(searchTerm)

            if (linkText.includes(searchTerm)) {
                $(this).show(); // Show the parent of the .autorFilter element
            } else {
                $(this).hide(); // Hide the parent of the .autorFilter element
            }
        });
    });*/

    $()




})


