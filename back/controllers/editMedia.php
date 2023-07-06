<?php
$requete = execute("
    SELECT *
    FROM media",
    array(':id_media'=>'1')
    );
$data = $requete->fetchAll(PDO::FETCH_ASSOC);

// req pour form pre-rempli
if(isset($_GET) && isset($_GET['id'])){
    $requete=execute("SELECT * 
                        FROM media 
                        WHERE id_media=:id",
                        array(':id'=>$_GET['id'])
                    );                    
                        // $data=$media_type->fetch()
    $data1 =$requete->fetch(PDO::FETCH_ASSOC);
}
// requete pour le select - mediatype
$requete = execute("
    SELECT *
    FROM media_type",
    array(':id_media_type'=>'1')
    );
$dataSelect = $requete->fetchAll(PDO::FETCH_ASSOC);

// requete pour le select - page
$requete = execute("
        SELECT *
        FROM page",
        array(':id_media_type'=>'1')
    );
$dataSelect1 = $requete->fetchAll(PDO::FETCH_ASSOC);

if( !empty($_POST) ){
    
    if(empty($_POST['title_media'])){
        $error = 'Ce champ est obligatoire';
    }
    if(empty($_POST['name_media'])){
        $error1 = 'Ce champ est obligatoire';
    }

    // if(!empty($_POST['nickname_team'])){
    if( !isset($error) || !isset($error1) ){
            execute("UPDATE media
                    SET title_media=:title_media,
                        name_media=:name_media, 
                        id_media_type=:id_media_type
                    WHERE id_media=:id",
                    array(':id'=>$_POST['id_media'],
                            ':title_media'=>$_POST['title_media'],
                            ':name_media'=>$_POST['name_media'],
                            ':id_media_type'=> $_POST['id_media_type']
                        )
                    );

        $_SESSION['message']['success']='Média modifié';
        header('location:index.php?action=listMedia&back=true');
        exit();
    }else{
        $_SESSION['message']['danger']='Veuillez remplir le titre du média';
        header('location:index.php?action=listMedia&back=true');
    }
}

$motif = 'Modification d\'un média';
$content = "mediaView";
include_once 'back/indexBack.phtml';