document.addEventListener("DOMContentLoaded", function (event) {

    document.getElementById('fileInput')
        .addEventListener('change', function () {
            fileType = document.getElementById('fileInput').files[0].type;
            console.log(fileType)


            let fr = new FileReader();
            switch (fileType) {
                case 'text/plain':
                case 'text/html': {
                    fr.onload = function () {
                        novyTextVeHlavnimEditoru(fr.result);
                    }
                    fr.readAsText(this.files[0]);
                }break;

                case 'application/msword':
                case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':{
                    fr.onload = function (e) {
                        var arrayBuffer = fr.result;
                        mammoth.convertToHtml({arrayBuffer: arrayBuffer})
                            .then(function (result) {
                                var html = result.value;
                                var messages = result.messages;
                                novyTextVeHlavnimEditoru(html);
                            })
                            .catch(function (err) {
                                console.log("Error converting DOCX to HTML:", err);
                            });
                    };
                    fr.readAsArrayBuffer(this.files[0]);
                }break;
            }

        })
})

