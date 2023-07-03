<?php
$requete = execute("
    SELECT *
    FROM event",
    array(':id_page'=>'1')
    );
$data = $requete->fetchAll(PDO::FETCH_ASSOC);

// if(isset($_GET) && isset($_GET['id'])){
//     $requete=execute("SELECT * 
//                         FROM team 
//                         WHERE id_page=:id",
//                         array(':id'=>$_GET['id']));
                        
//                         // $data=$media_type->fetch()
//     $data1 =$requete->fetch(PDO::FETCH_ASSOC);

if( !empty($_POST) ){
    if(!empty($_POST['start_date_event']) && !empty($_POST['end_date_event'])){
        $date = new DateTime($_POST['start_date_event']);
        $startDate = $date->format('Y-m-d H:i:s'); 

        $date = new DateTime($_POST['end_date_event']);
        $endDate = $date->format('Y-m-d H:i:s'); 

        execute("UPDATE event
                SET start_date_event=:start_date_event,
                    end_date_event=:end_date_event 
                WHERE id_event=:id",
                array(':id'=>$_POST['id_event'],
                        ':start_date_event'=>$startDate,
                        ':end_date_event'=>$endDate

            )
        );

        $_SESSION['message']['success']='Event modifié';
        header('location:index.php?action=listEvent&back=true');
        exit();
    }else{
        $_SESSION['message']['danger']='Veuillez remplir les dates';
        header('location:index.php?action=listEvent&back=true');
    }
}

$motif = 'Modifier un événement';
$content = "eventView";
include_once 'back/indexBack.phtml';