<?php
include "config.php";
try {
$conn = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
echo $ex->getMessage();
}

function executeQuery($query){
global $conn;
return $conn->query($query)->fetchAll();
}
function zabeleziPristupStranici($strana){
    $open = fopen("data/log.txt", "a");
    if($open){
        $date = date('d-m-Y H:i:s');
        $dan=date('d');

        fwrite($open, "{$_SERVER['PHP_SELF']}________{$date}________{$_SERVER['REMOTE_ADDR']}________{$dan}________{$strana}\n");
        fclose($open);
    }
}