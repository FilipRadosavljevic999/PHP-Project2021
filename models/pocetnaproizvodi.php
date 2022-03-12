<?php
ob_start();

include("../config/connection.php");

$limit=6;
$rezultat=executeQuery("SELECT a.idartikl,a.naziv,a.manjaslika,c.cena FROM artikl AS a INNER JOIN cenovnik AS c ON a.idartikl=c.idartikl WHERE c.aktivna=1 && a.kolicina>0 LIMIT $limit");
$code=200;
http_response_code($code);
header('Content-Type:application/json');
echo json_encode($rezultat);
?>
