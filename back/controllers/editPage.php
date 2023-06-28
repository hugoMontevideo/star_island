<?php
$requete = execute("
    SELECT *
    FROM page",
    array(':id_page'=>'1')
    );
$data = $requete->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET) && isset($_GET['id'])){
    $requete=execute("SELECT * 
                        FROM page 
                        WHERE id_page=:id",
                        array(':id'=>$_GET['id']));
                        
                        // $data=$media_type->fetch()
    $data1 =$requete->fetch(PDO::FETCH_ASSOC);
}

if( !empty($_POST) ){
    if(!empty($_POST['title_page'])){
            execute("UPDATE page
            SET title_page=:title 
            WHERE id_page=:id",
            array(':id'=>$_POST['id_page'],
                    ':title'=>$_POST['title_page']

            )
        );

        $_SESSION['message']['success']='Page modifiée';
        header('location:index.php?action=pageList&back=true');
        exit();
    }else{
        $_SESSION['message']['danger']='Veuillez remplir le titre de la page';
        header('location:index.php?action=pageList&back=true');
    }
}

$motif = 'Modifier une page';
$content = "page";
include_once 'back/indexBack.phtml';