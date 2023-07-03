<?php

// if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'del') {
if ( !empty($_GET) && isset($_GET['id']) ) {

    //$result false suppression pas effectué
    $success = execute("DELETE FROM comment 
                        WHERE id_comment=:id", 
                        array(
                            ':id' => $_GET['id']
                        ));

    if ($success) {
        $_SESSION['message']['success']= 'Commentaire supprimé';
        header('location:index.php?action=listComment&back=true');
        exit();
    } else {
        $_SESSION['messages']['danger'][] = 'Probleme de traitement veuillez réitérer';
        header('location:index.php?action=listComment&back=true');
        exit();
    }
}