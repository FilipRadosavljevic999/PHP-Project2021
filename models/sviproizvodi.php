<?php
ob_start();

include("../config/connection.php");
if(isset($_GET['brojstrane'])){
    $brojstrane=$_GET['brojstrane'];
    $upit=executeQuery("SELECT * FROM artikl");
    $broj = count($upit);
    $limit = 4;
    $offset = ($brojstrane - 1) * $limit;
    $rezultat=executeQuery("SELECT a.naziv,a.manjaslika,c.cena FROM artikl AS a INNER JOIN cenovnik AS c ON a.idartikl=c.idartikl WHERE c.aktivna=1 && a.kolicina>0 LIMIT $limit OFFSET $offset");
}else{
    $limit=4;
    $rezultat=executeQuery("SELECT a.idartikl,a.naziv,a.manjaslika,c.cena FROM artikl AS a INNER JOIN cenovnik AS c ON a.idartikl=c.idartikl WHERE c.aktivna=1 && a.kolicina>0 LIMIT $limit");
}


$code=200;
http_response_code($code);
header('Content-Type:application/json');
echo json_encode($rezultat);
?>

