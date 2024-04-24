
function getARESInformationFromICO(ICO){
    let paddedICO = ICO.padStart(8, "0")
    let url = `https://ares.gov.cz/ekonomicke-subjekty-v-be/rest/ekonomicke-subjekty/${paddedICO}`;

    return fetch(url)
        .then(response => {
            if (!response.ok) {
                return null;
            }
            return response.json();
        })

        .catch(error => {
            return null;
        });
}