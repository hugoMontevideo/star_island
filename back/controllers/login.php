<?php  
require_once '../../config/function.php';  
require_once '../../inc/backheader.inc.phtml';  

if (!empty($_POST)){
    if(empty($_POST['password'])) {
        $password='Mot de passe obligatoire';
        $error=true;
    }else{

        if (empty($_POST['email'])) {
            $email='Email obligatoire';
            $error=true;
    
        }else{
            $resultat = execute("
                            SELECT * 
                            FROM user 
                            WHERE email_user = :email",
                            array( ':email'=>$_POST['email'] )
                    );
    
            $user = $resultat->fetch(PDO::FETCH_ASSOC);
            
            // vérification de l'existence d'un utilisateur à cette adresse mail
            // if ($user->rowCount()==1){ // rowCount() dysfonctionne
            if ( $user ){
                // verification du mot passe provenant du formulaire avec le mot de passe haché provenant de la BDD
                if (password_verify($_POST['password'], $user['password_user'])){
                    
                    $_SESSION['email_user'] = $user['email_user']; 

                    header("Location:../../index.php?action=listPage&back=true");
                    exit();
    
                }else{
                    $password='Entrez un mot de passe valable';
                }
            }else{
    
                $email='Aucun compte existant à cette adresse mail';
            }
        }
    
    }

 
}// fin de soumission formulaire

require_once '../../security/login.phtml' ;
