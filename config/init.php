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

// const BASE_PATH_DIR = __DIR__ . '/../' ;

