<?php
require_once 'Db.php';

function debug($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

// prendre quelques elements random depuis un tableau
// @param nbr d' elements qu'on desire obtenir
// @param array en parametre
// @return array 
function randElmtfromArray( int $nbr, array $monArray): array
{
    $randomArray = [];
    for( $i=0; $i<$nbr; $i++ ){
        $tempNbr=rand()&count($monArray)-1 ;
        $temp=$monArray[$tempNbr];

        unset($monArray[$tempNbr]);
        $monArray = array_values($monArray); // 'reindex' $monArray

        $randomArray[] = $temp;
        // debug($randomArray); 

    }
    // die;
    return $randomArray;
}

function insertIntoTeamMedia( $lastIdMedia, $lastIdTeam ){
    $pdo=Db::getDB();
    $resultat = $pdo->prepare("INSERT INTO team_media (id_media, id_team)
                                VALUES (:id_media, :id_team)");
    $lastId = $resultat->execute(array( ':id_media' =>trim(htmlspecialchars($lastIdMedia)) , 
                                        ':id_team' => trim(htmlspecialchars($lastIdTeam )) 
                                        )
                                    );
    return $lastId;
}

function execute(string $requete, array $data=[],$lastId=null)
{
    // boucle pour echapper les caractères speciaux (pour neutraliser les balise <style> ou <script>) en entité html et de même supprimer les espaces éventuels en début de fin de chaine de caractère
    foreach ($data as $marqueur => $valeur){
        // ici on réaffecte à notre tableau $data
        // les nouvelles valeurs échappées et sans espaces pour chaque tour de boucle
        $data[$marqueur]=trim(htmlspecialchars($valeur));
    }
    $pdo=Db::getDB(); // connexion à la BDD provenant de Db.php
    // var_dump($pdo); die();
    $resultat= $pdo->prepare($requete);// on prépare la requête envoyée avec marqueur (:marqueur)
    
    $success=$resultat->execute($data);// on execute en passant notre tableau associatif de nos marqueurs avec leur valeurs

    if($success){ // si tout s'est bien passé ($success renvoi true ou false)

        if ($lastId){ // si le paramètre optionnel $lastId est renseigné

            return $pdo->lastInsertId();// on renvoie le dernier id inséré

        }else{ // sinon on renvoi le jeu de résultat
            return $resultat;
        }

    }else{ // on s'assure d'un retour même si le traitement a échoué

        return  false;
    }




}

/*
 * valider mot de passe
 * @param string $mdp
 */
function isValidMDP($mdp)
{
  return preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,20}$/', $mdp)  ;
}


function isConnect()
{
    if (isset($_SESSION['email_user'])){
        return true;
    }else{
        return false;
    }
}

function admin()
{
    if (isConnect() && $_SESSION['user']['role']=='ROLE_ADMIN'){

        return true;
    }else{
        return false;
    }

}

function password_strength_check($password, $min_len = 6, $max_len = 15, $req_digit = 1, $req_lower = 1, $req_upper = 1, $req_symbol = 1)
{

    // Build regex string depending on requirements for the password
    $regex = '/^';
    if ($req_digit == 1) {
        $regex .= '(?=.\d)';
    }              // Match at least 1 digit
    if ($req_lower == 1) {
        $regex .= '(?=.[a-z])';
    }           // Match at least 1 lowercase letter
     if ($req_upper == 1) {
        $regex .= '(?=.[A-Z])';
    }          // Match at least 1 uppercase letter
    if ($req_symbol == 1) {
        $regex .= '(?=.[^a-zA-Z\d])';
    }    // Match at least 1 character that is none of the above
    $regex .= '.{' . $min_len . ',' . $max_len . '}$/';


    if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/", $password)) {
        return TRUE;
    } else {
        return FALSE;
    }
}





