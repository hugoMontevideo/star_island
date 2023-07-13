<?php  
require_once 'config/function.php';  

// le chemin absolu de l'application
const BASE_PATH_DIR = __DIR__ ;

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


if (isset($_GET['a']) && $_GET['a']=='dis'){

    unset($_SESSION['user']);
    $_SESSION['messages']['info'][]='A bientôt !!';
    header('location:./');
    exit();
}

// grace a $action on pourra
// inclure le contenu de la bonne page
if ( isset($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action = 'home';
}

if(isset ($_GET['back']) && $_GET['back'] == 'true'){
    $header = 'inc/backheader.inc.phtml';
    $footer = 'inc/backfooter.inc.phtml';  
    // require_once 'inc/backheader.inc.phtml';  
}else{
    $header = 'inc/header.inc.phtml';
    $footer = 'inc/footer.inc.phtml'; 
    // require_once 'inc/header.inc.php';

    $requete = execute("SELECT * FROM page
                INNER JOIN content ON page.id_page = content.id_page 
                INNER JOIN media ON page.id_page = media.id_page 
                WHERE page.title_page=:title_page" ,
                array( ':title_page' => $action )
            );
    $data = $requete->fetchAll(PDO::FETCH_ASSOC);
    // debug($data); die;

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

// if(isset ($_GET['back']) && $_GET['back'] == 'true'){
//     // if(isset ($_GET['action']) && $_GET['action'] == 'indexBack'){
//         require_once 'inc/footer.inc.phtml';  
//     }else{
//         require_once 'inc/footer.inc.php';         
// }


// ce bloc était avant require controlleur $action

// $requete = execute("SELECT * FROM page
//                 INNER JOIN content ON page.id_page = content.id_page 
//                 INNER JOIN media ON page.id_page = media.id_page 
//                 WHERE page.title_page=:title_page"  ,
//                 array( ':title_page' => $action )
//             );
// $data = $requete->fetchAll(PDO::FETCH_ASSOC);

// // debug($data); die;
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