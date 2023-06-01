
--  4 opérations de base pour le stockage et la manipulation des données => le CRUD
--  C =>Create (requêtes d' insert ou de replace) pour créer un nouvel enregistrement ( cas d'un formulaire d'ajout ou d'inscription)
--  R => Read (requêtes de select ) pour lire les enregistrement en BDD ( affichage des données d'une table avec condition ou non ex: page liste produit ....)
--  U => Update (requête d'update ou replace) pour modifier les valeurs d'un enregistrement ( modification de produit, d'un profil pour formulaire d'ajout mais prérempli d'information liées à cette enregistrement )
--  D => Delete ( requêtes de delete ) pour supprimer un enregistrement


-- Requêtes de sélection avec le mot clés SELECT

-- SELECT signifie va me récupérer des données (directive d'affichage), il est toujour suivi des informations à récupérer (le nom des colonnes que l'on souhaite afficher ) généralement * (pour all, récupère toutes les colonnes des enregistrement). Après cela systématiquement un FROM suivi du nom de la table ou l'on puise les données. ENfin il peut être suivi de divers éléments qui constituraient une condition ou un ordre ou un groupement ou bien une limit de résultats
SELECT * FROM employes;
-- dès lors que nous une donnée pour une requête d'affichage elle est synonyme de condition et de ce fait fait intervenir la clause WHERE ou GROUP BY ... HAVING

--ex: selectionnner tout les employes du service informatique
-- ici notre donnée est service informatique on compare donc la valeur de la colonne service deriere la clause where
SELECT * FROM  employes WHERE service='informatique';

-- plusieurs conditions => AND , équivalent du && en php
-- selectionnner tout les employes du service informatique et salaire supérieur à 2000
SELECT * FROM employes WHERE service='informatique' AND salaire > 2000;
-- avec le OR
SELECT * FROM employes WHERE (service='informatique' AND salaire=1900) OR (salaire =2300);
-- Le OR relance une nouvelle requête sans se préoccuper des précédents paramètre de la clause WHERE

-- selectionnner tout les employes du service informatique et commercial (2 informations conditionnelles qui concernent la même collone de Table)
-- IN
SELECT * FROM employes WHERE service='informatique' OR  service='commercial'; --(OR car AND chercherai à remplir les 2 conditions)
SELECT * FROM employes WHERE service IN ('informatique', 'commercial');

-- selectionnner tout les employes qui n'appartiennent pas au  service informatique et commercial
-- NOT IN
SELECT * FROM employes WHERE service NOT IN ('informatique', 'commercial');

-- comparatif de valeur
-- Tout les employes ayant un prénom composé ( comportant un -)
SELECT * FROM employes WHERE prenom LIKE '%-%';

SELECT service FROM employes; -- affiche toute la colonne service de la table employe
-- DISTINCT
SELECT DISTINCT service FROM employes; -- affiche tout les services sans doublons

-- BETWEEN comparaison sur un interval => utilisé pour les dates et les chiffres
SELECT * FROM employes WHERE salaire BETWEEN 1500 AND 2000;

--  Ordonner un jeu de résultat
-- par defaut un jeu de résultat est ordonné sur la clé primaire en ordre croissant ASC
-- ORDER BY suivi du nom de la colonne puis de DESC si voulu décroissant ASC étant l'ordre par defaut
SELECT * FROM employes ORDER BY prenom, salaire DESC; -- peut ordonner sur date, chiffres et alphabet

-- Les 5 derniers avis
SELECT * FROM avis ORDER BY id DESC LIMIT 0,5;
SELECT * FROM avis ORDER BY id DESC LIMIT 1,5; -- Les derniers avis sauf le tout dernier sauté grace à l'offset 1

-- alias pour renommer une colonne avec AS précédé du nom de la colonne et suivi du renommage

-- Fonctions d'agrégat
-- COUNT() pour compter un jeu de résultat (compte le nombre d'enregistrement)
-- SUM() pour additionner un jeu de résultat (compte les valeurs des enregistrements)
-- AVG() pour la moyenne
-- MAX()
-- MIN()
-- ROUND() pour arrondir sans décimal si rien de spécifié sinon contient une , suivi du nombre de décimal
-- ex: ROUND(AVG(salaire), 1) -- 1 chiffre après la virgule

--Afficher le nombre d'employes par service sauf service informatique -- apres un GROUP BY une clause WHERE ne peut être utilisé, on la remplace par HAVING
SELECT service, COUNT(id_employes) FROM employes GROUP BY service;
-- une fonction d'agrégat croisé avec une autre colonne utilisera automatiquement GROUP BY

-- ***************************
-- Exercices
-- ***************************
-- 1. Afficher le service de l'employé 547
SELECT service FROM employes WHERE id_employes = 547

-- 2. Afficher la date d'embauche d'Amandine
SELECT date_embauche FROM employes WHERE prenom = 'Amandine'

-- 3. Afficher le nombre de commerciaux
SELECT COUNT(*) FROM employes WHERE service = 'commercial'

-- 4. Afficher le salaire des commerciaux sur 1 année
SELECT SUM(salaire)*12 FROM employes WHERE service = 'commercial'

-- 5. Afficher le salaire moyen par service
SELECT service, AVG(salaire) FROM employes GROUP BY service

-- 6. Afficher le nombre de recrutement sur 2010
SELECT COUNT(*) FROM employes WHERE date_embauche like '2010%'
SELECT COUNT(*) FROM employes WHERE date_embauche BETWEEN '2010-01-01' AND '2010-12-31'

-- 8. Afficher le nombre de services DIFFERENTS
SELECT COUNT(DISTINCT service) FROM employes

-- 9. Afficher le nombre d'employés par service
SELECT service, COUNT(*) FROM employes GROUP BY service

-- 10. Afficher les informations de l'employé du service commercial gagnant le salaire le plus élevé
SELECT * FROM employes WHERE service = 'commercial' ORDER BY salaire DESC LIMIT 1

-- 11. Afficher l'employé ayant été embauché en dernier

SELECT * FROM employes ORDER BY date_embauche DESC LIMIT 1;


-- DE quel table proviennent les données que l'on souhaite afficher?
-- Qu'est ce qu'on souhaite affiché et du coup à quelle colonne on fait reference ? (c'est le nom de la ou des colonnes qui importe)
-- Reflechir si on on fait appel à une fonction d'agrégat (min(),max(),sum(),count()....) . Pourquoi? si on souhaite afficher une autre colonne avec cette fonction on devra obligatoirement utiliser un GROUP BY
-- EST ce qu'on a des données fournies pour cette requete ? si oui c'est cette donnée qui va être utilisé dans la WHERE ou après le HAVING dans un GROUP BY.
-- ces données, encore une fois doivent faire référence à une valeur de colonne de BDD
--   SELECT [nom des colonnes que l'on souhaite afficher (séparées par une , ) ou * ] FROM [ nom de la table d'ou proviennent les données ] [ optionnel ]: WHERE [nom de colonne => opérateur de comparaison (=, <,>,...) =>valeur de la donnée ] AND ou OR [ORDER BY ]  [ LIMIT]

-- Requêtes d'insertion => INSERT
-- INSERT INTO [nom de la table ou insert les données] ([les colonnes de la table que l'on renseigne séparées par ,]) VALUES ( [les valeurs que l'on affecte à chacune de ces colonnes dans le même ordre qu'annoncé dans la première ()]);
INSERT INTO employes (prenom, nom, sexe, service, date_embauche) VALUES ( 'toto', 'toto', 'm', 'informatique', NOW() );
-- OU REPLACE INTO
-- REPLACE INTO [nom de la table ou on insere les données] ([ toutes les colonnes de la table y compris l'id que l'on renseignera à 0 ou à NULL pour faire fonctionner l'auto-increment dans le même ordre qu'en BDD]) VALUES ([les valeurs que l'on affecte à chacune de ces colonnes dans le même ordre qu'annoncé dans la première ()])
REPLACE INTO employes (id_employes, prenom, nom, sexe, service, date_embauche, salaire ) VALUES (0, 'cesaire', 'desaulle', 'm', 'informatique', NOW());


--  A utiliser pour conserver des données provenant d'un formulaire (ex: inscription, création d'une annonce ....)

-- Requêtes de modification => UPDATE
--  UPDATE [nom de la table d'ou provient l'enregistrement à modifier] SET [nom de colonne modifié ]=[nouvelle valeur affectée], [nom de colonne modifié ]=[nouvelle valeur affectée] WHERE [colonne identifiant]=[valeur de l'identifiant];
    UPDATE employes SET salaire=5000, service='direction' WHERE id_employes=991;

-- OU REPLACE INTO
-- REPLACE INTO [nom de la table ou on insere les données] ([ toutes les colonnes de la table y compris l'id que l'on recupère généralement via $_GET dans une application dans le même ordre qu'en BDD]) VALUES ([les valeurs que l'on affecte à chacune de ces colonnes dans le même ordre qu'annoncé dans la première ()])
    REPLACE INTO employes (id_employes, prenom, nom, sexe, service, date_embauche, salaire ) VALUES (990, 'cesaire', 'desaulle', 'm', 'informatique', NOW());
        --remplace l'enregistrement d'id 990

-- Requêtes de suppression
-- DELETE FROM [nom de la table d'ou provient l'enregistrement à supprimer ] WHERE [colonne identifiant]=[valeur de l'identifiant];

DELETE FROM employes WHERE id_employes=350 OR id_employes=990;-- supprime les employes d'id 350 et 990





-------------------------------------------------------
-- JOINTURES INTERNES
-------------------------------------------------------

-- On utilise les jointure lorsque l'on souhaite afficher dans notre select des informations provenant de différentes tables. Elles sont possible à la condition d'avoir des champs commun entre les différentes tables (jeu de clés primaire / clés étrangères)

SELECT c.prenom, v.*
FROM conducteur c
INNER JOIN association_vehicule_conducteur assoc
ON c.id_conducteur=assoc.id_conducteur
INNER JOIN vehicule v
ON assoc.id_vehicule=v.id_vehicule;
-- 1ere ligne: ce que l'on souhaite afficher (le select)
-- 2eme ligne: la 1ere table d'ou proviennent les informations
-- 3eme ligne: la seconde table en communication grace à un champs commun
-- 4eme ligne: La jointure qui définit que ces 2 tables sont en relations (la cle primaire d'une des tables = la cles étrangère de l'autre table)
-- 5eme ligne [optionnel] =>une autre relation
-- 6eme ligne: la jointure entre ces 2 tables
-- ensuite optionnellement une clause where ou un group by si on souhaite croiser des colonnes ou bien l'on possède des données

-- faire la requête qui permet de m'afficher de m'afficher toutes les informations d'une annonce y compris le pseudo de l'utilisateur qui l'a posté, nom de la catégorie et le nom de la sous categorie

-- requete affichant les notes, les commantaires, le titre du produit, le pseudo de l'annonceur, titre de sa sous_categorie et celui de sa categorie, le pseudo de l'utilisateur qui l'a posté pour le produit d'id 5

(SELECT a.note, a.commentaire, p.titre, u.pseudo as aviseur, u.pseudo as annonceur , sc.titre AS 'sous-catégorie', c.titre AS catégorie FROM avis a INNER JOIN utilisateur u ON u.id=a.id_utilisateur INNER JOIN produit p ON u.id=p.id_utilisateur INNER JOIN sous_categorie sc ON p.id_sous_categorie=sc.id INNER JOIN categorie c ON c.id=sc.id_categorie WHERE p.id=22 ) UNION ALL (SELECT a.note, a.commentaire, p.titre,u.pseudo as aviseur, u.pseudo as annonceur, sc.titre AS 'sous-catégorie', c.titre AS catégorie FROM utilisateur u INNER JOIN avis a ON a.id_utilisateur=u.id INNER JOIN produit p ON a.id_produit=p.id INNER JOIN sous_categorie sc ON p.id_sous_categorie=sc.id INNER JOIN categorie c ON c.id=sc.id_categorie WHERE p.id=22);

(SELECT a.note, a.commentaire, p.titre, u.pseudo as aviseur, u.pseudo as annonceur , sc.titre AS 'sous-catégorie', c.titre AS catégorie FROM utilisateur u INNER JOIN avis a ON a.id_utilisateur=u.id INNER JOIN produit p ON a.id_produit=p.id INNER JOIN sous_categorie sc ON p.id_sous_categorie=sc.id INNER JOIN categorie c ON c.id=sc.id_categorie WHERE p.id=22) UNION ALL (SELECT a.note, a.commentaire, p.titre,u.pseudo as aviseur, u.pseudo as annonceur, sc.titre AS 'sous-catégorie', c.titre AS catégorie FROM avis a INNER JOIN utilisateur u ON u.id=a.id_utilisateur INNER JOIN produit p ON u.id=p.id_utilisateur INNER JOIN sous_categorie sc ON p.id_sous_categorie=sc.id INNER JOIN categorie c ON c.id=sc.id_categorie WHERE p.id=22 );

SELECT a.note, a.commentaire, p.titre, u.pseudo as aviseur, u.pseudo as annonceur , sc.titre AS 'sous-catégorie', c.titre AS catégorie FROM utilisateur u INNER JOIN avis a ON a.id_utilisateur=u.id INNER JOIN produit p ON a.id_produit=p.id INNER JOIN sous_categorie sc ON p.id_sous_categorie=sc.id INNER JOIN categorie c ON c.id=sc.id_categorie WHERE p.id=22;