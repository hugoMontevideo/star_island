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
                    // WHERE team.id_team = :id", 
                    // array(':id_team' => $_GET['id'])
                    array(':id_team' => 1)
                );
$data1 = $requete->fetchAll(PDO::FETCH_ASSOC);

// je récupère les liens depuis la bdd
foreach($data1 as $key => $array){
    if( $array['id_team'] == $_GET['id']){

        if( $array['id_media_type'] == 16){
            $titleMedia = $array['title_media'];
            $urlImg = $array['name_media']; 
            $idMedia = $array['id_media'];
            $idTeamMedia = $array['id_team_media'];
        }

        if( $array['title_media'] == 'github'){
            $github = $array['name_media']; 
            $githubId = $array['id_media']; 
        }
        if( $array['title_media'] == 'discord'){
            $discord = $array['name_media']; 
            $discordId = $array['id_media']; 

        }
        if( $array['title_media'] == 'tiktok'){
            $tiktok = $array['name_media']; 
            $tiktokId = $array['id_media']; 

        }   
        if( $array['title_media'] == 'instagram'){
            $instagram = $array['name_media'];
            $instagramId = $array['id_media']; 
            
        }
        if( $array['title_media'] == 'facebook'){
            $facebook = $array['name_media']; 
            $facebookId = $array['id_media']; 

        }
        if( $array['title_media'] == 'twitter'){
            $twitter = $array['name_media']; 
            $twitterId = $array['id_media']; 

        }
    }
}

                // debug($urlImg); die;

// if(isset($_GET) && isset($_GET['id'])){
//     $requete=execute("SELECT * 
//                         FROM team 
//                         WHERE id_page=:id",
//                         array(':id'=>$_GET['id']));
                        
//                         // $data=$media_type->fetch()
//     $data1 =$requete->fetch(PDO::FETCH_ASSOC);
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
    if (!in_array($_FILES['media_file']['type'],$formats )){
        $picture.="Les formats autorisés sont: 'image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/webp'<br>";
        $error3=$picture;
    }
    
    if(!$error3){
        
        // unlink la photo
        // debug( $idTeamMedia );die;

        $bool = unlink( BASE_PATH_DIR. '/' . $urlImg );
        
        // effacer l'image

        $success = execute("DELETE FROM media 
                WHERE id_media=:id_media", 
            array(
                ':id_media' => $idMedia
            ));
        // var_dump($success); die();
        // effacer la ligne dans team_media
        execute("DELETE FROM team_media 
                WHERE id_team_media=:id_team_media", 
                array(
                    ':id_team_media' => $idTeamMedia
                ));

        // $url_media = '';
        if(!empty($_FILES['media_file']['name'])){
            $url_media='assets/upload/avatar/team/'.uniqid().date_format(new DateTime(),'d_m_Y_H_i_s'). '_' . $_FILES['media_file']['name'];
            // chargement du fiehier dans le serveur
            // var_dump($url_media); die();
            move_uploaded_file($_FILES['media_file']['tmp_name'], $url_media);       
        }

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
                    }
         // insertion d'une ligne dans team_media
         execute("INSERT INTO team_media (id_media, id_team)
                VALUES (:id_media, :id_team)",
                    array(':id_media' => $lastIdMedia ,
                        ':id_team' => $_GET['id']
                    )
                );
}

if( !empty($_POST) ){

    if(empty($_POST['nickname_team'])){
        $error = 'Ce champ est obligatoire';
    }

    if(empty($_POST['role_team'])){
        $error2 = 'Ce champ est obligatoire';
    }



    if( empty($error) && empty($error2) && empty($error3) ){
        // if(!empty($_POST['nickname_team'])){
        execute("UPDATE team
                SET nickname_team=:nickname_team,
                    role_team=:role_team 
                WHERE id_team=:id",
                array(':id'=>$_POST['id_team'],
                        ':nickname_team'=>$_POST['nickname_team'],
                        ':role_team'=>$_POST['role_team']

            )
        );

        if( isset($github) && !empty( $_POST['github_team_media'] ) ){
            execute("UPDATE media
            SET name_media=:name_media
            WHERE id_media=:id_media",
            array(':name_media'=>$_POST['github_team_media'],
                    ':id_media'=>$_POST['githubId']
                )
            );
        }
        if( isset($discord) && !empty( $_POST['discord_team_media'] ) ){
            execute("UPDATE media
            SET name_media=:name_media
            WHERE id_media=:id_media",
            array(':name_media'=>$_POST['discord_team_media'],
                    ':id_media'=>$_POST['discordId']
                )
            );
        }
        if( isset($tiktok) && !empty( $_POST['tiktok_team_media'] ) ){
            execute("UPDATE media
            SET name_media=:name_media
            WHERE id_media=:id_media",
            array(':name_media'=>$_POST['tiktok_team_media'],
                    ':id_media'=>$_POST['tiktokId']
                )
            );
        }
        if( isset($github) && !empty( $_POST['instagram_team_media'] ) ){
            execute("UPDATE media
            SET name_media=:name_media
            WHERE id_media=:id_media",
            array(':name_media'=>$_POST['instagram_team_media'],
                    ':id_media'=>$_POST['instagramId']
                )
            );
        }
        if( isset($github) && !empty( $_POST['facebook_team_media'] ) ){
            execute("UPDATE media
            SET name_media=:name_media
            WHERE id_media=:id_media",
            array(':name_media'=>$_POST['facebook_team_media'],
                    ':id_media'=>$_POST['facebookId']
                )
            );
        }
        if( isset($github) && !empty( $_POST['twitter_team_media'] ) ){
            execute("UPDATE media
            SET name_media=:name_media
            WHERE id_media=:id_media",
            array(':name_media'=>$_POST['twitter_team_media'],
                    ':id_media'=>$_POST['twitterId']
                )
            );
        }

        $_SESSION['message']['success']='Membre modifié';
        header('location:index.php?action=editTeam&id='. $_GET['id'] .'&back=true');
        exit();
        // }else{
            // $_SESSION['message']['danger']='Veuillez remplir le titre de la page';
            // header('location:index.php?action=listTeam&back=true');
        // }    
    }
}

$input_avatar = 'Changer l\' avatar';
$motif = 'Modification de membre de l\'équipe';
$content = "teamView";
include_once 'back/indexBack.phtml';