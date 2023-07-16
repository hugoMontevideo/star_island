<?php
$requete = execute("SELECT * FROM comment");
$data = $requete->fetchAll(PDO::FETCH_ASSOC);

$motif = 'Validation des commentaires';
$content = "commentView";
include_once 'back/indexBack.phtml';
