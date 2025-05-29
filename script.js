// Start
const inputLGraczy = document.getElementById('l_graczy')
const buttonLGraczy = document.getElementById('btnLGraczy')
const divNazwyGraczy = document.getElementById('divNazwyGraczy')
const formGracze = document.getElementById('formGracze')
let liczbaGraczy = null;

buttonLGraczy.addEventListener('click', function(){
    if(!(inputLGraczy.value >= 2) || inputLGraczy.value>10 ) {alert("Błędna ilość graczy"); return;}
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
    const submit = document.createElement("input");
    submit.type = "submit";
    formGracze.appendChild(submit);
    divNazwyGraczy.style.visibility = ''
})

function formGraczeSubmit(form){
    // tu jest (ma byc) walidacja


    form.removeChild(form.lastChild)
    const gracze = [];
    form.childNodes.forEach(input => {
        gracze.push(input.value);
    });

    // Konwersja tablicy na ciąg znaków
    const queryString = gracze.map((item, index) => `gracz${index}=${encodeURIComponent(item)}`).join('&');

    // Adres URL, do którego chcesz wysłać dane
    const url = `gra.php?${queryString}`;

    // Przekierowanie do strony
    window.location.href = url;
    
}