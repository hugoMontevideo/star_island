<?php
$error = '';
$error1 = '';
$error2 = '';
$error3 = '';
$error4 = '';
$requete = execute("SELECT * FROM event e
                   INNER JOIN event_content ec ON e.id_event = ec.id_event 
                   INNER JOIN content c ON c.id_content = ec.id_content 
                   INNER JOIN event_media em ON ec.id_event = em.id_event
                   INNER JOIN media m ON m.id_media = em.id_media 
                   ",
        array(':id_content'=>'1')
    );
$data = $requete->fetchAll(PDO::FETCH_ASSOC);

// requete pour le select - mediatype
$requete = execute("SELECT * FROM media_type",
        array(':id_media_type'=>'1')
    );
$dataSelect = $requete->fetchAll(PDO::FETCH_ASSOC);
// debug($dataSelect);die;



// affichage sur le formulaire
foreach($data as $key => $array){
    if( $_GET['id'] == $array['id_event']){
        if( $array['title_content'] == 'main title'){
            $title_content = $array['description_content'] ;
        }
        if( $array['title_content'] == 'texte 1'){
            $description_content = $array['description_content'] ;
        }
        $date = new DateTime( $array['start_date_event'] );
        $displayStartD = $date->format('Y-m-d');

        $date = new DateTime( $array['end_date_event'] );
        $displayEndD = $date->format('Y-m-d'); 

        $validateEvent = $array['validate_event'];

        $urlImage = $array['name_media'];

        $idMediaType = $array['id_media_type'];
    }
}
// debug($urlImage); die;

if( !empty($_POST) ){

// debug($_POST); die;

    if(empty($_POST['title_content'])){
        $error1 = 'Ce champ est obligatoire';
    }
    if(empty($_POST['description_content'])){
        $error2 = 'Ce champ est obligatoire';
    }

    if(empty($_POST['start_date_event'])){
        $error3 = 'Ce champ est obligatoire';
    }
    if(empty($_POST['end_date_event'])){
        $error4 = 'Ce champ est obligatoire';
    }


    $date = new DateTime($_POST['start_date_event']);
    $startDate = $date->format('Y-m-d H:i:s'); 

    $date = new DateTime($_POST['end_date_event']);
    $endDate = $date->format('Y-m-d H:i:s'); 

    //traitement du changement d'image

    if( empty($error4) && empty($error1) && empty($error2) && empty($error3) ){

        $validateEvent = (isset($_POST['validate_event']))? 1 : 0 ;
    // debug($validateEvent); die();
        execute("UPDATE event
                SET start_date_event=:start_date_event,
                    end_date_event=:end_date_event,
                    validate_event=:validate_event
                WHERE id_event=:id",
                array(':id'=>$_POST['id_event'],
                        ':start_date_event'=>$startDate,
                        ':end_date_event'=>$endDate,
                        ':validate_event'=>$validateEvent
                )
            );

        $_SESSION['message']['success']='Event modifié';
        header('location:index.php?action=listEvent&back=true');
        exit();
 
        $_SESSION['message']['danger']='Veuillez remplir les dates';
        header('location:index.php?action=listEvent&back=true');
    }
    
}

$motif = 'Modifier un événement';
$content = "eventView";
include_once 'back/indexBack.phtml';

// req pour form pre-rempli
// if(isset($_GET) && isset($_GET['id'])){
//                     $requete=execute("SELECT * FROM event e
//                     INNER JOIN event_content ec ON e.id_event = ec.id_event 
//                     INNER JOIN content c ON c.id_content = ec.id_content 
//                     INNER JOIN event_media em ON ec.id_event = em.id_event
//                     INNER JOIN media m ON m.id_media = em.id_media 
//                     WHERE e.id_event=:id_event",
//                 array(':id_event'=>$_GET['id'])
//                 );                    
//                         // $data=$media_type->fetch()
//     $data1 =$requete->fetchAll(PDO::FETCH_ASSOC);
// }