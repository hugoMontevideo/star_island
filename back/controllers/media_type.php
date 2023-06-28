<?php
//$media_type = 'titre home'; // valeur de la colonne qu'on recherche
//$text_page = 'texte home';  // table ``content`` colonne ``title_content``

$requete = execute("
    SELECT *
    FROM media_type",
    array(':id_media'=>'1')
    );

$data = $requete->fetchAll(PDO::FETCH_ASSOC);

if(!empty($_POST)){
    if(empty($_POST['title_media_type'])){
        $error = 'Ce champ est obligatoire';
    }

    if(!isset($error)){
        execute("INSERT INTO media_type (title_media_type)
                VALUES (:title_media_type)",
                array(
                    ':title_media_type'=> $_POST['title_media_type']
                )
            );

        $_SESSION['message']['success']='Média type ajouté';
        // debug($_SESSION); die();
        header('Location:index.php?action=media_type&back=true');
        exit();
    }
}

$motif = 'Ajouter un type de media';
$content = "media_type";
include_once 'back/indexBack.phtml';
