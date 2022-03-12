<?php
include "../config/connection.php";
$korisnici=executeQuery("SELECT idkorisnik,ime,prezime,email FROM korisnici WHERE aktivan=1");
$proizvodi=executeQuery("SELECT a.idartikl,a.naziv,a.manjaslika,c.cena FROM artikl AS a INNER JOIN cenovnik AS c ON a.idartikl=c.idartikl WHERE c.aktivna=1 && a.kolicina>0");
$order=executeQuery("SELECT p.ime,p.prezime,p.adresa,p.brojtelefona,p.datumnarudzvine,k.email,a.manjaslika,a.naziv,c.cena FROM ((porudzbina AS p INNER JOIN korisnici AS k ON p.idkorisnik=k.idkorisnik)INNER JOIN artikl AS a ON p.idartikl=a.idartikl)INNER JOIN cenovnik AS c ON a.idartikl=c.idartikl WHERE c.aktivna=1");
$code=201;
$odgovor=['korisnici'=>$korisnici,"proizvodi"=>$proizvodi,"order"=>$order];
http_response_code($code);
header('Content-Type:application/json');
echo json_encode($odgovor);
