function dropDownOpenerSetup() {
    $(".dropbtn1").on("click",function(){

        $(this).next().toggleClass("show");

    })
}


filtrOrig = {
    'knihy':{
        'textFilter':'',
        'povinne':false
    },
    'autori':{
        'textFilter':'',
        'checkboxFilter':[]
    },
    'obdobi':{
        'checkboxFilter':[]
    }
}
filtr = filtrOrig

document.addEventListener('DOMContentLoaded', function(){
    dropDownOpenerSetup()
    resetFilterButtonSetup()

    textFilterSetup()
    checkboxFilterSetup()

})

function textFilterSetup() {
    const textFilterKnihy = document.getElementById('TextFilterKnihy')
    const textFilterAutori = document.getElementById('TextFilterAutori')

    textFilterKnihy.addEventListener('input', (event) => {
        filtr['knihy']['textFilter'] = event.target.value
        console.log(filtr)
        update()
    })

    textFilterAutori.addEventListener('input', (event) => {
        filtr['autori']['textFilter'] = event.target.value
        const checkboxFiltry = document.querySelectorAll('.autorFilter')

        for (let i = 0; i < checkboxFiltry.length; i++) {
            const checkboxFiltr = checkboxFiltry[i]
            console.log(checkboxFiltr.querySelector('label').innerText.toLowerCase())
            if(checkboxFiltr.querySelector('label').innerText.toLowerCase().includes(event.target.value)) {
                checkboxFiltr.classList.remove('hidden')
            }
            else {
                checkboxFiltr.classList.add('hidden')
            }
        }
    })

}

function checkboxFilterSetup() {
    const checkboxFilterPovinne = document.querySelector('.povinneKnihy')
    const checkboxFilterAutori = document.querySelectorAll('.autorFilter')
    const checkboxFilterObdobi = document.querySelectorAll('.obdobiFilter')

    checkboxFilterPovinne.addEventListener('change', (event) => {
        filtr['knihy']['povinne'] = event.target.checked
        console.log(filtr)
        update()
    })

    checkboxFilterAutori.forEach((inp)=>{
        inp.addEventListener('change', (event) => {
            if (event.target.checked) {
                filtr['autori']['checkboxFilter'].push(event.target.parentElement.querySelector('label').innerText)
            }
            else {
                filtr['autori']['checkboxFilter'] = filtr['autori']['checkboxFilter'].filter((el)=>{return el !== event.target.parentElement.querySelector('label').innerText})
            }
            update()
        })
    })

    checkboxFilterObdobi.forEach((inp)=>{
        inp.addEventListener('change', (event) => {
            if (event.target.checked) {
                filtr['obdobi']['checkboxFilter'].push(event.target.parentElement.querySelector('label').innerText)
            }
            else {
                filtr['obdobi']['checkboxFilter'] = filtr['obdobi']['checkboxFilter'].filter((el)=>{return el !== event.target.parentElement.querySelector('label').innerText})
            }
            update()
        })
    })

}

function update(){
    const knihy = document.querySelectorAll('.knihainfo')

    knihy.forEach((kniha=>{
        const nazev = kniha.querySelector('.nazevKnihy').innerText.toLowerCase()
        const jmenoAutora = kniha.querySelector('.jmenoAutora').innerText.toLowerCase()
        const nazevObdobi = kniha.querySelector('.nazevObdobi').innerText.toLowerCase()
        const jePovinna = kniha.querySelector('.povinnaKniha')

        if(filtr['knihy']['povinne'] === true && !jePovinna){
            kniha.classList.add('hidden')
        }

        else if (!nazev.includes(filtr['knihy']['textFilter'])){
            kniha.classList.add('hidden')
        }
        else if (!filtr['autori']['checkboxFilter'].map(item => item.toLowerCase()).includes(jmenoAutora) && filtr['autori']['checkboxFilter'].length > 0){
            kniha.classList.add('hidden')
        }
        else if(!filtr['obdobi']['checkboxFilter'].map(item => item.toLowerCase()).includes(nazevObdobi) && filtr['obdobi']['checkboxFilter'].length > 0){
            kniha.classList.add('hidden')
        }
        else{
            kniha.classList.remove('hidden')
        }
    }))

    console.log(filtr)


    if(Array.from(knihy).filter((kniha)=>{return !kniha.classList.contains('hidden')}).length === 0){
        document.querySelector('#zadneKnihy').classList.remove('hidden')
        console.log("add")
    }
    else{
        document.querySelector('#zadneKnihy').classList.add('hidden')
    }

}


function resetFilterButtonSetup() {
    const resetFilterButton = document.querySelector('.resetFilter')
    console.log(resetFilterButton)

    resetFilterButton.addEventListener('click',()=>{
        filtr = JSON.parse(JSON.stringify(filtrOrig));

        document.querySelector('.filter').querySelectorAll('input[type=text]').forEach((inp)=>{
            inp.value = ''
        })
        document.querySelector('.filter').querySelectorAll('input[type=checkbox]').forEach((inp)=>{
            inp.checked = false
        })
        document.querySelector('#povinneKnihyInput').checked = false

        document.querySelectorAll('.autorFilter').forEach((autorFiltr)=>{
            autorFiltr.classList.remove('hidden')
        })

        filtr['knihy']['povinne'] = false
        filtr['autori']['checkboxFilter'] = []

        console.log("update")
        update()
    })
}