<?php require_once '../config/function.php';
require_once '../inc/header.inc.php';

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


    if (empty($_POST['email'])) {
         $email='Email obligatoire';
         $error=true;

    }else{
        $user=execute("SELECT * FROM user WHERE email=:email",array(
               ':email'=>$_POST['email']
        ));

        if ($user->rowCount()==0){
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

                $email='Format invalide';
                $error=true;
            }
        }else{

            $unique_email='<div class="alert alert-danger w-50 mx-auto mt-5">Un compte existe à cette adresse mail, procédez à une demande de réinitialisation de mot de passe</div>';
            $error=true;

        }


    }

    if (empty($_POST['password'])) {
         $password='Mot de passe obligatoire';
         $error=true;

    }else{
        if (!password_strength_check($_POST['password'])){

            $password='Votre mot de passe doit contenir entre 6 et 15 caractères dont au minimum une minuscule, une majuscule, un caractère numérique et un caractère spécial';
            $error=true;
        }

    }

    if (empty($_FILES['picture_profil']['name'])){
          $picture='Photo de profil obligatoire';
          $error=true;

    }else{
        $picture="";
        $formats=['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/webp'];
        if (!in_array($_FILES['picture_profil']['type'],$formats )){
            $picture.="Les formats autorisés sont: 'image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/webp'<br>";
            $error=true;

        }
        if ($_FILES['picture_profil']['size'] > 2000000){
            $picture.="Taille maximale autorisée de 2M";
            $error=true;
        }

    }  // fin contrôle de formulaire

    // condition de traitement du formulaire (si il n'y a pas d'erreur)

    if (!$error){
  // on renomme la photo
        $picture_bdd='upload/'.uniqid().date_format(new DateTime(),'d_m_Y_H_i_s').$_FILES['picture_profil']['name'];
 // on la copie dans le dossier d'upload
        copy($_FILES['picture_profil']['tmp_name'],'../assets/'.$picture_bdd);

        // on hash le mot de passe
        $mdp=password_hash($_POST['password'], PASSWORD_DEFAULT);

        // on lance l'insertion

        $result=execute("INSERT INTO user (nickname, email, password,picture_profil, role) VALUES (:nickname, :email, :password,:picture_profil, :role)", array(
              ':nickname'=>$_POST['nickname'],
              ':email'=>$_POST['email'],
              ':password'=>$mdp,
              ':picture_profil'=>$picture_bdd,
              ':role'=>'ROLE_USER'

        ), 'ggg');













    }



}// fin !empty($_POST)


?>

<?=  $unique_email ?? ""; ?>
<form class="mt-5 w-75 mx-auto" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="pseudo" class="form-label">Pseudo</label>
        <input name="nickname" type="text" class="form-control" id="pseudo">
        <small class="text-danger"><?= $nickname ?? ""; ?></small>
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input name="email" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <small class="text-danger"><?= $email ?? ""; ?></small>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
        <input name="password" type="password" class="form-control" id="exampleInputPassword1">
        <small class="text-danger"><?= $password  ?? ""; ?></small>
    </div>
    <div class="mb-3">
        <label for="picture_profil" class="form-label">Photo de profil</label>
        <input onchange="loadFile()" name="picture_profil" type="file" class="form-control" id="picture_profil">
        <small class="text-danger"><?= $picture ?? ""; ?></small>
        <div class="text-center">
        <img  id="image"  class="w-25 rounded mt-3 rounded-circle " alt=""></div>
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
