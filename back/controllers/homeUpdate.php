<?php
$title_page = 'titre home'; // valeur de la colonne qu'on recherche
$text_page = 'texte home';  // table ``content`` colonne ``title_content``

$requete = execute("
    SELECT id_page
    FROM page 
    WHERE title_page = :title",
    array(':title'=>'home')
    );
$requete = $requete->fetch(PDO::FETCH_ASSOC);
$id_page = $requete['id_page'];

$requete = execute("
    SELECT description_content
    FROM content 
    WHERE id_page = :id AND title_content = :title_page",
    array(':id'=>$id_page,
            ':title_page' => $title_page )
    );
$requete = $requete->fetch(PDO::FETCH_ASSOC);
$title_page = $requete['description_content']; // maintenant contenu de ``description content``

$requete = execute("
    SELECT description_content
    FROM content 
    WHERE id_page = :id AND title_content = :text_page",
    array(  ':id'=>$id_page,
            ':text_page' => $text_page)
    );    
$requete = $requete->fetch(PDO::FETCH_ASSOC);
$text_page = $requete['description_content']; 

$content = "homeUpdate";
include_once 'back/indexBack.phtml';