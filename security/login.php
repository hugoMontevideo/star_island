<?php      require_once '../config/function.php';
require_once '../inc/header.inc.php';

if (!empty($_POST)){

if (empty($_POST['email'])) {
    $email='Email obligatoire';
    $error=true;

}else{
    $user=execute("SELECT * FROM user WHERE email=:email",array(
        ':email'=>$_POST['email']
    ));
    // vérification de l'existence d'un utilisateur à cette adresse mail
    if ($user->rowCount()==1){
        // verification du mot passe provenant du formulaire avec le mot de passe haché provenant de la BDD
        $user=$user->fetch(PDO::FETCH_ASSOC);
        if (password_verify($_POST['password'], $user['password'])){

            $_SESSION['user']=$user;
            $_SESSION['messages']['success'][]="Bienvenue $user[nickname]!!!!";
            header('location:../');
            exit();


        }else{
            $password='Erreur sur le mot de passe';

        }



    }else{
      $email='Aucun compte existant à cette adresse mail';
    }
}







}// fin de soumission formulaire



?>

<form class="mt-5 w-75 mx-auto" method="post" enctype="multipart/form-data">

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


    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>



<?php require_once '../inc/footer.inc.php';    ?>
