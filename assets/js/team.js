const home2Section = document.querySelector('#team');// chgt url selon screen.width
const cellList = document.querySelectorAll(".cell");
const aSocialList = document.querySelectorAll(".userSocials a.social");
const layoutTeamSelected = document.querySelector(".layout_team_selected");

// console.log(cellList.length)


// let i = 0;
/****************************** */
/*******  FUNCTIONS  ********* */
/****************************** */
function loadImg(){
    // !!! l'url est a partir d' index.php
    home2Section.style.backgroundImage = `url("./assets/pictures/desktop/gta_decors12.png")`;
   
}

// fonction innécessaire
function rawOddEven(){
    rawList.forEach ((raw) => {

        if (i%2 == 1){
            raw.classList.add('even');
            let cellChildren = Array.from(raw.children); // array à partir enf cellChildren
            let ii = 0;
            cellChildren.forEach((cell) => {
                if(ii%2 == 0){
                    cell.classList.add('cell');
                }
                ii++;
            })
            

        }else{
            raw.classList.add('odd');
            let cellChildren = Array.from(raw.children); // array à partir enf cellChildren
            let ii = 0;
            cellChildren.forEach((cell) => {
                if(ii%2 == 1){
                    cell.classList.add('cell');
                }
                ii++;
            })
        }
        i++
    });
    i = 0; // remise à zero du compteur
}

function cellActive(){
    cellList.forEach ((cell) => {
        cell.addEventListener('click', function(){
            // cellList.forEach((cell1) => { // baisser les zindex des users
            //     cell1.classList.remove('selected');
            // })
            cell.classList.toggle('selected'); 
            layoutTeamSelected.classList.toggle('active');
        })
    });
}

// compte le nombre de reseaux
function nbSocialOnCell(){
    cellList.forEach ((cell) => {
        console.log(cell);

        if(cell.querySelectorAll('.social').length == 0){
            cell.classList.add('zero');
        }else if(cell.querySelectorAll('.social').length == 1){
            cell.classList.add('one');
        }else if(cell.querySelectorAll('.social').length == 2){
            cell.classList.add('two');
        }else if(cell.querySelectorAll('.social').length == 3){
            cell.classList.add('three');
        }else if(cell.querySelectorAll('.social').length == 4){
            cell.classList.add('four');
        }else if(cell.querySelectorAll('.social').length == 5){
            cell.classList.add('five');
        }else if(cell.querySelectorAll('.social').length == 6){
            cell.classList.add('six');
        }
    });

}

function startup() {
    if(screen.width > 600){  // chrgt des images larges
        loadImg() 
    }; 
    nbSocialOnCell();

    cellActive();  // ecouteurs sur les membres de la team
    //rawOddEven(); // add class odd ou even
}

/****************************** */
/*******     CODE     ********* */
/****************************** */

startup();

// const oddList = document.querySelectorAll(".odd");
// const cellList = document.querySelectorAll(".cell");
// console.log(cellList)

// cellActive();

// cellActive();