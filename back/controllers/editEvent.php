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
                   INNER JOIN media m ON m.id_media = em.id_media "
            );
$data = $requete->fetchAll(PDO::FETCH_ASSOC);

// requete pour le select - mediatype
// $requete = execute("SELECT * FROM media_type",
//         array(':id_media_type'=>'1')
//     );
// $dataSelect = $requete->fetchAll(PDO::FETCH_ASSOC);
// debug($data);die;

// affichage sur le formulaire
foreach($data as $key => $array){
    if( $_GET['id'] == $array['id_event']){
        if( $array['title_content'] == 'main title'){
            $title_content = $array['description_content'] ;
            $id_title_content = $array['id_content'] ;
        }
        if( $array['title_content'] == 'texte 1'){
            $description_content = $array['description_content'] ;
            $id_description_content = $array['id_content'] ;
        }
        $date = new DateTime( $array['start_date_event'] );
        $displayStartD = $date->format('Y-m-d');

        $date = new DateTime( $array['end_date_event'] );
        $displayEndD = $date->format('Y-m-d'); 

        $validateEvent = $array['validate_event'];

        $urlImage = $array['name_media'];
        $idImage = $array['id_media'];

        $idMediaType = $array['id_media_type'];
    }
}

if( !empty($_POST) ){

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
                //effacer l'ancienne image
                // ne pas effacer si c'est l'image par défaut  ***************************** a traiter *****
                $success = execute("DELETE FROM media WHERE id_media=:id_media", 
                                array(':id_media' => intval($_POST['id_media']))
                            );

                // effacer dans table event_media
                $success = execute("DELETE FROM event_media WHERE id_media=:id_media", 
                                    array(':id_media' => intval($_POST['id_media']))
                                );
                //  ** la suppression vire en cascade les entrees de la table event_media

                // unlink l'image
                $bool = unlink( BASE_PATH_DIR. '/' . $urlImage );
                $intMediaType = intval($_POST['id_media_type']); // image
                $intMediaType1 = intval($_POST['id_media_type1']); // audio
                $url_media = '';
                if(!empty($_FILES['media_file']['name'])){
                    $url_media='assets/upload/event/'.uniqid().date_format(new DateTime(),'d_m_Y_H_i_s'). '_' . $_FILES['media_file']['name'];
                    // chargement du fiehier dans le serveur
                    $ok = move_uploaded_file($_FILES['media_file']['tmp_name'], $url_media);  
                }
                // $intMediaType = intval($_POST['id_media_type']);
                // insertion dans media
                $lastIdMedia = execute("INSERT INTO media (title_media,name_media,id_media_type,id_page) 
                                    VALUES (:title_media,:name_media,:id_media_type,:id_page)", 
                                    array(':title_media'=> 'image1',
                                        ':name_media'=> $url_media,
                                        ':id_media_type'=>$intMediaType,
                                        ':id_page'=>13
                                    ),true
                                );

                // insertion dans event_media
                execute("INSERT INTO event_media (id_media, id_event )
                        VALUES ( :id_media, :id_event )",
                    array(
                            ':id_media' => $lastIdMedia,
                            ':id_event' => intval($_GET['id'])
                        )
                );


            }

        }
            
        if(empty($error)){     
                // var_dump('hello'); die;
                       
            // update content titre de l'event
            execute("UPDATE content 
                    SET description_content = :description_content
                    WHERE id_content = :id_content",
                array(':id_content'=> $id_title_content,
                        ':description_content' => $_POST['title_content']
                )
            );

            // update content titre de l'event
            execute("UPDATE content 
                    SET description_content = :description_content
                    WHERE id_content = :id_content",
                array(':id_content'=> $id_description_content,
                    ':description_content' => $_POST['description_content']
                )
            );

            $validateEvent = (isset($_POST['validate_event']))? 1 : 0 ;
            // debug($validateEvent); die();
            if($validateEvent == 1){  // invalider tous les events
                execute("UPDATE event SET validate_event = 0 ");
            }
            execute("UPDATE event
                    SET start_date_event=:start_date_event,
                        end_date_event=:end_date_event,
                        validate_event=:validate_event
                    WHERE id_event=:id",
                    array(':id'=>intval($_POST['id_event']),
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