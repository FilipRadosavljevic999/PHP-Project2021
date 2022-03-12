<?php
ob_start();
session_start();

if(!isset($_POST['ime'])){
    header("Location:404.php");
}
if(!isset($_POST['prezime'])){
    header("Location:404.php");
}
if(!isset($_POST['adresa'])){
    header("Location:404.php");
}
if(!isset($_POST['broj'])){
    header("Location:404.php");
}
if(!isset($_POST['idartikl'])){
    header("Location:404.php");
}
$greske=[];
$id=(int)$_POST['idartikl'];
$ime=$_POST['ime'];
$prezime=$_POST['prezime'];
$adresa=$_POST['adresa'];
$broj=$_POST['broj'];

$datum = date("Y-m-d H:i:s");
$idkorisnik=(int)$_SESSION['korisnik']->idkorisnik;
$regIme = "/^[A-ZČĆŠĐŽ][a-zčćšđž]{1,14}(\s[A-ZČĆŠĐŽ][a-zčćšđž]{1,19}){0,}$/";
$regAdresa="/^[A-ZČĆŠĐŽ][a-zčćšđž]{2,15}(\s[A-ZČĆŠĐŽ][a-zčćšđž]{0,10}){0,4}\s([0-9]{1,3}|[0-9]{1,3}[a-z])$/";
$regBroj="/^06([0-6]|9)[0-9]{4,7}$/";
if(!preg_match($regIme, $ime)) {
    $greske[] ="Ime je u ne ispravnom formatu";
}
if(!preg_match($regIme, $prezime)) {
    $greske[] ="Prezime je u ne ispravnom formatu";
}
if(!preg_match($regAdresa, $adresa)) {
    $greske[] ="Adresa je u ne ispravnom formatu";
}
if(!preg_match($regBroj, $broj)) {
    $greske[] ="Broj je u ne ispravnom formatu,mora pocinjati sa 06";
}
include "../config/connection.php";
if(count($greske)==0){
    $priprema=$conn->prepare("INSERT INTO porudzbina VALUES(NULL,:idartikl,:idKorisnik,:ime,:prezime,:adresa,:broj,:datum,1)");
    $priprema->bindParam(":idartikl", $id);
    $priprema->bindParam(":idKorisnik", $idkorisnik);
    $priprema->bindParam(":ime", $ime);
    $priprema->bindParam(":prezime", $prezime);
    $priprema->bindParam(":adresa", $adresa);
    $priprema->bindParam(":broj", $broj);
    $priprema->bindParam(":datum", $datum);
    $priprema->execute();
    $_SESSION['orderOk']="Uspesno ste izvrsili porudzbinue";

}
else{
   $_SESSION['orderError']=$greske;
}

header("Location:../index.php?page=proizvodjedan&id=".$id);

