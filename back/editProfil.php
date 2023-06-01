<?php require_once '../config/function.php';

if (!admin()){

    header('location:../security/login.php');
    exit();

}

require_once '../inc/header.inc.php';



if (isset($_GET['a']) && $_GET['a']=='edit' && isset($_GET['i'])){
    $user=execute("SELECT * FROM user WHERE id=:id", array(
        ':id'=>$_GET['i']

    ))->fetch(PDO::FETCH_ASSOC);



}
if (!empty($_POST)) {
    $error=false;

    // début de controle du formulaire
    if (empty($_POST['nickname'])) {
        $nickname='Le pseudo est obligatoire';
        $error=true;
    }else{
        if (strlen($_POST['nickname']) <3 || strlen($_POST['nickname']) >10 ){
            $nickname='Le pseudo doit être compris entre 3 et 10 caractères';
            $error=true;
        }
    }






    if (!empty($_FILES['editPicture']['name'])){

        $picture="";
        $formats=['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/webp'];
        if (!in_array($_FILES['editPicture']['type'],$formats )){
            $picture.="Les formats autorisés sont: 'image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/webp'<br>";
            $error=true;

        }
        if ($_FILES['editPicture']['size'] > 2000000){
            $picture.="Taille maximale autorisée de 2M";
            $error=true;
        }

    }  // fin contrôle de formulaire

    // condition de traitement du formulaire (si il n'y a pas d'erreur)

    if (!$error){
        // on renomme la photo
        if (!empty($_FILES['editPicture']['name'])){

            $picture_bdd='upload/'.uniqid().date_format(new DateTime(),'d_m_Y_H_i_s').$_FILES['editPicture']['name'];
            // on la copie dans le dossier d'upload
            copy($_FILES['editPicture']['tmp_name'],'../assets/'.$picture_bdd);
            unlink('../assets/'.$_POST['picture_profile']);
        }else{

            $picture_bdd=$_POST['picture_profil'];
        }



        // on lance l'insertion

        $result=execute("UPDATE user SET nickname=:nickname, picture_profil=:picture_profil WHERE id=:id", array(
            ':nickname'=>$_POST['nickname'],
            ':picture_profil'=>$picture_bdd,
            ':id'=>$_GET['i']



        ));
        header('location:./userList.php');
        exit();












    }



}// fin !empty($_POST)


?>


<form class="mt-5 w-75 mx-auto" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="pseudo" class="form-label">Pseudo</label>
        <input name="nickname" value="<?=  $user['nickname'] ?? ''; ?>" type="text" class="form-control" id="pseudo">
        <small class="text-danger"><?= $nickname ?? ""; ?></small>
    </div>


    <div class="mb-3">
        <label for="picture_profil" class="form-label">Photo de profil</label>
        <input onchange="loadFile()" name="editPicture" type="file" class="form-control" id="picture_profil">
        <small class="text-danger"><?= $picture ?? ""; ?></small>
        <div class="text-center">
            <img  id="image" src="<?=  '../assets/'.$user['picture_profil']; ?>"  class="w-25 rounded mt-3 rounded-circle " alt=""></div>
        <input value="<?=  $user['picture_profil']; ?>" type="hidden" name="picture_profil">
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>





<script>
    let loadFile = function()
    {
        let image = document.getElementById('image');

        image.src = URL.createObjectURL(event.target.files[0]);
    }
</script>

<?php require_once '../inc/footer.inc.php'; ?>
