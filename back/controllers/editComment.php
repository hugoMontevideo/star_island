<?php

// if (!empty($_GET) && isset($_GET['id']) && isset($_GET['a']) && $_GET['a'] == 'del') {
if ( isset($_GET['v']) ) {

    execute("UPDATE comment 
            SET is_valid=:bool 
            WHERE id_comment=:id",
            array(':id'=>$_GET['id'],
                    ':bool' => $_GET['v']
                ));
    if ($_GET['v'] == 1) {
        $_SESSION['message']['success']= 'Message validé';
    } else {
        $_SESSION['message']['danger'] = 'Message invalidé';
    }
    header('location:index.php?action=listComment&back=true');
    exit();
}