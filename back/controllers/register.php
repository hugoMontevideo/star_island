<?php 
    // require_once '../config/function.php';
//  require_once '../inc/header.inc.php';
 
 if (!empty($_POST)) {
    $error=false;
 
     // début de controle du formulaire
 
 
    if (empty($_POST['email'])) {
        $email='Email obligatoire';
        $error=true;

    }else{
        $user=execute("SELECT * FROM user WHERE email=:email",array(
            ':email'=>$_POST['email']
        ));
        // var_dump($user); die();

        // if ($user->rowCount()==0){  probleme avec rowCount()
        if( !$user ){
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
        // if (!password_strength_check($_POST['password'])){  probleme avec password_strength_check
        if (!isValidMDP($_POST['password'])){

            $password='Votre mot de passe doit contenir entre 6 et 15 caractères dont au minimum une minuscule, une majuscule, un caractère numérique et un caractère spécial';
            $error=true;
        }

    }
    // fin contrôle de formulaire
 
    //  if (empty($_FILES['picture_profil']['name'])){
    //        $picture='Photo de profil obligatoire';
    //        $error=true;
 
    //  }else{
    //      $picture="";
    //      $formats=['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/webp'];
    //      if (!in_array($_FILES['picture_profil']['type'],$formats )){
    //          $picture.="Les formats autorisés sont: 'image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/webp'<br>";
    //          $error=true;
 
    //      }
    //      if ($_FILES['picture_profil']['size'] > 2000000){
    //          $picture.="Taille maximale autorisée de 2M";
    //          $error=true;
    //      }
 
    //  }  
 
     // condition de traitement du formulaire (si il n'y a pas d'erreur)
 
     if (!$error){
     // on renomme la photo
        //  $picture_bdd='upload/'.uniqid().date_format(new DateTime(),'d_m_Y_H_i_s').$_FILES['picture_profil']['name'];
     // on la copie dans le dossier d'upload
        //  copy($_FILES['picture_profil']['tmp_name'],'../assets/'.$picture_bdd);
 
         // on hash le mot de passe
         $mdp = password_hash($_POST['password'], PASSWORD_DEFAULT);
 
         // on lance l'insertion
 
         $result=execute("INSERT INTO user (email_user, password_user) VALUES ( :email, :password )", 
                             array( 
                                 ':email'=>$_POST['email'],
                                 ':password'=>$mdp
                             ), 
                             'ggg'
                         );
    }
 
}  // fin !empty($_POST)



require_once 'security/register.phtml' ;
