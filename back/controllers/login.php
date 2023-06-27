<?php      

if (!empty($_POST)){

    if (empty($_POST['email'])) {
        $email='Email obligatoire';
        $error=true;

    }else{
        $user = execute("
                        SELECT * 
                        FROM user 
                        WHERE email_user = :email",
                        array( ':email'=>$_POST['email'] )
                );

        // vérification de l'existence d'un utilisateur à cette adresse mail
        // if ($user->rowCount()==1){ // rowCount() dysfonctionne
        if ( $user ){
            // verification du mot passe provenant du formulaire avec le mot de passe haché provenant de la BDD
            $user = $user->fetch(PDO::FETCH_ASSOC);
            if (password_verify($_POST['password'], $user['password_user'])){
                
                $_SESSION['user'] = $user; // array = array
                // $_SESSION['messages']['success'][]="Bienvenue $user[nickname]!!!!";
                header("Location:index.php?action=indexBack");
                exit();

            }else{
                $password='Erreur sur le mot de passe';
            }
        }else{

            $email='Aucun compte existant à cette adresse mail';
        }
    }

}// fin de soumission formulaire



require_once 'security/login.phtml' ;
