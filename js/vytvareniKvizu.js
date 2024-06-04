var otazky = [];

document.addEventListener('DOMContentLoaded', function(){



    document.getElementById("vytvoritOtazku").addEventListener('click', vytvoritOtazku)
})
function vytvoritOtazku(){
    const div = document.createElement('div');
    div.classList.add('otazka');

    const otazkaInputLabel = document.createElement('label');
    otazkaInputLabel.htmlFor = 'otazkaInput';
    otazkaInputLabel.classList.add('otazkaInputLabel');
    otazkaInputLabel.textContent = 'Otazka: ';

    const otazkaInput = document.createElement('input');
    otazkaInput.type = 'text';
    otazkaInput.classList.add('otazkaInput');

    const odpovediDiv = document.createElement('div');
    odpovediDiv.classList.add('odpovediDiv');

    const pridatOdpovedButton = document.createElement('button');
    pridatOdpovedButton.textContent = 'PridatOdpoved';
    pridatOdpovedButton.classList.add('pridatOdpovedButton');
    pridatOdpovedButton.type = 'button';

    const select = document.createElement('select');
    select.classList.add('druhInputu');

    const option1 = document.createElement('option');
    option1.value = 'jedna';
    option1.textContent = 'Jedna spravna odpoved';

    const option2 = document.createElement('option');
    option2.value = 'vice';
    option2.textContent = 'Vice spravnych odpovedi';

    select.appendChild(option1);
    select.appendChild(option2);

    const odebratOtazkuButton = document.createElement('button');
    odebratOtazkuButton.textContent = 'Odebrat Otazku';
    odebratOtazkuButton.classList.add('odebratOtazkuButton');
    odebratOtazkuButton.type = 'button';


    otazkaInput.addEventListener('input', () => {update()});
    select.addEventListener('change', () => {odpovediSpravnost(odpovediDiv, null)});
    pridatOdpovedButton.addEventListener('click', ()=>{vytvoritOdpoved(odpovediDiv)});
    odebratOtazkuButton.addEventListener('click', (ev)=>{odebratOtazku(ev.target.parentElement)});


    div.appendChild(otazkaInputLabel);
    div.appendChild(otazkaInput);
    div.appendChild(document.createElement('br'));
    div.appendChild(select);
    div.appendChild(document.createElement('br'));
    div.appendChild(odpovediDiv);
    div.appendChild(document.createElement('br'));
    div.appendChild(pridatOdpovedButton);
    div.appendChild(document.createElement('br'));
    div.appendChild(odebratOtazkuButton);

    document.getElementById("grafickeVkladaniDiv").appendChild(div);

    update()
}

function vytvoritOdpoved(odpovediDiv) {
    const div = document.createElement('div');
    div.classList.add('odpoved');

    const odpovedInputLabel = document.createElement('label');
    odpovedInputLabel.htmlFor = 'odpovedInput';
    odpovedInputLabel.classList.add('odpovedInputLabel');
    odpovedInputLabel.textContent = 'Odpoved: ';

    const odpovedInput = document.createElement('input');
    odpovedInput.type = 'text';
    odpovedInput.classList.add('odpovedInput');

    const checkboxLabel = document.createElement('label');
    checkboxLabel.htmlFor = 'checkbox';
    checkboxLabel.classList.add('checkboxLabel');
    checkboxLabel.textContent = 'Spravne';

    const checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.classList.add('odpovedInputSpravna');
    checkbox.disabled = !muzeBytDalsiSpravnaOdpoved(odpovediDiv.parentElement);

    const smazatOdpovedButton = document.createElement('button');
    smazatOdpovedButton.textContent = 'Odstranit odpoved';
    smazatOdpovedButton.classList.add('smazatOdpovedButton');
    smazatOdpovedButton.type = 'button';


    div.appendChild(odpovedInputLabel);
    div.appendChild(odpovedInput);
    div.appendChild(checkboxLabel);
    div.appendChild(checkbox);
    div.appendChild(smazatOdpovedButton);

    odpovedInput.addEventListener('input', () => {update()});
    checkbox.addEventListener('change', (ev) => {odpovediSpravnost(odpovediDiv, ev.target)});
    smazatOdpovedButton.addEventListener('click', (ev)=>{odebratOdpoved(ev.target.parentElement)});


    odpovediDiv.appendChild(div);

    update()
}

