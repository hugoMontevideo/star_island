<!-- <br>
<div class="dev">helloworld</div> -->
<?php 

$aDevs = [ 
    'Mia' => "assets/upload/profil_femme1.jpg" ,
    'Giusseppe' => 'assets/upload/profil_homme1.jpg',
    'Mia 2' => 'assets/upload/profil_femme2.jpg',
    'Giusseppe 2' => 'assets/upload/profil_homme2.jpg',
    'Mia 3' => 'assets/upload/profil_femme3.jpg',
    'Giusseppe 3' => 'assets/upload/profil_homme3.jpeg',
    'Mia 4' => 'assets/upload/profil_femme4.jpg',
    'Giusseppe 4' => 'assets/upload/profil_homme4.jpg',
    'Mia 5' => 'assets/upload/profil_femme5.webp',
    'Giusseppe 5' => 'assets/upload/profil_homme5.webp'

];

$aSocial = [
    'Mia' => [
        'discord' => 'assets/pictures/icons8-discorde.png',
        'facebook' => 'assets/pictures/icons8-facebook.png'
        ] ,
    'Giusseppe' => [
        'discord' => 'assets/pictures/icons8-discorde.png',
        'facebook' => 'assets/pictures/icons8-facebook.png'
        ] ,
    'Mia 2' => [
        'discord' => 'assets/pictures/icons8-discorde.png',
        'facebook' => 'assets/pictures/icons8-facebook.png',
        'instagram' => 'assets/pictures/logo_instagram.png',
        'twitter' => 'assets/pictures/icons8-twitter.png',
        ],
    'Giusseppe 2' => [
        'discord' => 'assets/pictures/icons8-discorde.png',
        'facebook' => 'assets/pictures/icons8-facebook.png',
        'instagram' => 'assets/pictures/logo_instagram.png',
        'twitter' => 'assets/pictures/icons8-twitter.png',
        ],
    'Mia 3' => [
        'discord' => 'assets/pictures/icons8-discorde.png',
        'facebook' => 'assets/pictures/icons8-facebook.png',
        'instagram' => 'assets/pictures/logo_instagram.png',
        'twitter' => 'assets/pictures/icons8-twitter.png',
        ],
    'Giusseppe 3' => [
        'discord' => 'assets/pictures/icons8-discorde.png',
        'facebook' => 'assets/pictures/icons8-facebook.png',
        'instagram' => 'assets/pictures/logo_instagram.png',
        ],
    'Mia 4' => [
        'discord' => 'assets/pictures/icons8-discorde.png',
        'facebook' => 'assets/pictures/icons8-facebook.png',
        'instagram' => 'assets/pictures/logo_instagram.png',
        'twitter' => 'assets/pictures/icons8-twitter.png',
        'tiktok' => 'assets/pictures/icons8-tiktok.png',
        ],
    'Giusseppe 4' => [
        'discord' => 'assets/pictures/icons8-discorde.png',
        'facebook' => 'assets/pictures/icons8-facebook.png',
        'instagram' => 'assets/pictures/logo_instagram.png',
        'twitter' => 'assets/pictures/icons8-twitter.png',
        'tiktok' => 'assets/pictures/icons8-tiktok.png',
        ],
    'Mia 5' => [
        'discord' => 'assets/pictures/icons8-discorde.png',
        'facebook' => 'assets/pictures/icons8-facebook.png',
        'instagram' => 'assets/pictures/logo_instagram.png',
        'twitter' => 'assets/pictures/icons8-twitter.png',
        'tiktok' => 'assets/pictures/icons8-tiktok.png',
        'faceshop' => 'assets/pictures/icons8-tiktok.png'
        ],
    'Giusseppe 5' => [
        'discord' => 'assets/pictures/icons8-discorde.png',
        'facebook' => 'assets/pictures/icons8-facebook.png',
        'instagram' => 'assets/pictures/logo_instagram.png',
        ] 

];




// foreach($aSocial as $key => $value){
//     foreach( $value as $newkey => $url){
//         debug($newkey); 
//     }

// }
// die();
require_once 'team.phtml' ;