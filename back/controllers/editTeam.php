<?php
$requete = execute("
    SELECT *
    FROM team",
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
    if(!empty($_POST['nickname_team'])){
            execute("UPDATE team
                    SET nickname_team=:nickname_team,
                        role_team=:role_team 
                    WHERE id_team=:id",
                    array(':id'=>$_POST['id_team'],
                            ':nickname_team'=>$_POST['nickname_team'],
                            ':role_team'=>$_POST['role_team']

            )
        );

        $_SESSION['message']['success']='Membre modifié';
        header('location:index.php?action=listTeam&back=true');
        exit();
    }else{
        $_SESSION['message']['danger']='Veuillez remplir le titre de la page';
        header('location:index.php?action=listTeam&back=true');
    }
}

$motif = 'Modification de membre de l\'équipe';
$content = "teamView";
include_once 'back/indexBack.phtml';