const diaporama = document.querySelector('.diaporama');  // slider a puces
const elements = document.querySelector('.elements');
const homeImg = document.querySelector('#home-img');
const sliderImg = document.querySelector('#slider-img');
const serveurImg = document.querySelector('#serveur-img');
const home2Img = document.querySelector('#home2-img');

const caption = document.querySelectorAll('.caption');
const slides = Array.from(elements.children);
let slideWidth = diaporama.getBoundingClientRect().width;
const pucesDiv = document.querySelectorAll('.puce-div');
let compteur = 0;

let xDown = null;    // swipe                                                
// let yDown = null;

let nIntervId = null;  // slider 2eme page
let varPrev =0;
let varNow = 1;
let varNext = 2;
let index = 0;
let autoplayDelay = 3; // delai en secondes
// let arraySlides = [];
const itemsList = document.querySelectorAll(".cascade-slider_item");
const arrowNext = document.querySelector("#arrowNext");
const arrowPrev = document.querySelector("#arrowPrev");

let test = screen.width;
console.log(test)
console.log('hello')


// FUNCTIONS

/**
 * Slider de homepage
 */
function slideNext(){                           // slider à puces
    let decal = -slideWidth * compteur;
    elements.style.transform = `translateX(${decal}px)`;

}

// remove active a toutes les puces
function puceActive(){
    pucesDiv.forEach(function(puce1){          
        puce1.classList.remove('active');
        if(puce1.dataset.item == compteur){
            puce1.classList.add('active');
        }
    })

}

function getTouches(evt) {      // swipe
    // console.log(evt)
  return evt.touches // API browser
//    ||   evt.originalEvent.touches; // jQuery
}   

function handleTouchStart(evt) {           // swipe
    const newTouch = getTouches(evt)[0];                                      
    xDown = newTouch.clientX;                                      
    // yDown = firstTouch.clientY;                                      
};   
// Charge les images de fond de home => screen > 700px
function loadImg(){
    homeImg.src = "assets/pictures/desktop/gta_decors1.jpg";
    sliderImg.src = "assets/pictures/desktop/gta_decors6.jpg";
    serveurImg.src = "assets/pictures/desktop/gta_decors3.jpg";
    home2Img.src = "assets/pictures/desktop/gta_decors7.jpg";
}
                                                                         
function handleTouchMove(evt) {            // swipe  
                console.log( evt)

    if ( ! xDown ) {
    //     // if ( ! xDown && ! yDown ) {  
        return;
    }
        
    var xUp = evt.touches[0].clientX;                                    
    // var yUp = evt.touches[0].clientY;
    
    var xDiff = xDown - xUp;
    // var yDiff = yDown - yUp;
    
    // if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {/*most significant*/
    //if ( Math.abs( yDiff ) > 300 &&  Math.abs( yDiff ) < 500 ) {/*most significant*/
    // console.log( Math.abs( yDiff ) + 'xUp' + yDiff)
    
    if ( xDiff > 0 ) {
        /* right swipe */ 
        if( compteur < pucesDiv.length -1 ){  
                // console.log( compteur)
                compteur++
                slideNext();
                puceActive();
            }
        } else {
            if( compteur > 0 ){      
                compteur--
                slideNext();
                puceActive();
            }
        }                       
    //} //else {
    //     if ( yDiff > 0 ) {
    //         /* down swipe */ 
    //     } else { 
    //         /* up swipe */
    //     }                                                                 
    // }
    /* reset values */
    xDown = null;
    // yDown = null;                                             
};


function dataId(){                     // slider 2ème homepage
    itemsList.forEach(item => {
        item.dataset.id = index;
        // arraySlides.push(index);
        index ++;
    })
};

function display( varNow ) {            // slider 2ème homepage
    varPrev = varNow - 1;
    varNext = varNow + 1;
   
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

    return varNow;
};

function autoPlay() {             // slider 2ème homepage
    // console.log(varNow);        
    varNow = display( varNow ) 
     
    varNow++
};

 

function startup(){
    if(screen.width > 600){  // chrgt des images larges
        loadImg() }; 

    document.addEventListener('touchstart', handleTouchStart, false);        
    document.addEventListener('touchmove', handleTouchMove, false);
};

/**        CODE
 * **********************************************
 */

document.addEventListener('DOMContentLoaded', function(){

    startup();

    pucesDiv.forEach( function(puce){                   //  slider a puces
        // ecouteur evt sur les puces de homepage
        puce.addEventListener('click', () => {

            pucesDiv.forEach(function(puce1){          
                puce1.classList.remove('active');
            })
            
            puce.classList.add('active');
            compteur = puce.dataset.item ;

            // if(puce.dataset.item == 1){
            //     document.getElementById('home-p').style.opacity = 1; 
            // }else{
            //     document.getElementById('home-p').style.opacity = 0; 
            // }         
            slideNext();          
        });
    });

    dataId();                                                     // slider 2ème homepage
    nIntervId = setInterval(autoPlay, autoplayDelay*1000);   

    arrowNext.addEventListener('click', () => {
        varNow = parseInt(document.querySelector('.now').dataset.id) + 1;
        clearInterval(nIntervId);
        
        varNow = display(varNow);
        nIntervId = null;
        nIntervId = setInterval(autoPlay, autoplayDelay*1000);
        
    });

    arrowPrev.addEventListener('click', () => {                           // slider 2ème homepage
        varNow = parseInt(document.querySelector('.now').dataset.id) - 1;
        clearInterval(nIntervId);
        
        varNow = display(varNow);
        nIntervId = null;
        nIntervId = setInterval(autoPlay, autoplayDelay*1000);
        
    });






}); // DOMContentLoaded










