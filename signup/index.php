<?php


include "../dbConnected.php";


<<<<<<< HEAD
// if(isset($_SESSION['id'])){
//     if($verify_team['IsAdmin']){
//        header("location:../AdminProfil");
//     }else{
//        header("location:../TeamProfil");
//     }
// }else{
//     header("location:../login");
// }
=======
if(isset($_SESSION['id'])){
    if($verify_team['IsAdmin']){
        header("location:../AdminProfil");
    }else{
        header("location:../TeamProfil");
    }
}else{
    header("location:../login");
}
>>>>>>> 8c006cf3fb6a07df109917651a278aa0e78a4dcf

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
        $team_exist = $pdo->prepare("select * from teams where nom=:nom");
        $team_exist->execute([
            "nom" => $nom
        ]);
        $verify_team = $team_exist->fetch();
        if ($verify_team) {
            $errors['nom'] = "Name Already Exists";
        } else {
            $query = $pdo->prepare("INSERT INTO `teams`(`nom`, `password`, `IsAdmin`) VALUES (:nom,:pass,:IsAdmin) ");
            $query->execute([
                "nom" => $nom,
                "pass" => password_hash($password, PASSWORD_DEFAULT),
                "IsAdmin" => 0
            ]);
        }
    }
}

$page = "signup";
$page_title = "signup";
include "../layout.phtml";
