<?php
ob_start();
session_start();
if(!isset($_POST['dugmeDodaj'])){
    header("Location:404.php");
}
$allowedTypes = [
    "image/jpeg",
    "image/jpg",
    "image/png"
];
$greske=[];
if(!in_array($_FILES["slika"]["type"], $allowedTypes)) {
    $greske[] = "Tip fajla nije podrzan.";
}

if($_FILES["slika"]["size"] > 2000000) {
    $greske[] = "Maksimalna velicina fajla je 2mb.";
}
$ime=$_POST['naziv'];
$cena=(int)$_POST['cena'];
$vrste=$_POST['vrsta'];
$pol=$_POST['pol'];
$precnik=$_POST['precnik'];
$narukvica=$_POST['narukvica'];
$mehanizam=$_POST['mehanizam'];
$vodootpornost=$_POST['vod'];
$kolicina=$_POST['kol'];
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
if(count($greske)==0) {


    $fileName = time() . "_" . $_FILES["slika"]["name"];
    $putanja = "../views/assets/img/" . $fileName;
    move_uploaded_file($_FILES["slika"]["tmp_name"], $putanja);
    $dimenzije = getimagesize($putanja);
    $sirina = $dimenzije[0];
    $visina = $dimenzije[1];
    $novaSirina = 500;
    $novaVisina = $visina / ($sirina / $novaSirina);
    $ekstezija = pathinfo($putanja, PATHINFO_EXTENSION);
    if ($ekstezija == "jpg") {
        $uploadedSlika = imagecreatefromjpeg($putanja);
        $platno = imagecreatetruecolor($novaSirina, $novaVisina);
        imagecopyresampled($platno, $uploadedSlika, 0, 0, 0, 0, $novaSirina, $novaVisina, $sirina, $visina);
        $malanaziv = "malaslika_" . time() . ".jpg";
        imagejpeg($platno, "../views/assets/img/" . $malanaziv, 100);
    } else {
        $uploadedSlika = imagecreatefrompng($putanja);
        $platno = imagecreatetruecolor($novaSirina, $novaVisina);
        imagecopyresampled($platno, $uploadedSlika, 0, 0, 0, 0, $novaSirina, $novaVisina, $sirina, $visina);
        $malanaziv = "malaslika_" . time() . "png";
        imagepng($platno, "../views/assets/img/" . $malanaziv, 9);
    }
    include("../config/connection.php");
    $upit = $conn->prepare("INSERT INTO artikl VALUES (NULL,:naziv,:vecaslika,:manjaslika,:kolicina,:otpornost,:narukvica,:mehaniza,:pol,:precnik,:vrsta)");
    $upit->bindParam(":naziv", $ime);
    $upit->bindParam(":vecaslika", $fileName);
    $upit->bindParam(":manjaslika", $malanaziv);
    $upit->bindParam(":kolicina", $kolicina);
    $upit->bindParam(":otpornost", $vodootpornost);
    $upit->bindParam(":narukvica", $narukvica);
    $upit->bindParam(":mehaniza", $mehanizam);
    $upit->bindParam(":pol", $pol);
    $upit->bindParam(":precnik", $precnik);
    $upit->bindParam(":vrsta", $vrste);
    $upit->execute();
    $stmt = $conn->query("SELECT LAST_INSERT_ID()");
    $lastId = $stmt->fetchColumn();
//var_dump($lastId);
    $vremeunosa = date("Y-d-m", time());
    $upitcena = $conn->prepare("INSERT INTO cenovnik VALUES(NULL,:cena,:datum,NULL,1,:idartikl)");
    $upitcena->bindParam(":cena", $cena);
    $upitcena->bindParam(":datum", $vremeunosa);
    $upitcena->bindParam(":idartikl", $lastId);
    $upitcena->execute();
    $_SESSION['uspeloDodaj']='Uspesno ste dodali artikl';
    header('Location:../index.php?page=admin');
}
else{
    $_SESSION['greskeDodaj']=$greske;
    header('Location:../index.php?page=admin');
}
//var_dump($greske);
