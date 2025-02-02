<?php

include "../dbConnected.php";
session_start();


$nom = "";
$errors = [];
$password = "";

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $password = $_POST['password'];
    if (empty($nom)) {
        $errors['nom'] = "Name Required";
    }
    if (empty($password)) {
        $errors['password'] = "Password Required";
    }

    if (empty($errors)) {
        $team_exist=$pdo->prepare("select * from teams where nom=:nom");
        $team_exist->execute([
            "nom"=>$nom
        ]);
        $verify_team=$team_exist->fetch();
        if($verify_team){
                if(password_verify($password,$verify_team['password'])){
                     $_SESSION['id']=$verify_team['id'];
                     $_SESSION['nom']=$verify_team['nom'];
                     $_SESSION['IsAdmin']=$verify_team['IsAdmin'];
                     if($verify_team['IsAdmin']){
                        header("location:../AdminProfil");
                     }else{
                        header("location:../TeamProfil");
                     }
                }else{
                    $errors['global']="Name Or Password Incorrect";
                }
        }else{
            $errors['global']="Name Or Password Incorrect";
        }
    }
}
$page = "login";
$page_title = "Login";
include "../layout.phtml";
