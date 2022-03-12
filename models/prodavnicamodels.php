<?php
ob_start();
include "../config/connection.php";
$strana=$_GET['strana'];
$key=$_GET['keyword'];
$min=$_GET['min'];
$max=$_GET['max'];
if($key=="") {
    $key ="%";
}
if($min=="") {
    $min =0;

}
if($max=="") {
    $max =50000000000;

}
$upit = executeQuery('SELECT * FROM artikl WHERE kolicina>0');

$broj = count($upit);
$limit1 = 4;
$brojstrana = ceil($broj / $limit1);
if($strana==1){
    $limit=4;
    $rezultat=executeQuery("SELECT a.idartikl,a.naziv,a.manjaslika,c.cena 
                                FROM artikl AS a INNER JOIN cenovnik AS c ON a.idartikl=c.idartikl 
                                WHERE c.aktivna=1 && a.kolicina>0 && 
                                c.cena>=$min && c.cena<=$max && a.naziv LIKE '%$key%' LIMIT $limit ");

    /*$upit->bindParam(":min",$min);
    $upit->bindParam(":max",$max);
    $upit->bindParam(":key",$key);
    $upit->bindParam(":limit",$limit);
    $rezultat=$upit->execute();*/
    //var_dump($rezultat);
}
else{
    $upit=executeQuery("SELECT * FROM artikl");
    $broj = count($upit);
    $limit = 4;
    $offset = ($strana-1) * $limit;
    $rezultat=executeQuery("SELECT a.idartikl,a.naziv,a.manjaslika,c.cena 
                                FROM artikl AS a INNER JOIN cenovnik AS c ON a.idartikl=c.idartikl 
                                WHERE c.aktivna=1 && a.kolicina>0 && 
                                c.cena>=$min && c.cena<=$max && a.naziv LIKE '%$key%' LIMIT $limit  OFFSET  $offset");


}
$odgovor=['brojstrana'=>$brojstrana,'artikli'=>$rezultat];
$code=200;
http_response_code($code);
header('Content-Type:application/json');
echo json_encode($odgovor);

