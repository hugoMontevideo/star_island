<?php
$requete = execute("SELECT * FROM page" );
$data = $requete->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET) && isset($_GET['id'])){
    $requete=execute("SELECT * FROM page WHERE id_page=:id",
                        array(':id'=>intval($_GET['id']))
                    );
                        
                        // $data=$media_type->fetch()
    $data1 =$requete->fetch(PDO::FETCH_ASSOC);
}

if( !empty($_POST) ){
    if(!empty($_POST['title_page'])){
            execute("UPDATE page
            SET title_page=:title,
                uri_page=:uri 
            WHERE id_page=:id",
            array(':id'=>intval($_POST['id_page']),
                    ':title'=>$_POST['title_page'],
                    ':uri'=>$_POST['uri_page']

            )
        );
        $_SESSION['message']['success']='Page modifiée';
        header('location:index.php?action=listPage&back=true');
        exit();
    }else{
        $_SESSION['message']['danger']='Veuillez remplir le titre de la page';
        header('location:index.php?action=listPage&back=true');
    }
}

$motif = 'Modifier une page';
$content = "pageView";
include_once 'back/indexBack.phtml';