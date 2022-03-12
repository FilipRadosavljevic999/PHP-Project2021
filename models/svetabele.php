<?php
ob_start();
include "../config/connection.php";
$pol=executeQuery("SELECT idpol AS id, nazivpola AS naziv FROM pol");
$vrsta=executeQuery('SELECT `idvrsta` AS id,`vrstanaziv` AS naziv FROM `vrsta`');
$precnik=executeQuery("SELECT `idprecnik` AS id,`velicina` AS naziv FROM `precnik`");
$narukvica=executeQuery("SELECT `idnarukvica` AS id,`naziv` FROM `narukvica`");
$mehanizam=executeQuery("SELECT `idmehanizam` AS id,`naziv` FROM `mehanizam`");
$code=201;
$odgovor=
    [
    'pol'=>$pol,
    'vrsta'=>$vrsta,
    'mehanizam'=>$mehanizam,
    'narukvica'=>$narukvica,
    'precnik'=>$precnik
    ];
http_response_code($code);
header('Content-Type:application/json');
echo json_encode($odgovor);

