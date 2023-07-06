<?php
$requete = execute("
    SELECT *
    FROM content",
    array(':id_content'=>'1')
    );
$data = $requete->fetchAll(PDO::FETCH_ASSOC);

// requete pour le select - pages
$requete = execute("
    SELECT *
    FROM page",
    array(':id_page'=>'1')
    );
$dataSelect = $requete->fetchAll(PDO::FETCH_ASSOC);

if(!empty($_POST)){
    if(empty($_POST['title_content'])){
        $error = 'Ce champ est obligatoire';
    }
    
    // debug($_POST['id_page']); die();
    if(!isset($error)){
        execute("INSERT INTO content (title_content, description_content, id_page)
                VALUES (:title_content, :description_content, :id_page)",
                array(
                    ':title_content'=> $_POST['title_content'],
                    ':description_content'=> $_POST['description_content'],
                    ':id_page'=> $_POST['id_page']
                )
            );

        $_SESSION['message']['success']='Contenu ajouté';
        header('Location:index.php?action=listContent&back=true');
        exit();
    }
}

$motif = 'Ajouter un contenu';
$content = "contentView";
include_once 'back/indexBack.phtml';