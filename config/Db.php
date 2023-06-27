<?php
require_once 'init.php';

// Singleton
class Db{

    /** @var \PDO|NULL $pdo */
    private static ?\PDO $pdo = NULL;

    /**
     * S'il y a une connexion active elle envoie la connexion,
     * sinon elle instancie une connexion
     * @return PDO $pdo
     */
    public static function getDb(): \PDO
    {
        if( is_null(self::$pdo) ){
            self::$pdo = self::getPDO();
        }
        return self::$pdo;
    }

   /**
    * Connexion à la BDD
    * @return \PDO 
    */
    private static function getPDO(): \PDO
    {
        try{
            $oPdo = new \PDO(
                'mysql:host='. CONFIG['db']['HOST'] . ';
                dbname='. CONFIG['db']['NAME'] .';
                charset=UTF8;
                port=' . CONFIG['db']['PORT'], 
                CONFIG['db']['USER'], 
                CONFIG['db']['PWD']
                // array(
                //     // option 1 : on affiche les erreurs SQL 
                //     //PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,  
                //     // option 2 : on définit le jeu de caractères des échanges avec la BDD
                //     PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' 
                // )
            );
        }catch (Exception $e){
            var_dump($e);
            die();
        }

        $oPdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

        if( defined('DB_SQL_DEBUG') ){
            $oPdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return $oPdo;
    }
}






// class Db{

//     public static function getDb()
//     {
//         try {

//         return   $pdo=new PDO('mysql:host='.CONFIG['db']['HOST'].';dbname='.CONFIG['db']['NAME'].';port='.CONFIG['db']['PORT'],CONFIG['db']['USER'],CONFIG['db']['PWD'],array(
//                 PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
//                 PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'

//             ) );

//         }catch (Exception $e){
//               var_dump($e);
//               die();

//         }





//     }



// }