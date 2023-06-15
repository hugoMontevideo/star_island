const diaporama = document.querySelector('.diaporama');
const elements = document.querySelector('.elements');
const caption = document.querySelectorAll('.caption');
console.log(caption[0]);
const slides = Array.from(elements.children);
let slideWidth = diaporama.getBoundingClientRect().width;

let compteur = 0;

/**
 * Slider de homepage
 */
function slideNext(){
    // caption[compteur].classList.remove('active');
    if(compteur == slides.length-1){
        compteur = -1;
    }
    compteur++;
    // caption[compteur].classList.add('active');
    let decal = -slideWidth * compteur;
    elements.style.transform = `translateX(${decal}px)`;

}


document.addEventListener('DOMContentLoaded', function(){

    timer = (setInterval(slideNext,4000));
})