const home2Section = document.querySelector('#galerie');
const mainImg = document.querySelector('#main-img');

let nIntervId = null;  // slider page galerie
let varPrev = 0;
let varNow = 1;
let varNext = 2;
let index = 0;
let autoplayDelay = 3; // délai en secondes
// let arraySlides = [];
const itemsList = document.querySelectorAll(".cascade-slider_item");
const arrowNext = document.querySelector("#arrowNext");
const arrowPrev = document.querySelector("#arrowPrev");

// console.log(itemsList+ '  '+ varPrev)


// FUNCTIONS

function loadImg(){
    // !!! l'url est a partir de index.php
    home2Section.style.backgroundImage = `url("./assets/pictures/desktop/gta_decors13.png")`;
    
}

function display( varNow ) {            // slider 2ème page
    varPrev = varNow - 1;
    varNext = varNow + 1;
    
    console.log( varPrev )
    if( varNow < 0 ){
        varPrev = itemsList.length - 2;
        varNow = itemsList.length - 1;
        varNext = 0;
    }
    
    if( varNow == itemsList.length - 1){
        varNext = 0;
    }
    if( varNow == 0){
        varPrev = 4;
        varNext = 1;
    }
    if( varNow == itemsList.length  ){
        varPrev = 4;
        varNow = 0;
        varNext = 1;
    }
    itemsList.forEach(item => {
        item.classList.remove('prev');
        item.classList.remove('now');
        item.classList.remove('next');
    })
    
    itemsList[varPrev].classList.add('prev');
    itemsList[varNow].classList.add('now');
    itemsList[varNext].classList.add('next');

    mainImg.src = document.querySelector(".now img").src

    return varNow;
};
function autoPlay() {             // slider 2ème page
    // console.log(varNow);        
    varNow = display( varNow ) 
     
    varNow++
};

function dataId(){                     // slider 2ème page touches prev next
    itemsList.forEach(item => {
        item.dataset.id = index;
        // arraySlides.push(index);
        index ++;
    })
};

function startup(){
    if(screen.width > 600){  // chrgt des images larges
        loadImg() 
    }; 

};

/**        CODE
 * **********************************************
 */
document.addEventListener('DOMContentLoaded', function(){

    startup();

    dataId(); 
    nIntervId = setInterval(autoPlay, autoplayDelay*1000);   

    arrowNext.addEventListener('click', () => {
        varNow = parseInt(document.querySelector('.now').dataset.id) + 1;

        arrowNext.classList.add('arrow-clicked');
        setTimeout(() => {
            arrowNext.classList.remove('arrow-clicked');
          }, 200);

        clearInterval(nIntervId);
        
        varNow = display(varNow);
        nIntervId = null;
        nIntervId = setInterval(autoPlay, autoplayDelay*1000);
        
    });

    arrowPrev.addEventListener('click', () => {                           // slider 2ème homepage
        varNow = parseInt(document.querySelector('.now').dataset.id) - 1;

        arrowPrev.classList.add('arrow-clicked');
        setTimeout(() => {
            arrowPrev.classList.remove('arrow-clicked');
          }, 200);

        clearInterval(nIntervId);
        
        varNow = display(varNow);
        nIntervId = null;
        nIntervId = setInterval(autoPlay, autoplayDelay*1000);
        
    });

});