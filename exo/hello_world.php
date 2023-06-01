<?php     require_once '../config/function.php';
          require_once '../inc/header.inc.php';


?>


<h2>EXERCICE 8: CREATION TABLE UTILISATEUR ET MISE EN RELATION AVEC ANNONCE</h2>
<p>Créer une table utilisateur avec les colonnes id et pseudo. Créer dans la table test1 une nouvelle colonne id_utilisateur jouant le role de clés étrangère. Insérer 2 utilisateurs dans phpmyadmin affecter les id d'utilisateur aux annonces sur la colonne id_utilisateur </p>

<h2>EXERCICE 9: Charger un utilisateur en session</h2>
<p>traiter le formulaire ayant pour but de connecter un utilisateur. Faire la requête WHERE pseudo=.... Si il y a un résultat on le charge dans une variable $user puis on l'affecte à la session et on affiche un message bonjour pseudo d'id= </p>

<form method="post" action="">
    <input type="text" name="pseudo">
    <button type="submit">connexion</button>
</form>



<h2>EXERCICE 10: Récupérer les annonces d'un utilisateur si il est connecté</h2>
<p>Si notre utilisateur est connecté, on lance une requete récupérant les annonces de cet utilisateur et on les affiche dans son tableau de gestion qui lui aussi apparait uniquement à la condition qu'il soit connecté </p>



<?php  require_once '../inc/footer.inc.php';  ?>
