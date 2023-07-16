<?php
$error = '';
$error1 = '';
$requete = execute("SELECT * FROM media m 
                    INNER JOIN media_type mt ON m.id_media_type=mt.id_media_type" );
$data = $requete->fetchAll(PDO::FETCH_ASSOC);

// req pour form pre-rempli
if(isset($_GET) && isset($_GET['id'])){
    $requete=execute("SELECT * 
                    FROM media m
                    INNER JOIN media_type mt ON m.id_media_type=mt.id_media_type
                    WHERE id_media=:id",
                    array(':id'=>intval($_GET['id']))
                );                    
                        // $data=$media_type->fetch()
    $data1 =$requete->fetch(PDO::FETCH_ASSOC);
}
// foreach($data1 as $key => $array){
//     $idMediaEdit = $data1['id_media'];
//     $titleMediaEdit = $array['title_media'];
//     $nameMediaEdit = $array['name_media'];
//     $idMediaTypeEdit = $array['id_media_type'];
//     $titleMediaTypeEdit = $array['title_media_type'];
//     $idPageEdit = $array['id_page'];

// // }
// debug($idMediaEdit);die;

// requete pour le select - mediatype
$requete = execute("SELECT * FROM media_type" );
$dataSelect = $requete->fetchAll(PDO::FETCH_ASSOC);

// requete pour le select - page
$requete = execute("SELECT * FROM page");
$dataSelect1 = $requete->fetchAll(PDO::FETCH_ASSOC);

// debug($_POST);die;
if( !empty($_POST) && ($_POST['id_media_type']) == 18){ // si c'est un lien

    
    if(empty($_POST['title_media'])){
        $error = 'Ce champ est obligatoire';
    }
    if(empty($_POST['name_media'])){
        $error1 = 'Ce champ est obligatoire';
    }
    if( empty($error) && empty($error1) ){
            execute("UPDATE media
                    SET title_media=:title_media,
                        name_media=:name_media, 
                        id_media_type=:id_media_type
                    WHERE id_media=:id",
                    array(':id'=>intval($_POST['id_media']),
                            ':title_media'=>$_POST['title_media'],
                            ':name_media'=>$_POST['name_media'],
                            ':id_media_type'=>intval($_POST['id_media_type'])
                        )
                    );

        $_SESSION['message']['success']='Média modifié';
        header('location:index.php?action=listMedia&back=true');
        exit();
    }else{
        $_SESSION['message']['danger']='Veuillez remplir les champs indiqués';
        header('location:index.php?action=listMedia&back=true');
    }
}

$js = 'assets/js/controllers_js/listMedia.js';
$motif = 'Modification d\'un média';
$content = "mediaView";
include_once 'back/indexBack.phtml';