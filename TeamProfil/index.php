<?php
include "../dbConnected.php";
session_start();

if (!isset($_SESSION['id'])) {
    header("location:../login");
}

$problems=$pdo->prepare("SELECT * FROM problems WHERE IsOpen =:IsOpen");
$problems->execute(["IsOpen"=>1]);
$open_problems=$problems->fetchAll();

$page = "TeamProfil";
$page_title = "Team Profil";
include "../layout.phtml";



?>