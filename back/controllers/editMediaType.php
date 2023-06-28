<?php  
$requete = execute("
    SELECT *
    FROM media_type",
    array(':id_media'=>'1')
    );
$data = $requete->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET) && isset($_GET['id'])){
    $requete=execute("SELECT * 
                        FROM media_type 
                        WHERE id_media_type=:id",
                        array(':id'=>$_GET['id']));

                        // $data=$media_type->fetch()
    $data1 =$requete->fetch(PDO::FETCH_ASSOC);
}

if( !empty($_POST) ){
    if(!empty($_POST['title_media_type'])){
        // debug($_POST);die();
        execute("UPDATE media_type
                SET title_media_type=:title 
                WHERE id_media_type=:id",
                array(':id'=>$_POST['id_media_type'],
                        ':title'=>$_POST['title_media_type']
    
                )
            );
    
        $_SESSION['message']['success']='Média type modifié';
        header('location:index.php?action=media_type&back=true');
        exit();
    }else{
        $_SESSION['message']['danger']='Veuillez remplir le type de média';
        header('location:index.php?action=media_type&back=true');
    }

}

$motif = 'Modification d\'un type de media';
$content = "media_type"; // content
include_once 'back/indexBack.phtml';// template