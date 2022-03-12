<?php

ob_start();
session_start();
if (!isset($_SESSION['korisnika']) && $_SESSION['korisnik']->nazivuloge != "admin" && !isset($_GET['id'])) {
    header('Location:404.php');
}
$id = $_GET['id'];
include('../config/connection.php');
//UPDATE `korisnici` SET `aktivan` = '0' WHERE `korisnici`.`idkorisnik` = 14
$upit = $conn->prepare('UPDATE korisnici SET aktivan=0 WHERE idkorisnik=:id');
$upit->bindParam(':id', $id);
$upit->execute();
header('Location:../index.php?page=admin');