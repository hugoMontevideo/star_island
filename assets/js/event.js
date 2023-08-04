const eventPage = document.querySelector('#event');

function loadImg(){
    // !!! l'url est a partir de index.php
    eventPage.style.backgroundImage = `url("./assets/upload/event/defaultBg.jpg")`;
    
}

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
});
