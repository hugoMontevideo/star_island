<?php
$requete = execute("
    SELECT *
    FROM page",
    array(':id_page'=>'1')
    );

$data = $requete->fetchAll(PDO::FETCH_ASSOC);

if(!empty($_POST)){
    if(empty($_POST['title_page'])){
        $error = 'Ce champ est obligatoire';
    }

    if(!isset($error)){
        execute("INSERT INTO page (title_page)
                VALUES (:title_page)",
                array(
                    ':title_page'=> $_POST['title_page']
                )
            );

        $_SESSION['message']['success']='Page type ajoutée';
        // debug($_SESSION); die();
        header('Location:index.php?action=pageList&back=true');
        exit();
    }
}

$motif = 'Ajouter une page';
$content = "page";
include_once 'back/indexBack.phtml';
