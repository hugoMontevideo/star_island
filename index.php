<?php  
require_once 'config/function.php';  

// le chemin absolu de l'application depuis index.php
const BASE_PATH_DIR = __DIR__ ;

// grace a $action on pourra
// inclure le contenu de la bonne page
if ( isset($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action = 'home';
}

if(isset ($_GET['back']) && $_GET['back'] == 'true'){
    if(isConnect()){         // s'il est connecté  ***
        $header = 'inc/backheader.inc.phtml';
        $footer = 'inc/backfooter.inc.phtml';  
    }else{
        header("Location:back/controllers/login.php");
    }

}else{
    $header = 'inc/header.inc.phtml'; // on passera le bon header au template
    $footer = 'inc/footer.inc.phtml'; 

    if($action != 'event'){
        $requete = execute("SELECT * FROM page
                    INNER JOIN content ON page.id_page = content.id_page 
                    INNER JOIN media ON page.id_page = media.id_page 
                    WHERE page.title_page=:title_page" ,
                    array( ':title_page' => $action )
                );
    }else{
        $requete = execute("SELECT * FROM page p
                     INNER JOIN media m ON p.id_page = m.id_page 
                     INNER JOIN content c ON p.id_page = c.id_page 
                     INNER JOIN event_content ct on ct.id_content=c.id_content
                     INNER JOIN event e on ct.id_event=e.id_event
                     WHERE p.title_page=:title_page AND e.validate_event=:validate_event" ,
                    array( ':title_page' => $action,
                        ':validate_event' => 1 )
                );
    }

    $data = $requete->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $key=>$array){
        if(isset($array['title_content'])){
            if($array['title_content'] == 'main title'){
                $mainTitle = $array['description_content'];
            }
            if($array['title_content'] == 'main title1'){
                $mainTitle1 = $array['description_content'];
            }
            if($array['title_content'] == 'main title2'){
                $mainTitle2 = $array['description_content'];
            }
            if($array['title_content'] == 'h2'){
                $h2Title = $array['description_content'];
            }
            if($array['title_content'] == 'h3 - 1'){
                $h3Title1 = $array['description_content'];
            }
            if($array['title_content'] == 'h3 - 2'){
                $h3Title2 = $array['description_content'];
            }
            if($array['title_content'] == 'texte 1'){
                $texte1 = $array['description_content'];
            }
            if($array['title_content'] == 'texte 2'){
                $texte2 = $array['description_content'];
            }
            if($array['title_media'] == 'image1'){
                $personnage1 = $array['name_media'];
                $altPerso1 = $array['title_media'];
            }
            if($array['title_media'] == 'image2'){
                $personnage2 = $array['name_media'];
                $altPerso2 = $array['title_media'];
            }
            if($array['title_media'] == 'image3'){
                $personnage3 = $array['name_media'];
                $altPerso3 = $array['title_media'];
            }
            if($array['title_media'] == 'image4'){
                $personnage4 = $array['name_media'];
                $altPerso4 = $array['title_media'];
            }
        }
    }
}

require_once 'back/controllers/' .$action. '.php';  

// ***************** teaser ******************
// $current_date = new \DateTime();
// $expected_delivery_date = '2023-06-30 00:00:00';
// $nd = new \DateTime($expected_delivery_date);
// // var_dump($current_date<$nd); die();
// if($current_date<$nd){
//     header('location:./front/teaser.php');
//     exit();
// }
// ***************** end teaser ******************