<?php

session_start();

if(!isset($_SESSION['id'])){
    header("location:../login");
 }


$page = "TeamProfil";
$page_title = "Team Profil";
include "../layout.phtml";



?>