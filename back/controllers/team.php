<?php 

$requete = execute("SELECT t.id_team, m.id_media, m.title_media, m.name_media, m.id_media_type FROM team t
                    INNER JOIN team_media tm ON tm.id_team = t.id_team 
                    INNER JOIN media m ON m.id_media = tm.id_media
                    " ,
                    array()
                );
                // WHERE m.id_media_type = 18
$data3 = $requete->fetchAll(PDO::FETCH_ASSOC);  

require_once 'team.phtml' ;