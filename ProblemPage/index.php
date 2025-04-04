<?php
include "../dbConnected.php";
session_start();
if (empty($_GET["id"])||empty($_GET["name"])||empty($_GET["time"])||empty($_GET["Duration"])||empty($_GET["points"]))
    header("location:../TeamProfil");
$req1=$pdo->prepare("SELECT photo FROM problems WHERE id=:id");
$req1->execute(["id"=> $_GET["id"]]);
$row1=$req1->fetch();

$errors=[];
if (isset($_POST["submit"])){
    $file=$_FILES["file"];
    if(empty($file['name'])){
        $errors['message'] = "File Required";
        goto show;
    }
    $type_dispo=["html"];
    $type_current=pathinfo($file["name"],PATHINFO_EXTENSION);
    if(!in_array($type_current,$type_dispo)){
        $errors['message'] = "Invalid Type. Please enter a HTML file";
        goto show;
    }
    $file_name = md5(rand()) . ".html";

    if (!move_uploaded_file($file['tmp_name'], '../SubmissionFiles/' . $file_name)) {
        $errors["errors"] = "Failed Uploaded";
        goto show;
    }
    if (empty($errors)){
        $req=$pdo->prepare("INSERT INTO team_problems (`idProblems`,`IdTeam`,`Score`,`pathFile`) 
        VALUES (:idProblems,:IdTeam,:Score,:pathFile)");
        $req->execute(
        ["idProblems"=>$_GET["id"],
        "IdTeam"=>$_SESSION["id"],
        "Score"=>$_GET["points"],
        "pathFile"=> $file_name
        ]);
        header("location:../TeamProfil");
    }
}



show:
$page = "ProblemPage";
$page_title = "ProblemPage";
include "../layout.phtml"; 
?>