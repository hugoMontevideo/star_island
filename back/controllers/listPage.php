<?php
$error = "";
$error1 = "";
$requete = execute("SELECT * FROM page" );

$data = $requete->fetchAll(PDO::FETCH_ASSOC);

if(!empty($_POST)){
    if(empty($_POST['title_page'])){
        $error = 'Ce champ est obligatoire';
    }
    if(empty($_POST['uri_page'])){
        $error1 = 'Ce champ est obligatoire';
    }

    if(empty($error) && empty($error1)){
        execute("INSERT INTO page (title_page, uri_page)
                VALUES (:title_page, :uri_page)",
                array(
                    ':title_page'=> $_POST['title_page'],
                    ':uri_page'=> $_POST['uri_page']
                )
            );

        $_SESSION['message']['success']='Page type ajoutée';
        // debug($_SESSION); die();
        header('Location:index.php?action=listPage&back=true');
        exit();
    }
}

$motif = 'Ajouter une page' ;
$content = "pageView" ;
include_once 'back/indexBack.phtml' ;


