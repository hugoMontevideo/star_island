<?php

// if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'del') {
if ( !empty($_GET) && isset($_GET['id']) ) {

    //$result false suppression pas effectué
    $success = execute("DELETE FROM media_type 
                        WHERE id_media_type=:id", 
                        array(
                         ':id' => $_GET['id']
                        ));

    if ($success) {
        $_SESSION['message']['success']= 'Média type supprimé';
        header('location:index.php?action=media_type&back=true');
        exit();
    } else {
        $_SESSION['messages']['danger'][] = 'Probleme de traitement veuillez réitérer';
        header('location:index.php?action=media_type&back=true');
        exit();
    }
}

// back=true , eviter le header / footer du site