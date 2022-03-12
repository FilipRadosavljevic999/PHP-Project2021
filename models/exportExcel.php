<?php

require_once "../config/connection.php";

$precnik=executeQuery("SELECT * FROM precnik");


$excel = new COM("Excel.Application");


$excel->Visible = 1;


$excel->DisplayAlerts = 1;


$workbook = $excel->Workbooks->Open("Precnik.xlsx") or die('Did not open filename');


$sheet = $workbook->Worksheets('Sheet1');
$sheet->activate;

$br = 1;
foreach($precnik as $p){
    // U A kolonu upisujemo ID
    $polje = $sheet->Range("A{$br}");
    $polje->activate;
    $polje->value = $p->idprecnik;

    // U B kolonu upisujemo TITLE
    $polje = $sheet->Range("B{$br}");
    $polje->activate;
    $polje->value = $p->velicina;



    $br++;
}

// U E kolonu upisujemo BROJ UNETIH REDOVA
$polje = $sheet->Range("E{$br}");
$polje->activate;
$polje->value = count($precnik);

// Cuvanje promena u fajla
$workbook->_SaveAs("Precnik.xlsx", -4143);
$workbook->Save();

// Zatvaranje Excel fajla
$workbook->Saved=true;
$workbook->Close;

$excel->Workbooks->Close();
$excel->Quit();

unset($sheet);
unset($workbook);
unset($excel);
