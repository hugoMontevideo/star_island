const diaporama = document.querySelector('.diaporama');  // slider a puces
const elements = document.querySelector('.elements');
const homeImg = document.querySelector('#home-img');
const sliderImg = document.querySelector('#slider-img');
const serveurImg = document.querySelector('#serveur-img');
const home2Img = document.querySelector('#home2-img');
const starsCommentsList = document.querySelectorAll(".avis .etoiles");
const home1FormStarsArray = document.querySelectorAll(".home-page3-form .etoiles i");
const home2FormStarsArray = document.querySelectorAll(".home2-form .etoiles i");
const home1FormStarInput = document.querySelector("#home1StarInput");
const home2FormStarInput = document.querySelector("#home2StarInput");

// console.log(homeFormStarsArray)

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

// let test = screen.width;

// ******** FUNCTIONS  ********
// ****************************
/**
 * Slider de homepage
 */
function slideNext(){            // slider à puces
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

function yellowStars( arrayStars, nbYellowStars=3 ){
    // for(let i=0; i<nbYellowStars; i++){
    for(let i=0; i<arrayStars.length; i++){
        if(i<nbYellowStars){
            arrayStars[i].style.color = '#ffbe02';
        }else{
            arrayStars[i].style.color = '#e8cbd7d9';
        }
    }
}

function dataId(){                     // slider 2ème homepage touches prev next
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
        loadImg() 
    }; 

    document.addEventListener('touchstart', handleTouchStart, false);  //  swipe page d'accueil  
    document.addEventListener('touchmove', handleTouchMove, false);

    starsCommentsList.forEach(avis => {   // remplir les etoiles des avis
        let starsArray = Array.from(avis.children); 
        let nbYellowStars = avis.dataset.star
        yellowStars( starsArray, nbYellowStars );
    })
    
    yellowStars(home1FormStarsArray) // remplir les etoiles du home page3 form
    yellowStars(home2FormStarsArray) // remplir les etoiles du home2 form

    for(let i=0; i<home1FormStarsArray.length; i++){  // ecouteur click sur les etoiles du home page3 form
        home1FormStarsArray[i].addEventListener('click', function(){
            // console.log(i);
            yellowStars(home1FormStarsArray, i+1);         
        });
    };
    for(let i=0; i<home2FormStarsArray.length; i++){  // ecouteur click sur les etoiles du home2 form
        home2FormStarsArray[i].addEventListener('click', function(){
            // console.log(i);
            yellowStars(home2FormStarsArray, i+1);         
        });
    };


    for(let i=0; i<home1FormStarsArray.length; i++){  // ecouteur mouseenter sur les etoiles du home page3 form
        home1FormStarsArray[i].addEventListener('mouseenter', (event) => {
            yellowStars(home1FormStarsArray, i+1);  
            home1FormStarInput.value = i+1;        
        });
    };
    for(let i=0; i<home2FormStarsArray.length; i++){  // ecouteur mouseenter sur les etoiles du home form
        home2FormStarsArray[i].addEventListener('mouseenter', (event) => {
            yellowStars(home2FormStarsArray, i+1);
            home2FormStarInput.value = i+1;        
        });
    };

    


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






}); // DOMContentLoaded










