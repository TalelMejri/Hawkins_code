<?php
include "../dbConnected.php";
$errors=[];
if (isset($_POST["submit"])){
    $file=$_FILES["file"];
    if(empty($file['name'])){
        $errors['message'] = "File Required";}
        $type_dispo=["html"];
        $type_current=pathinfo($file["name"],PATHINFO_EXTENSION);
        if(!in_array($type_current,$type_dispo)){
            $errors['message'] = "Invalid Type. Please enter a HTML file";
    }
    //uploaded failed !!!!!!!!!!!
    if (empty($errors)){
        $req=$pdo->prepare("INSERT INTO `team_problems` ");
    }
}




$page = "ProblemPage";
$page_title = "ProblemPage";
include "../layout.phtml"; 
?>