<?php   require_once '../config/function.php';

require_once '../inc/header.inc.php';







?>
<div class="container">
    <h2>Exercice 1 (table: test1) Formulaire d'ajout pour le CREATE de CRUD correspondant à une requete  INSERT INTO</h2>
    <p>Un client souhaite créer son site ayant pour but de laisser des petites annonces. Creer la table test1: id (A-I),
        annonce(text), tel(varchar 255). Créer un formulaire de création d'annonce et générer l'insert en BDD.Effectuer
        préalablement les controles sur champs de formulaire verifiant que chaque input ai été saisi </p>
    <small>Rappel un formulaire doit impérativement avoir une méthode post, un boutton type submit et des name à chacun
        de ses input.<br> Tout traitement de formulaire est soumis à la condition !empty($_POST).</small>



    <h2>Exercice 2 (table: test1). Lecture des petites annonces. On souhaite afficher des données provenant de la BDD. READ du CRUD correspondant à un SELECT * </h2>
    <p>Le client souhaite que toutes ses annonces apparaissent directement après la soumission dans un tableau. Il
        s'agit donc de récupérer tout les résultats de la table et boucler sur ce jeu de résultat dans le tableau. </p>
    <small>Une requete de selection doit être affectée à une variable pour receptionner l'objet PDOStatement pui la méthode fetch(PDO::FETCH_ASSOC) ou fetchAll(PDO::FETCH_ASSOC) doit être appelé sur cette variable. et à nous affecté à une variable définitive contenant tout les résultats sous forme de tableau</small>

    <table class="table">
        <thead>
        <tr>
            <th>annonce</th>
            <th>tel</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

      <tr>
            <td></td>
            <td></td>
            <td>
                <a href="" class="btn btn-danger">Voir</a>
                <a href="" class="btn btn-danger">Modifier</a>
                <a href="" class="btn btn-danger">Supprimer</a>
            </td>
        </tr>

        </tbody>
    </table>


    <h2>Exercice 3: Lecture d'une petite annonce. SELECT * FROM ... WHERE id=...</h2>
    <p>Le client souhaite que lorsqu'on clique sur voir un encadré apparaissent avec tout le détail de l'annonce sur laquelle il a cliqué en dessous.
        l'affichage de la card est soumis à la condition qu'un utilisateur ai cliqué sur voir, faire la condition</p>
    <small>Rappel: si l'on souhaite récupérer le détail d'une annonce, il nous faut récupérer son id et le faire transiter en get grace à ?id=..</small>


    <div class="card w-50 mx-auto">
        <div class="card-body">annonce:  </div>
        <div class="text-center card-title">tel: </div>
    </div>



    <h2>Exercice 4: Charger un tableau et le mettre en session</h2>
<p>En cliquant sur le liens ci-dessous, un traitement doit être généré. Le 1er créer un tableau $user qui va avoir pour indices 'nom','prenom','email', 'tel' et pour valeur après les => des informations correspondantes.  Charger ce tableau dans la session sur une entrée 'user'. Si il y a présence d'une entrée 'user' en session afficher la card si dessous remplie de ses informations</p>
    <a href="?action=profil" class="btn btn-secondary">voir mon profil</a>

    <?php     if (isset($_SESSION['user'])):           ?>
    <div class="card w-50 mx-auto">

        <div class="text-center card-title">nom: </div>
        <div class="text-center card-title">prenom: </div>
        <div class="text-center card-title">email: </div>
        <div class="text-center card-title">tel: </div>
    </div>
    <?php     endif;           ?>


<h2>Exercice 5: Charger une variable et la faire transiter dans une autre page avec $_GET</h2>
<p>Créer un liens en dessous pour ouvrir la page hello_world.php et y afficher 'hello world' qui aura été chargé par une variable transitée en get. Créer ausi un liens permettant de revenir sur notre index.php d'exo'.</p>


<h2>Exercice 6: Reprennons le tableau de l'exercice 2. Modification d'un enregistrement. UPDATE ... SET ...=... WHERE id=... </h2>
<p>Le client souhaite que les petites annonces soient modifiables. Activer le bouton modifier avec une action update et l'id de l'annonce à modifier. Récupérer l'annonce en question avec un SELECT * FROM ... WHERE id=... (charger le résultat dans une variable $modif_annonce) et préremplir les champs du formulaire avec les valeurs de cette variable. Mettre en place la requete de modification à la condition qu'il existe $_POST['id]  </p>

<form method="post" action="">
    <input type="hidden" name="id" value="">
    <textarea name="annonce" id="" cols="30" rows="10"> </textarea>
    <input name="tel" value="" type="text">

    <button type="submit">Valider</button>
</form>
    <h2>Exercice 7: Reprennons le tableau de l'exercice 2. Suppression d'un enregistrement. DELETE FROM ... WHERE id=... </h2>
    <p>Notre client souhaite que ses utilisateurs puissent retirer leurs annonces. activer le bouton supprimer du tableau de l'exercice 2</p>


</div>
<?php require_once '../inc/footer.inc.php'; ?>
