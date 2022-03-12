<?php
ob_start();
session_start();
if(!isset($_POST['dugmeIzmeni'])){
header("Location:404.php");
}
$greske=[];
$ime=$_POST['naziv'];
$cena=(int)$_POST['cena'];
$vrste=$_POST['vrsta'];
$pol=$_POST['pol'];
$precnik=$_POST['precnik'];
$narukvica=$_POST['narukvica'];
$mehanizam=$_POST['mehanizam'];
$vodootpornost=$_POST['vod'];
$kolicina=$_POST['kol'];
$id=$_POST['idartikl'];
//var_dump($id);
//var_dump($mehanizam);
$tekst='/[A-Za-z0-9\-Žćčšđž]{4,}(\s[A-Za-z0-9\-Žćčšđž]{4,}){0,}/';
$broj='/[0-9]{1,}/';
$Regceba='/[0-9]{1,7}/';
if(!preg_match($tekst,$ime)){
    $greske[]="Naziv artikla je u pogresnom formatu";
}
if(!preg_match($broj,$kolicina)){
    $greske[]="Kolicnina je u pogresnom formatu,mora biti broj";
}
if(!preg_match($Regceba,$cena)){
    $greske[]="Cena je u pogresnom formatu,mora imati manje od 7 cifara";
}
//var_dump($greske);
if(count($greske)==0){
    include "../config/connection.php";
    $upit=$conn->prepare("UPDATE artikl SET naziv=:naziv,kolicina=:kolicina,vodootpornost=:otpornost
                                ,idnarukvica=:narukvica,idmehanizam=:mehaniza,idpol=:pol,idprecnik=:precnik,
                                idvrsta=:vrsta WHERE idartikl=:id");
    $upit->bindParam(":naziv", $ime);
    $upit->bindParam(":kolicina", $kolicina);
    $upit->bindParam(":otpornost", $vodootpornost);
    $upit->bindParam(":narukvica", $narukvica);
    $upit->bindParam(":mehaniza", $mehanizam);
    $upit->bindParam(":pol", $pol);
    $upit->bindParam(":precnik", $precnik);
    $upit->bindParam(":vrsta", $vrste);
    $upit->bindParam(":id", $id);
    $upit->execute();
    $cenaupit=$conn->prepare("UPDATE cenovnik SET cena=:cena WHERE aktivna=1 && idartikl=:id");
    $cenaupit->bindParam(':cena',$cena);
    $cenaupit->bindParam(':id',$id);
    $cenaupit->execute();
    $_SESSION['uspeloizmeni']="Uspesno ste izmenili proizvod";
    header("Location:../index.php?page=izmeni&&id=".$id);
}
else{
    $_SESSION['greskaizmena']=$greske;
    header("Location:../index.php?page=izmeni&&id=".$id);


}