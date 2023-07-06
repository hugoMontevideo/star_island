<?php
// $title_page = 'home accueil'; // valeur de la colonne qu'on recherche
// $text_page1 = 'home galerie';  // table ``content`` colonne ``title_content``
// $title_page = 'home serveur';
// $title_page = 'home comment';

//page avis
// header('location:http://localhost/PHP/star_island');
// debug($_SERVER); die();
// exit();

$requete = execute("SELECT * FROM page
                    INNER JOIN content
                    ON page.id_page = content.id_page WHERE page.title_page='home accueil'" ,
                    array(':id_comment'=>'1')
            );
$data = $requete->fetchAll(PDO::FETCH_ASSOC);
// debug($data); die;
foreach($data as $key => $array){
    if($array['title_content'] == 'titre'){
        $titrePage =$array['description_content'] ;
    }
    if($array['title_content'] == 'texte'){
        $textePage =$array['description_content'] ;
    }
}


//page avis
$requete = execute("
        SELECT *
        FROM comment
        ORDER BY publish_date_comment 
        DESC LIMIT 4" ,
        array(':id_comment'=>'1')
    );
$data = $requete->fetchAll(PDO::FETCH_ASSOC);
// debug($data); die();
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




require_once 'home.phtml' ;

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



// debug("......................." .$title_page); die();








