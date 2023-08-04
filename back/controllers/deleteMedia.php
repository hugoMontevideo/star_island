<?php

// if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'del') {
if ( !empty($_GET) && isset($_GET['id']) ) {

    //$result false suppression pas effectué
    $success = execute("DELETE FROM media WHERE id_media=:id", 
                        array(':id' => intval($_GET['id']))
                    );
    // var_dump($success); die();
    if ($success) {
        $_SESSION['message']['success']= 'Média supprimé';
        header('location:index.php?action=listMedia&back=true');
        exit();
    } else {
        $_SESSION['messages']['danger'][] = 'Probleme de traitement veuillez réitérer';
        header('location:index.php?action=listMedia&back=true');
        exit();
    }
}

// back=true , eviter le header / footer du site