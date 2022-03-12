<?php

$fajl=file('../data/log.txt');
//var_dump($fajl);
$pocetna=0;
$admin=0;
$register=0;
$prodavnica=0;
$danprovera=(string)date('d');
foreach ($fajl as $f){
    list($phps,$datum,$ip,$dan,$strana)=explode('________',$f);



    if($dan==$danprovera && trim($strana)=='admin'){

        $admin++;
    }
    if($dan==$danprovera && trim($strana)=='pocetna'){
        $pocetna++;
    }
    if($dan==$danprovera && trim($strana)=='login'){
        $register++;
    }
    if($dan==$danprovera && trim($strana)=='prodavnica'){
        $prodavnica++;
    }

}
$code=200;
$rezultat=['admin'=>$admin,'pocetna'=>$pocetna,'register'=>$register,'prodavnica'=>$prodavnica];
http_response_code($code);
header('Content-Type:application/json');
echo json_encode($rezultat);

