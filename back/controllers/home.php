<?php
// titres aléatoires
$arr_titres = [ $mainTitle, $mainTitle1 ,$mainTitle2 ];
// $titres_ready = randElmtfromArray(3, $arr_titres);
shuffle($arr_titres);
$mainTitle = $arr_titres[0];
$mainTitle1 = $arr_titres[1];
$mainTitle2 = $arr_titres[2];




// images de la page 2eme page  'slider'
$requete = execute("SELECT * FROM page
                    INNER JOIN content ON page.id_page = content.id_page 
                    INNER JOIN media ON page.id_page = media.id_page 
                    WHERE page.title_page=:title_page" ,
                    array( ':title_page' => 'galerie' )
             );
$data1 = $requete->fetchAll(PDO::FETCH_ASSOC);

// images aléatoires pour slider
$slider = [];
foreach($data1 as $key => $array){
    $slider[] = $array['name_media'];
}

$slider_unique = array_unique($slider);
$slider_ready = randElmtfromArray(6, $slider_unique);




//page avis
// récuperer toutes les images de la page comment

$avatar_avis = [];
CONST AVATAR = './assets/pictures/avatar/';
// si le dossier est accessible.
if(is_readable(AVATAR && is_dir(AVATAR))){
    // placer le pointer au début du dossier
    $dir_open = opendir(AVATAR);

}

$requete = execute("SELECT *
                    FROM comment
                    ORDER BY publish_date_comment 
                    DESC LIMIT 4"
                );
$data3 = $requete->fetchAll(PDO::FETCH_ASSOC);

$requete = execute("SELECT * FROM media
                INNER JOIN page on media.id_page=page.id_page
                WHERE page.title_page=:title_page",
                array(':title_page'=>'comments')
                );
$data4 = $requete->fetchAll(PDO::FETCH_ASSOC);

// avatars aléatoires pour les comms
$avatars = [];
foreach($data4 as $key => $array){
    $avatars[] = $array['name_media'];
}

$avatars_ready = randElmtfromArray(4, $avatars);
// debug($avatars_ready);die;

if( !empty($_POST) ){
    if(!empty($_POST['text_comment'])){
        $date = new DateTime();
        $datetime = $date->format('Y-m-d H:i:s');
            //    var_dump($datetime); die();
        execute("INSERT INTO comment 
                    (rating_comment,
                    text_comment,
                    publish_date_comment,
                    nickname_comment,
                    is_valid,
                    id_media)
                    VALUES 
                    (:rating_comment,
                    :text_comment,
                    :publish_date_comment,
                    :nickname_comment,
                    :is_valid,
                    :id_media)",
                array(':rating_comment'=> $_POST['rating_comment'],
                        ':text_comment' => $_POST['text_comment'],
                        ':publish_date_comment' => $datetime,
                        ':nickname_comment' => $_POST['nickname_comment'],
                        ':is_valid' => 0,
                        ':id_media'=>1                       
                    ) );

        header('Location:index.php?action=home');
        exit();
    }
}
$i_avatar = 0;
include_once $header ;
require_once 'home.phtml' ;
include_once $footer ;


// $requete = execute("
//     SELECT id_page
//     FROM page 
//     WHERE title_page = :title",
//     array(':title'=>'home')
//     );
// $requete = $requete->fetch(PDO::FETCH_ASSOC);
// $id_page = $requete['id_page'];

// $requete = execute("
//         SELECT description_content
//         FROM content 
//         WHERE id_page = :id AND title_content = :title_page",
//         array(':id'=>$id_page,
//                 ':title_page' => $title_page )
//     );
// $requete = $requete->fetch(PDO::FETCH_ASSOC);
// $title_page = $requete['description_content']; // maintenant contenu de ``description content``


// $requete = execute("
//     SELECT description_content
//     FROM content 
//     WHERE id_page = :id AND title_content = :text_page",
//     array(  ':id'=>$id_page,
//             ':text_page' => $text_page)
//     );    
// $requete = $requete->fetch(PDO::FETCH_ASSOC);
// $text_page = $requete['description_content']; // maintenant contenu de ``description content``



//$data = $requete->fetchAll(PDO::FETCH_ASSOC);
// // debug($data); die;
// foreach($data as $key => $array){
//     if($array['title_content'] == 'titre'){
//         $titrePage =$array['description_content'] ;
//     }
//     if($array['title_content'] == 'texte'){
//         $textePage =$array['description_content'] ;
//     }
// }








