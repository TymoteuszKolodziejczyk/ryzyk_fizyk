// Start
const inputLGraczy = document.getElementById('l_graczy')
const buttonLGraczy = document.getElementById('btnLGraczy')
const divNazwyGraczy = document.getElementById('divNazwyGraczy')
const formGracze = document.getElementById('formGracze')
let liczbaGraczy = null;

buttonLGraczy.addEventListener('click', function(){
    if(!(inputLGraczy.value >= 2)) {alert("Błędna ilość graczy"); return;}
    liczbaGraczy = inputLGraczy.value
    
    //Czyszczenie formularza
    while(formGracze.firstChild) formGracze.removeChild(formGracze.firstChild)

    for(let i=0; i < liczbaGraczy; i++){
        const input = document.createElement("input");
        input.type = "text"
        input.maxlength = "10"
        input.name = "gracz" + i
        formGracze.appendChild(input)
    }
    divNazwyGraczy.style.visibility = ''
})

function formGraczeSubmit(form){
    console.log(form)
}