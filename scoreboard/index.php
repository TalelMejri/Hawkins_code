<?php

session_start();

if(isset($_SESSION['id'])){
    if($verify_team['IsAdmin']){
       header("location:../AdminProfil");
    }else{
       header("location:../TeamProfil");
    }
}else{
    header("location:../login");
}


 $page="scoreboard";
 $page_title="scoreboard";
 include "../layout.phtml";