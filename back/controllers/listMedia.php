<?php
$error = '';
$error1 = '';
$error2 = '';
$error3 = '';
$requete = execute("SELECT * FROM media" );
$data = $requete->fetchAll(PDO::FETCH_ASSOC);

// requete pour le select - mediatype
$requete = execute("SELECT * FROM media_type" );
$dataSelect = $requete->fetchAll(PDO::FETCH_ASSOC);

// requete pour le select - page
$requete = execute("SELECT * FROM page" );
$dataSelect1 = $requete->fetchAll(PDO::FETCH_ASSOC);

if( isset($_FILES['media_file']) && $_FILES['media_file']['error'] == 0 ){

    $picture = '';     
    if($_FILES['media_file']['size'] > 5000000 ){
        $picture = 'Fichier trop important. Le fichier doit faire moins de 4Mo.';
    }
    
    $fileInfo = pathinfo($_FILES['media_file']['name']);
    // *** traiter les extensions
    $extension = strtolower($fileInfo['extension']);

    // $formats=['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/webp','image/svg'];

    // if (!in_array($_FILES['media_file']['type'],$formats )){
    if(!in_array($extension, AUTH_EXTENSION)){
        $picture.="Les formats autorisés sont: 'png', 'jpg', 'jpeg', 'gif', 'webp'<br>";
        
        $error3=$picture;
    }

    if( empty($error3) ){
        $url_media = '';
        // debug($_POST); die();

        if(!empty($_FILES['media_file']['name']) && $_POST['id_page'] == '12' ){
            $url_media='assets/pictures/avatar/'.uniqid().date_format(new DateTime(),'d_m_Y_H_i_s'). '_' . $_FILES['media_file']['name'];
            
            // chargement du fiehier dans le serveur
            // debug($url_media); die();
            $ok = move_uploaded_file($_FILES['media_file']['tmp_name'], $url_media); 
            // $ok = 1      
        }else{
            $url_media='assets/pictures/'.uniqid().date_format(new DateTime(),'d_m_Y_H_i_s'). '_' . $_FILES['media_file']['name'];

            $ok = move_uploaded_file($_FILES['media_file']['tmp_name'], $url_media); 
        }
    }
}

if(!empty($_POST) && $ok ){
    if(empty($_POST['title_media'])){
        $error = 'Ce champ est obligatoire';
    }
    if(empty($url_media)){
        $url_media = $_POST['name_media'];
    }


    if(  empty($error) && empty($error3) ){
        $intMediaType = intval($_POST['id_media_type']);
        $intIdPage= intval($_POST['id_page']);

        $success = execute("INSERT INTO media 
                    (title_media,name_media,id_media_type,id_page) 
                VALUES (:title_media,:name_media,:id_media_type,:id_page)", 
                array(':title_media'=> $_POST['title_media'],
                    ':name_media'=> $url_media,
                    ':id_media_type'=>$intMediaType,
                    ':id_page'=>$intIdPage
                ));
    // debug( $success); die();

        if($success){
            $_SESSION['message']['success']='Média ajouté';
            // debug($_SESSION); die();
            header('Location:index.php?action=listMedia&back=true');
            exit();
        }
    }
}

// $js = $action . '.js';
$js = 'assets/js/controllers_js/'. $action . '.js';
$motif = 'Ajouter un média';
$content = "mediaView";
include_once 'back/indexBack.phtml';