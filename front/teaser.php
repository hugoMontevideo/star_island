<!DOCTYPE html>
<html lang="fr">
<?php 
    require_once '../config/function.php';           
    //require_once 'inc/header.inc.php'; ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_PATH.'assets/css/style.css' ?>">
    
    <title>Star Island</title>
</head>
<body>
    <div class="layout">    
        <div class="teaser">

            <img src=" <?= BASE_PATH.'assets/pictures/Perso1.png' ?> " alt="">

            <div class="footer" style="margin: 0 auto;">

                <a id="facebook" class="reseaux facebook" href="">
                    <img src="<?= BASE_PATH.'assets/pictures/icons8-facebook.png' ?>" alt="facebook">
                </a>
                <a id="tiktok" class="reseaux" href="">
                    <img src="<?= BASE_PATH.'assets/pictures/icons8-tiktok.png' ?>" alt="tiktok">
                </a>
                <!-- <a class="reseaux" href=""><img src="<?php //BASE_PATH.'assets/pictures/icons8-discorde.png' ?>" alt="discorde"></a> -->
                <a id="twitter" class="reseaux" href="">
                    <img src="<?= BASE_PATH.'assets/pictures/icons8-twitter.png' ?>" alt="twitter">
                </a>
                <a id="youtube" class="reseaux" href="">
                    <img src="<?= BASE_PATH.'assets/pictures/icons8-youtube.png' ?>" alt="youtube">
                </a>
                <a id="discorde" class="reseaux" href="">
                    <img src="<?= BASE_PATH.'assets/pictures/icons8-discorde.png' ?>" alt="discorde">
                </a>
            </div>
            
        </div>
    </div>

    <div id="compte"></div>

    
    <script type="text/javascript">
        const Affiche=document.getElementById("compte");
        const discorde = document.querySelector("#discorde img");
   
        const reseaux = document.querySelectorAll(".reseaux");

        function Rebour() {
            var date1 = new Date();
            var date2 = new Date ("Jun 25, 2023 00:00:00");
            var sec = (date2 - date1) / 1000;
            var n = 24 * 3600;
            if (sec > 0) {
                j = Math.floor (sec / n);
                h = Math.floor ((sec - (j * n)) / 3600);
                mn = Math.floor ((sec - ((j * n + h * 3600))) / 60);
                sec = Math.floor (sec - ((j * n + h * 3600 + mn * 60)));
                Affiche.innerHTML =  j +" : "+ h +" : "+ mn +" : "+ sec ;
                //window.status = "Temps restant : " + j +" j "+ h +" h "+ mn +" min "+ sec + " s ";
            }
            tRebour=setTimeout ("Rebour();", 1000);
        }
        Rebour();

        // discorde.addEventListener('mouseenter', function(){
        //     reseaux.forEach( element => element.classList.add('active') )
        //     // reseaux.forEach( element => element.classList.toggle) )
        // })
        // document.querySelector(".footer").addEventListener('click', function(){
        //     reseaux.forEach( element => element.classList.remove('active') )
        //     // reseaux.forEach( element => element.classList.add('none'))

        //     // reseaux.forEach( element => element.classList.toggle) )
        // })

    </script>
</body>
</html>