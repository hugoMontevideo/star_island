const Affiche = document.getElementById("compte");
const discordeButton = document.querySelector("#discorde-button-img");
const reseaux = document.querySelectorAll(".reseaux");

window.addEventListener('click', event =>{
    let currentElement = event.target;
    if(currentElement.getAttribute('id') == 'discorde-button-img'){
        reseaux.forEach(element => element.classList.add('active'));
    }else{
        reseaux.forEach(element => element.classList.remove('active'));               
    }
});