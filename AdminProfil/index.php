<?php

 session_start();
 
 if(!isset($_SESSION['id'])){
    header("location:../login");
 }

$page = "AdminProfil";
$page_title = "Admin Profil";
include "../layout.phtml";
