const rawList = document.querySelectorAll(".raw");

let i = 0;
/****************************** */
/*******  FUNCTIONS  ********* */
/****************************** */

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
                cell.classList.toggle('flip');
        })

        // if(raw.classList.contains(odd)){

        // }



    });
}

function start() {
    rawOddEven(); // add class odd ou even
}
/****************************** */
/*******     CODE     ********* */
/****************************** */

start();

const oddList = document.querySelectorAll(".odd");
const cellList = document.querySelectorAll(".cell");
// console.log(cellList)

cellActive();

// cellActive();