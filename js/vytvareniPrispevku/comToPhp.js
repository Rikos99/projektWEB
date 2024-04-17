document.addEventListener("DOMContentLoaded", function (event) {
    const textareaContentJakoHtml = document.getElementById('textareaContentJakoHtml')


    CKEDITOR.instances['hlavniEditor'].on('change', function() {
        textareaContentJakoHtml.value = decodeHTMLEntities(CKEDITOR.instances['hlavniEditor'].getData());
        console.log(decodeHTMLEntities(CKEDITOR.instances['hlavniEditor'].getData()))
    });

    function decodeHTMLEntities(text) {
        var textArea = document.createElement('textarea');
        textArea.innerHTML = text;
        return textArea.value;
    }

})

