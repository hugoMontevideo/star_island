<?php
$requete = execute("SELECT *
            FROM media",
            array(':id_media'=>'1')
        );
$data = $requete->fetchAll(PDO::FETCH_ASSOC);

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
// debug($dataSelect1); die();

    if( isset($_FILES['media_file']) && $_FILES['media_file']['error'] == 0 ){
        // if( !empty($_FILES) ){
            
        if($_FILES['media_file']['size'] > 5000000 ){
            $error = 'Fichier trop important. Le fichier doit faire moins de 4Mo.';
        }
        
        $fileInfo = pathinfo($_FILES['media_file']['name']);
        // *** traiter les extensions
        $extension = $fileInfo['extension'];
        $formats=['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/webp'];
        if (!in_array($_FILES['media_file']['type'],$formats )){
            $picture.="Les formats autorisés sont: 'image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/webp'<br>";
            $error=true;
        }
    }
        
    if( !isset($error) ){
        $url_media = '';
        if(!empty($_FILES['media_file']['name'])){
            $url_media='assets/upload/'.uniqid().date_format(new DateTime(),'d_m_Y_H_i_s'). '_' . $_FILES['media_file']['name'];
            // chargement du fiehier dans le serveur
            // var_dump($url_media); die();
            move_uploaded_file($_FILES['media_file']['tmp_name'], $url_media);       
            // var_dump($picture_bdd); die();
    }

    if(!empty($_POST)){
        if(empty($_POST['title_media'])){
            $error = 'Ce champ est obligatoire';
        }
        if(empty($url_media)){
            $url_media = $_POST['name_media'];
        }
    
        if( !isset($error) || !isset($error1) ){
            execute("INSERT INTO media (title_media, name_media,id_media_type, id_page )
                    VALUES (:title_media, :name_media, :id_media_type, :id_page)",
                    array(
                        ':title_media'=> $_POST['title_media'],
                        ':name_media'=> $url_media,
                        ':id_media_type'=> $_POST['id_media_type'],
                        ':id_page'=> $_POST['id_page']
                    )
                );
    
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