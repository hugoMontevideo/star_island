<?php
$error = '';
$error1 = '';
$error2 = '';
$error3 = '';
$requete = execute("
    SELECT *
    FROM team",
    array(':id_page'=>'1')
    );
$data = $requete->fetchAll(PDO::FETCH_ASSOC);

$requete = execute("SELECT *
                    FROM team_media 
                    INNER JOIN team ON team.id_team = team_media.id_team 
                    INNER JOIN media ON media.id_media = team_media.id_media",
                    array(':id_team' => 1)
            );
$data1 = $requete->fetchAll(PDO::FETCH_ASSOC);
// var_dump(!empty($data1)); die;

if( isset($_FILES['media_file']) && $_FILES['media_file']['error'] == 0 ){
    // if( !empty($_FILES) ){
    $picture = '';
    if($_FILES['media_file']['size'] > 2000000 ){
        $picture = 'Fichier trop important. Le fichier doit faire moins de 1.5Mo.<br>';
    }

    $fileInfo = pathinfo($_FILES['media_file']['name']);
    // *** traiter les extensions
    $extension = $fileInfo['extension'];
    $formats=['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/webp'];
    if(!in_array($extension, AUTH_EXTENSION)){
        $picture.="Les formats autorisés sont: 'png', 'jpg', 'jpeg', 'gif', 'webp'<br>";

        $error3=$picture;
    }
    
    if(empty($error3)){
        $url_media = '';
        if(!empty($_FILES['media_file']['name'])){
            $url_media='assets/upload/avatar/team/'.uniqid().date_format(new DateTime(),'d_m_Y_H_i_s'). '_' . $_FILES['media_file']['name'];
            // chargement du fiehier dans le serveur
            // var_dump($url_media); die();
            $ok = move_uploaded_file($_FILES['media_file']['tmp_name'], $url_media);       
        }
    }
}

if( !empty($_POST) && $ok ){
    
    if(empty($_POST['nickname_team'])){
        $error = 'Ce champ est obligatoire';
    }

    if(empty($_POST['role_team'])){
        $error2 = 'Ce champ est obligatoire';
    }
    // if(empty($url_media)){
    //     $url_media = $_POST['name_media'];
    // }

    if( empty($error) && empty($error2) && empty($error3) ){
        $lastIdTeam = execute("INSERT INTO team (nickname_team, role_team)
                VALUES (:nickname_team, :role_team)",
                array(
                    ':nickname_team'=> $_POST['nickname_team'],
                    ':role_team'=> $_POST['role_team']
                ), true
            );

        // insertion de l'avatar dans medias
        $lastIdMedia = execute("INSERT INTO media (title_media, name_media, id_media_type, id_page )
                                VALUES (:title_media, :name_media, :id_media_type, :id_page)",
                            array( ':title_media'=> 'avatar de '.$_POST['nickname_team'],
                                    ':name_media'=> $url_media,
                                    // id media type image = 16  
                                    ':id_media_type'=> 16,
                                    // ** il faudrait faire une requete pour recup cet id **
                                    'id_page' => 10  
                            ), true
                    );   
        // insertion d'une ligne dans team_media
        execute("INSERT INTO team_media (id_media, id_team)
                    VALUES (:id_media, :id_team)",
                    array(':id_media' => $lastIdMedia ,
                        ':id_team' => $lastIdTeam
                    )
                );

        if(!empty($_POST['github_team_media'])){
            $lastIdMedia = execute("INSERT INTO media 
                            (title_media, name_media, id_media_type, id_page )
                    VALUES (:title_media, :name_media, :id_media_type, :id_page)",
                array( ':title_media'=> 'github' ,
                    ':name_media'=> $_POST['github_team_media'],
                    // id media_type lien = 18
                    // on pourrait faire une requete pour recuperer cet id 
                    ':id_media_type'=> 18,
                    'id_page' => 10  

                ), true
            );
            insertIntoTeamMedia($lastIdMedia, $lastIdTeam);
        }

        if(!empty($_POST['discord_team_media'])){
            $lastIdMedia = execute("INSERT INTO media (title_media, name_media, id_media_type, id_page )
                    VALUES (:title_media, :name_media, :id_media_type, :id_page )",
                array( ':title_media'=> 'discord',
                    ':name_media'=> $_POST['discord_team_media'],
                    // id media_type lien = 16  
                    // on pourrait faire une requete pour recuperer cet id 
                    ':id_media_type'=> 18,
                    'id_page' => 10  

                ), true
            );
            insertIntoTeamMedia($lastIdMedia, $lastIdTeam);
        }

        if(!empty($_POST['tiktok_team_media'])){
            $lastIdMedia = execute("INSERT INTO media (title_media, name_media, id_media_type, id_page )
                    VALUES (:title_media, :name_media, :id_media_type, :id_page )",
                array( ':title_media'=> 'tiktok',
                    ':name_media'=> $_POST['tiktok_team_media'],
                    // id media_type lien = 16  
                    ':id_media_type'=> 18,
                    'id_page' => 10  

                ), true
            );
            insertIntoTeamMedia($lastIdMedia, $lastIdTeam);
        }

        if(!empty($_POST['instagram_team_media'])){
            $lastIdMedia = execute("INSERT INTO media (title_media, name_media, id_media_type, id_page  )
                    VALUES (:title_media, :name_media, :id_media_type, :id_page )",
                array( ':title_media'=> 'instagram',
                    ':name_media'=> $_POST['instagram_team_media'],
                    // id media_type lien = 16  
                    ':id_media_type'=> 18,
                    'id_page' => 10  

                ), true
            );
            insertIntoTeamMedia($lastIdMedia, $lastIdTeam);
        }

        if(!empty($_POST['facebook_team_media'])){
            $lastIdMedia = execute("INSERT INTO media (title_media, name_media, id_media_type, id_page )
                    VALUES (:title_media, :name_media, :id_media_type, :id_page )",
                array( ':title_media'=> 'facebook',
                    ':name_media'=> $_POST['facebook_team_media'],
                    // id media_type lien = 16 
                    // on pourrait faire une requete pour recuperer cet id 
                    ':id_media_type'=> 18,
                    'id_page' => 10  

                ), true
            );
            insertIntoTeamMedia($lastIdMedia, $lastIdTeam);
        }

        if(!empty($_POST['twitter_team_media'])){
            $lastIdMedia = execute("INSERT INTO media (title_media, name_media, id_media_type, id_page  )
                    VALUES (:title_media, :name_media, :id_media_type, :id_page )",
                array( ':title_media'=> 'twitter',
                    ':name_media'=> $_POST['twitter_team_media'],
                    // id media_type lien = 16 
                    // on pourrait faire une requete pour recuperer cet id 
                    ':id_media_type'=> 18,
                    'id_page' => 10  

                ), true
            );
            insertIntoTeamMedia($lastIdMedia, $lastIdTeam);
        }


        $_SESSION['message']['success']='Membre ajouté';
        // debug($_SESSION); die();
        header('Location:index.php?action=listTeam&back=true');
        exit();
    }
    //  var_dump($error3); die();

}

$input_avatar = 'Choisir un avatar';  
$motif = 'Ajouter une personne à l\'équipe';
$content = "teamView";
include_once 'back/indexBack.phtml';