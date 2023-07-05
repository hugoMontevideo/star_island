<?php
// if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'del') {
if ( !empty($_GET) && isset($_GET['id']) ) {

    $requete = execute("SELECT * FROM `team` 
                    INNER JOIN team_media ON team.id_team=team_media.id_team
                    INNER JOIN media ON media.id_media=team_media.id_media
                    WHERE team.id_team= :id",
                    array(
                        ':id' => $_GET['id']
                    )
    );
    $data = $requete->fetchAll(PDO::FETCH_ASSOC);   


    //  ** la suppression vire en cascade les entres de la table team media

    $success = execute("DELETE FROM team 
                        WHERE id_team=:id", 
                        array(
                         ':id' => $_GET['id']
                        ));

    // ** suppression des médias correspondants

    foreach( $data as $key=>$array){
        
        if( $array['id_media_type'] == 16 ){
            // suppression de l'avatar du dossier avatar/team
            $bool = unlink( BASE_PATH_DIR. '/' . $array['name_media'] );
            // var_dump($bool); die;
        }
         execute("DELETE FROM media 
                    WHERE id_media=:id", 
                    array(
                    ':id' => $array['id_media']
                ));
    }

    if ($success) {
        $_SESSION['message']['success']= 'Membre supprimé';
        header('location:index.php?action=listTeam&back=true');
        exit();
    } else {
        $_SESSION['messages']['danger'][] = 'Probleme de traitement veuillez réitérer';
        header('location:index.php?action=listTeam&back=true');
        exit();
    }
}

// back=true , eviter le header / footer du site