<?php 
$table = $action;

// debug($data); die;
// foreach ($data as $key=>$array){
//     if(isset($array['title_content'])){
//         if($array['title_content'] == 'main title'){
//             $mainTitle = $array['description_content'];
//         }
//         if($array['title_content'] == 'h2'){
//             $h2Title = $array['description_content'];
//         }
//         if($array['title_content'] == 'h3 - 1'){
//             $h3Title1 = $array['description_content'];
//         }
//         if($array['title_content'] == 'h3 - 2'){
//             $h3Title2 = $array['description_content'];
//         }
//         if($array['title_content'] == 'texte 1'){
//             $texte1 = $array['description_content'];
//         }
//         if($array['title_content'] == 'texte 2'){
//             $texte2 = $array['description_content'];
//         }
//         if($array['title_media'] == 'personnage1'){
//             $personnage1 = $array['name_media'];
//             $altPerso1 = $array['title_media'];
//         }
//         if($array['title_media'] == 'personnage2'){
//             $personnage2 = $array['name_media'];
//             $altPerso2 = $array['title_media'];
//         }

//     }
// }
include_once $header ;
require_once 'vip.phtml' ;
include_once $footer ;
