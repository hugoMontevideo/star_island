<?php

// if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'del') {
if ( !empty($_GET) && isset($_GET['id']) ) {

    //$result false suppression pas effectué
    $success = execute("DELETE FROM event 
                        WHERE id_event=:id", 
                        array(
                         ':id' => $_GET['id']
                        ));
    // var_dump($success); die();
    if ($success) {
        $_SESSION['message']['success']= 'Evénement supprimé';
        header('location:index.php?action=listEvent&back=true');
        exit();
    } else {
        $_SESSION['messages']['danger'][] = 'Probleme de traitement veuillez réitérer';
        header('location:index.php?action=listEvent&back=true');
        exit();
    }
}

// back=true , eviter le header / footer du site