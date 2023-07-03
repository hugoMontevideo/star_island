<!DOCTYPE html>
<html lang="fr">
<?php
require_once '../config/function.php';
//require_once 'inc/header.inc.php'; 
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= BASE_PATH . 'assets/pictures/favicon.ico'?>" type="image/x-icon">

    <link rel="stylesheet" href="<?= BASE_PATH . 'assets/css/reboursCezaire.css' ?>">
    <link rel="stylesheet" href="<?= BASE_PATH . 'assets/css/teaser.css' ?>">
    <script src="<?= BASE_PATH . 'assets/jquery/jquery.min.js'?>" defer></script>
    <script src="<?= BASE_PATH . 'assets/js/links.js' ?>" defer></script>
    <script src="<?= BASE_PATH . 'assets/js/reboursCezaire.js' ?>" defer></script>

    <title><?= CONFIG['app']['tmp_name'] ?></title>
</head>
<body>
    <div class="logo">
        <a href="https://discord.com/channels/903237992729169920/903237993509310514">
            <img src="../assets/pictures/logo_starIsl.png" alt="logo">
        </a>
    </div>

    <div class="teaser">
        <div class="img">
            <img src=" <?= BASE_PATH . 'assets/pictures/predation.png' ?>" alt="">
            <div class="layout-img"></div>
        </div>        
    </div>
    
    <div class="footer" >

        <a id="facebook" class="reseaux" href="https://www.facebook.com/StarIslandfr-108004258577047">
            <img src="<?= BASE_PATH . 'assets/pictures/icons8-facebook.png' ?>" alt="facebook">
        </a>
        <a id="tiktok" class="reseaux" href="https://www.tiktok.com/@star.island?lang=fr">
            <img src="<?= BASE_PATH . 'assets/pictures/icons8-tiktok.png' ?>" alt="tiktok">
        </a>
        <a id="twitter" class="reseaux" href="https://twitter.com/StarIslandfr">
            <img src="<?= BASE_PATH . 'assets/pictures/icons8-twitter.png' ?>" alt="twitter">
        </a>
        <a id="youtube" class="reseaux" href="https://www.youtube.com/channel/UCI7G6fNN-17g1_tOVMKRCpQ">
            <img src="<?= BASE_PATH . 'assets/pictures/icons8-youtube.png' ?>" alt="youtube">
        </a>
        <a id="twitch" class="reseaux" href="https://discord.com/channels/903237992729169920/903237993509310514">
            <img src="<?= BASE_PATH . 'assets/pictures/logo_twitch.png' ?>" alt="twitch">
        </a>
        <a id="instagram" class="reseaux" href="https://www.instagram.com/starisland.fr/">
            <img src="<?= BASE_PATH . 'assets/pictures/logo_Instagram.png' ?>" alt="instagram">
        </a>
        <a id="discorde" class="reseaux" href="https://discord.com/channels/903237992729169920/903237993509310514">
            <img src="<?= BASE_PATH . 'assets/pictures/icons8-discorde.png' ?>" alt="discorde">
        </a>
        <div id="discorde-button">
            <img 
                id="discorde-button-img"
                src="<?= BASE_PATH . 'assets/pictures/icons8-discorde.png' ?>" 
                alt="discorde">
        </div>
    </div>

    <div class="information">
        <h1>Bientôt disponible</h1>
        <span>
        Prochainement dans notre serveur GTA V, le lieu idéal pour vivre une expérience de simulation gratuite au sein d'une communauté dynamique. Rejoignez-nous très bientôt et explorez les possibilités infinies de GTA V avec d'autres joueurs passionnés.
        </span>
    </div>

    <div id="countdown" class="countdownHolder">
        <span class="countText">Days</span>
        <span class="countDays">      
            <span class="position">
                <span class="digit static"></span>
            </span>
            <span class="position">
                <span class="digit static"></span>
            </span>
        </span>

        <span class="countDiv countDiv0"></span>

        <span class="countText">Hours</span>
        <span class="countHours">
            <span class="position">
                <span class="digit static"></span>
            </span>
            <span class="position">
                <span class="digit static"></span>
            </span>
        </span>
        <span class="countDiv countDiv1"></span>

        <span class="countText">Minutes</span>
        <span class="countMinutes">
            <span class="position">
                <span class="digit static"></span>
            </span>
            <span class="position">
                <span class="digit static"></span>
            </span>
        </span>

        <span class="countDiv countDiv2"></span>

        <span class="countText">Seconds</span>
        <span class="countSeconds">
            <span class="position">
                <span class="digit static"></span>
            </span>
            <span class="position">
                <span class="digit static"></span>
            </span>
        </span>
    </div>
</body>

</html>