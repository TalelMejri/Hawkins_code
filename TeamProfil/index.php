<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("location:../login");
}

$problems=$pdo->prepare("SELECT * FROM `problems` WHERE ");

$page = "TeamProfil";
$page_title = "Team Profil";
include "../layout.phtml";



?>