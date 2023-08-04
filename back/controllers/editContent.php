<?php
$error = '';
$error1 = '';
$requete = execute("SELECT * FROM content");
$data = $requete->fetchAll(PDO::FETCH_ASSOC);

// req pour form pre-rempli
if(isset($_GET) && isset($_GET['id'])){
    $requete=execute("SELECT * FROM content 
                      WHERE id_content=:id",
                array(':id'=>intval($_GET['id']))
            );                    
                        // $data=$media_type->fetch()
    $data1 =$requete->fetch(PDO::FETCH_ASSOC);
}

// requete pour le select - pages
$requete = execute(" SELECT * FROM page" );
$dataSelect = $requete->fetchAll(PDO::FETCH_ASSOC);

if( !empty($_POST) ){
    if(empty($_POST['title_content'])){
        $error = 'Ce champ est obligatoire';
    }
    if(empty($_POST['description_content'])){
        $error1 = 'Ce champ est obligatoire';
    }

    if(empty($error) && empty($error1) ) {
        // debug($_POST); die();
        execute("UPDATE content 
                SET title_content = :title_content, 
                    description_content = :description_content, 
                    id_page = :id_page
                WHERE id_content = :id" ,
                array(
                    ':title_content'=> $_POST['title_content'],
                    ':description_content'=> $_POST['description_content'],
                    ':id_page'=> intval($_POST['id_page']),
                    ':id'=> intval($_POST['id_content']),
                )
            );

        $_SESSION['message']['success']='Contenu modifié';
        header('location:index.php?action=listContent&back=true');
        exit();
    }
}

$motif = 'Modifier un contenu';
$content = "contentView";
include_once 'back/indexBack.phtml';