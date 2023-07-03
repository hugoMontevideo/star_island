<?php
$requete = execute("
    SELECT *
    FROM event",
    array(':id_page'=>'1')
    );
$data = $requete->fetchAll(PDO::FETCH_ASSOC);

if(!empty($_POST)){

    if(empty($_POST['start_date_event'])){
        $error = 'Ce champ est obligatoire';
    }
    if(empty($_POST['end_date_event'])){
        $error1 = 'Ce champ est obligatoire';
    }
    
    $date = new DateTime($_POST['start_date_event']);
    $startDate = $date->format('Y-m-d H:i:s'); 
    // var_dump($startDate); die();

    $date = new DateTime($_POST['end_date_event']);
    $endDate = $date->format('Y-m-d H:i:s'); 

    if( !isset($error) || !isset($error1) ){
        execute("INSERT INTO event (start_date_event, end_date_event)
                VALUES (:start_date_event, :end_date_event)",
                array(
                    ':start_date_event'=> $startDate,
                    ':end_date_event'=> $endDate
                )
            );

        $_SESSION['message']['success']='Evénement ajouté';
        // debug($_SESSION); die();
        header('Location:index.php?action=listEvent&back=true');
        exit();
    }
}
$motif = 'Ajouter un événement';
$content = "eventView";
include_once 'back/indexBack.phtml';