function muzeBytDalsiSpravnaOdpoved(otazkaDiv){
    const moznostSpravnychOdpovedi = otazkaDiv.querySelector('.druhInputu').value
    const pocetSpravnych = Array.from(otazkaDiv.querySelectorAll('.odpovedInputSpravna')).filter((el)=>{return el.checked}).length

    return !(moznostSpravnychOdpovedi === 'jedna' && pocetSpravnych === 1);

}

function odebratOdpoved(odpovedDiv) {
    odpovedDiv.remove()
    update()
}

function odpovediSpravnost(odpovediDiv, target) {
    const mnozstviSpravnychOdpovedi = odpovediDiv.parentElement.querySelector('.druhInputu').value
    const pocetSpravnychOdpovedi = Array.from(odpovediDiv.querySelectorAll('.odpovedInputSpravna')).filter((el)=>{return el.checked}).length

    console.log(mnozstviSpravnychOdpovedi)
    console.log(pocetSpravnychOdpovedi)

    if (mnozstviSpravnychOdpovedi === 'jedna'){
        if (pocetSpravnychOdpovedi !== 1){
            console.log(odpovediDiv.querySelectorAll('.odpovedInputSpravna'))
            odpovediDiv.querySelectorAll('.odpovedInputSpravna')
                .forEach((el)=>{el.checked = false; el.disabled = false})
        }
        else if(pocetSpravnychOdpovedi === 1){
            Array.from(odpovediDiv.querySelectorAll('.odpovedInputSpravna'))
                .filter((el)=>{return (el !== target) && (el.checked === false)})
                .forEach((el)=>{el.disabled = true})
        }
    }
    else if (mnozstviSpravnychOdpovedi === 'vice'){
        odpovediDiv.querySelectorAll('.odpovedInputSpravna')
            .forEach((el)=>{el.disabled = false})
    }

    update()
}

function vytvoritFormOtazku(otazkaDiv, index) {
    const formOtazka = document.createElement('div');
    formOtazka.classList.add('formOtazka');
    formOtazka.setAttribute('indexing', index);

    const otazkaText = document.createElement('h2');
    otazkaText.classList.add('formOtazkaText');
    otazkaText.textContent = `${index}. ${otazkaDiv.querySelector('.otazkaInput').value}`;

    const moznostSpravnychOdpovedi = otazkaDiv.querySelector('.druhInputu').value;

    const typInputuOdpovedi = (moznostSpravnychOdpovedi === 'jedna') ? 'radio' : 'checkbox';

    const formOdpovedi = document.createElement('div');
    formOdpovedi.classList.add('formOdpovedi');

    for (let i = 0; i < otazkaDiv.querySelectorAll('.odpovedInput').length; i++) {
        const formOdpovedLabel = document.createElement('label');
        formOdpovedLabel.classList.add('formOdpovedLabel');
        const indexing = String.fromCharCode('a'.charCodeAt(0) + i)
        formOdpovedLabel.textContent = indexing + ") " + otazkaDiv.querySelectorAll('.odpovedInput')[i].value;

        const formOdpoved = document.createElement('input');
        formOdpoved.type = typInputuOdpovedi;
        formOdpovedi.id = 'formOdpovedi' + i;
        formOdpoved.classList.add('formOdpovedInput');
        formOdpoved.name = 'otakza-' + index + '-' + (typInputuOdpovedi === 'radio' ? '' : indexing);
        formOdpoved.setAttribute('indexing', indexing);

        formOdpovedi.append(formOdpovedLabel)
        formOdpovedi.append(formOdpoved)
    }

    formOtazka.append(otazkaText)
    formOtazka.append(formOdpovedi)

    return formOtazka
}

function odebratOtazku(otazkaDiv) {
    otazkaDiv.remove()
    update()
}



function update() {
    console.log("UPDATE")
    const otazky = document.querySelectorAll(".otazka")
    console.log(otazky)

    let finalForm = document.createElement('form')


    let formSpravneOdpovedi = {}
    for (let i = 0; i < otazky.length; i++) {
        formSpravneOdpovedi[i+1] = Array.from(otazky[i].querySelectorAll(".odpovedInputSpravna"))
            .filter(el => el.checked)
            .map((el, index) => String.fromCharCode('a'.charCodeAt(0) + index))

        finalForm.append(vytvoritFormOtazku(otazky[i], i+1))
    }

    const submit = document.createElement('input')
    submit.type = 'submit'

    finalForm.append(submit)

    console.log(finalForm)

    document.getElementById("strukturaFormulare").innerHTML = finalForm.outerHTML
    document.getElementById("spravneOdpovediInput").value = JSON.stringify(formSpravneOdpovedi)

    document.getElementById("teloKvizu").value = finalForm.outerHTML
}
