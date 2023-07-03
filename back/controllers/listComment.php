<?php
$requete = execute("SELECT *
            FROM comment" ,
            array(':id_comment'=>'1')
        );
$data = $requete->fetchAll(PDO::FETCH_ASSOC);

$motif = 'Validation des commentaires';
$content = "commentView";
include_once 'back/indexBack.phtml';
