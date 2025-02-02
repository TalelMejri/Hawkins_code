<?php
    session_start();
    if(isset($_SESSION['id'])){
        if($verify_team['IsAdmin']){
           header("location:./AdminProfil");
        }else{
           header("location:./TeamProfil");
        }
    }else{
        header("location:./login");
    }
    $page_title="Home";
    $page="";
    include "./layout.phtml";

?>