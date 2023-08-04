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
                ");
$data = $requete->fetchAll(PDO::FETCH_ASSOC);
// debug($data);die;

if(!empty($_POST)){

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
    // var_dump($startDate); die();
    $date = new DateTime($_POST['end_date_event']);
    $endDate = $date->format('Y-m-d H:i:s'); 


    if( empty($error) && empty($error1) && empty($error) && empty($error1) ){
        if( isset($_FILES['media_file']) && $_FILES['media_file']['error'] == 0 ){
            // if( !empty($_FILES) ){
            $picture = '';
            if($_FILES['media_file']['size'] > 5000000 ){
                $picture = 'Fichier trop important. Le fichier doit faire moins de 4Mo.<br>';
            } 
            $fileInfo = pathinfo($_FILES['media_file']['name']);
            // *** traiter les extensions
            $extension = $fileInfo['extension'];
            // $formats=['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/webp'];
            if(!in_array($extension, AUTH_EXTENSION)){
                $picture.="Les formats autorisés sont: 'png', 'jpg', 'jpeg', 'gif', 'webp'<br>";
    
                $error=$picture;
            }
            
            if(empty($error)){
                $intMediaType = intval($_POST['id_media_type']); // image
                $intMediaType1 = intval($_POST['id_media_type']); // audio
                $url_media = '';
                if(!empty($_FILES['media_file']['name'])){
                    $url_media='assets/upload/event/'.uniqid().date_format(new DateTime(),'d_m_Y_H_i_s'). '_' . $_FILES['media_file']['name'];
                    // chargement du fiehier dans le serveur
                    $ok = move_uploaded_file($_FILES['media_file']['tmp_name'], $url_media);  
                }
            }
    
        }else{
            $url_media = 'assets/upload/event/default.png';
            $ok = true;
            $intMediaType = 16; // id_media_type = 16 pour les images
            // Il faut charger une image par défaut (random)
            if(!empty($_FILES['media_file']['name'])){
                $ok = move_uploaded_file($_FILES['media_file']['tmp_name'], $url_media);  
            }
        }
        if($ok){
            // $intMediaType = intval($_POST['id_media_type']);
            // insertion dans media
            $lastIdMedia = execute("INSERT INTO media (title_media,name_media,id_media_type,id_page) 
                                VALUES (:title_media,:name_media,:id_media_type,:id_page)", 
                                array(':title_media'=>'image1',
                                    ':name_media'=> $url_media,
                                    ':id_media_type'=>$intMediaType,
                                    ':id_page'=>13
                                ),true
                            );

            $validateEvent = (isset($_POST['validate_event']))? 1 : 0 ;
            // debug($validateEvent); die();

            if($validateEvent == 1){  // invalider tous les events
                execute("UPDATE event SET validate_event = 0 ");
            }
            $lastIdEvent = execute("INSERT INTO event (start_date_event, end_date_event, validate_event)
                    VALUES (:start_date_event, :end_date_event, :validate_event )",
                    array(
                        ':start_date_event'=> $startDate,
                        ':end_date_event'=> $endDate,
                        ':validate_event'=>$validateEvent
                    ), true
                );
                    
            // insertion dans content
                //titre de l'événément title_content = 'main title'
            $lastIdContent =  execute("INSERT INTO content (title_content, description_content, id_page)
                                    VALUES (:title_content, :description_content, :id_page)",
                                array(
                                    ':title_content'=> 'main title',
                                    ':description_content'=> $_POST['title_content'],
                                    ':id_page'=> 13  // page event
                                ), true
                            );

            // insertion dans event_content
            execute("INSERT INTO event_content (id_event, id_content )
                    VALUES (:id_event, :id_content )",
                    array(
                        ':id_event' => $lastIdEvent,
                        ':id_content' => $lastIdContent
                        )
                    );

                //description de l'événément title_content = 'texte 1'
            $lastIdContent =  execute("INSERT INTO content (title_content, description_content, id_page)
                                    VALUES (:title_content, :description_content, :id_page)",
                                array(
                                    ':title_content'=> 'texte 1',
                                    ':description_content'=> $_POST['description_content'],
                                    ':id_page'=> 13
                                ), true
                            );
            // insertion dans event_content
            execute("INSERT INTO event_content (id_event, id_content )
                    VALUES ( :id_event, :id_content )",
                        array(
                        ':id_event' => $lastIdEvent,
                        ':id_content' => $lastIdContent
                        )
                    );

             // insertion dans event_media
             execute("INSERT INTO event_media (id_media, id_event )
                        VALUES ( :id_media, :id_event )",
                            array(
                            ':id_media' => $lastIdMedia,
                            ':id_event' => $lastIdEvent
                        )
                    );

            $_SESSION['message']['success']='Evénement ajouté';
            header('Location:index.php?action=listEvent&back=true');
            exit();
        }
    }
}

$motif = 'Ajouter un événement';
$content = "eventView";
include_once 'back/indexBack.phtml';
