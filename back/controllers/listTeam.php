<?php
$requete = execute("
    SELECT *
    FROM team",
    array(':id_page'=>'1')
    );
$data = $requete->fetchAll(PDO::FETCH_ASSOC);

if(!empty($_POST)){

    if(empty($_POST['nickname_team'])){
        $error = 'Ce champ est obligatoire';
    }
    if(empty($_POST['role_team'])){
        $error1 = 'Ce champ est obligatoire';
    }

    if( !isset($error) || !isset($error1) ){
        execute("INSERT INTO team (nickname_team, role_team)
                VALUES (:nickname_team, :role_team)",
                array(
                    ':nickname_team'=> $_POST['nickname_team'],
                    ':role_team'=> $_POST['role_team']
                )
            );

        $_SESSION['message']['success']='Membre ajouté';
        // debug($_SESSION); die();
        header('Location:index.php?action=listTeam&back=true');
        exit();
    }
}

$motif = 'Ajouter une personne à l\'équipe';
$content = "teamView";
include_once 'back/indexBack.phtml';