<?php
//  fichier de config de l'app

if( session_status() !== PHP_SESSION_ACTIVE ) session_start();


const CONFIG=[
    'db'=>[
        'HOST'=>'localhost',
        'PORT'=>'3306',
        'NAME'=>'star_island',
        'USER'=>'root',
        'PWD'=>''

    ],
    'app'=>[
        'name'=>'Star Island',
        'tmp_name'=>'Star Island - Teaser', // à utiliser dans le title
        'projecturl'=>'http://localhost/PHP/star_island'
    ]

];

const BASE_PATH='/PHP/star_island/';

const SELECT_CONTENT_ARRAY = [ 'main title','main title1', 'main title2', 'h2', 'h3 - 1', 'h3 - 2', 'texte 1', 'texte 2', 'image1', 'image2', 'image3', 'image4' ];

const AUTH_EXTENSION = [ 'jpg', 'jpeg', 'png', 'gif', 'webm', 'webp', 'svg'];

