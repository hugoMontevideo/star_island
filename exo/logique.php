<?php require_once '../inc/header.inc.php';


/// problématique 1: je veux récupérer les informations d'une table en BDD
///  On est donc une requête de selection.
/// ma requete SQL : "SELECT * FROM la_table"
///  en PHP on doit utiliser notre objet PDO qui le pont entre notre script et la BDD. On a dans init.inc.php une fonction requête déclarée qui attend en paramètre: 1er la requête SQL entre "" et 2nd un tableau associatif optionnel*
/// ON utilise donc cette fonction:
 // on declare une variable qui va recevoir un objet PDOstatement dans le cas d'une requête de selection sinon un booléen
$resultat=requete("SELECT * FROM categorie");

//debug($resultat);=> objet PDOstatement
// maintenant on convertit ce résultat grace à fetchAll() et en array grace à l'argument PDO::FETCH_ASSOC
//$resultat->fetchAll(PDO::FETCH_ASSOC);

//debug($resultat->fetchAll(PDO::FETCH_ASSOC)); // array

// on charge dans une variable le résultat
$liste_categories=$resultat->fetchAll(PDO::FETCH_ASSOC);

// seconde problématique: on souhaite afficher les données d'un jeu de résultat.
// on sait que le jeu de résultat est retourne sous forme de tableau
// pour parcourir un tableau de manière automatique on utilise la boucle foreach
// pour récupérer une entrée spécifique d'un tableau on appelle son indice entre ['']
foreach ($liste_categories as $entrée_tableau)
{
    // problématique dans une boucle foreach() que souhaite t-on répéter
    //(une liste, une card, une ligne de tableau ou n'importe quel élément html
    foreach ($entrée_tableau as $valeur){

       echo $valeur;
    }
}



/// problématique 2 : je veux les informations à partir d'un clic effectué sur une autre page. D'une page à une autre le plus simple reste de déclarer un passage en get sur un liens afin de faire transiter l'information dans mon url.
///  sous la forme <a href="dossier/fichier.php?nom_de_mon_information=valeur_de_mon_information"
/// généralement sa valeur est dynamique au seins d'une boucle et proviens d'une variable (ex: $categorie['id']) et doit donc être concaténée au liens. Ici au click sur le liens l'info part dans l'url et le changement de page s'effectue.
/// on peut donc y récupérer par $_GET['nom_de_mon_information'] la valeur_de_mon_information et l'affecter à une variable
/// autre problématique à quoi sert cette information, si elle a pour de récupérer un résultat en BDD on repart sur problématique 1 avec une clause WHERE
// http://localhost/vinted/logique.php?id=1 (lien à utiliser)
 $req=requete("SELECT * FROM categorie WHERE id=:id", array(':id'=>$_GET['id']));
// ensuite on reflechi au nombre de jeu de résultat attendu 1 ou plusieur afin d'utiliser la bonne méthode sur $req , notre objet PDOstatement. fetch() pour 1 ou fetchAll() pour plusieur
//debug($req);
// si lors d'une requete de selection , on debug une variable et obtenons un objet PDOstatement, il est impératif d'appeler dessus ou fetch() ou fetchAll(), pour convertir en tableau
$monResultat=$req->fetch(PDO::FETCH_ASSOC); // puis on l'affecte à une variable représentant ce jeu de résultat




require_once '../inc/header.inc.php';