<?php

include "../dbConnected.php";

session_start();

if(!isset($_SESSION['id'])){
    header("location:../login");
 }

$errors = [];
$name = "";
$points = 0;
$duration = 0;

if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $points = $_POST['points'];
    $duration = $_POST["duration"];
    $file = $_FILES['photo'];
    if (empty($name)) {
        $errors["errors"] = "Name Required";
        goto show;
    }

    if (empty($points)) {
        $errors["errors"] = "Points Required";
        goto show;
    }

    if (empty($duration)) {
        $errors["errors"] = "Duration Required";
        goto show;
    }

    if (empty($file['name'])) {
        $errors["errors"] = "Photo Required";
        goto show;
    }

    $type_existe = ["jpg", "png", "svg", "jpeg"];
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    if (!in_array($extension, $type_existe)) {
        $errors["errors"] = "Photo Invalid";
        goto show;
    }

    $file_name = md5(rand()) . "." . $extension;

    //if (!move_uploaded_file($file['tmp_name'], '../Problems_photo/' . $file_name)) {
    //    $errors["errors"] = "Failed Uploaded";
    //    goto show;
    //}

    if (empty($errors)) {
        $query = $pdo->prepare("INSERT INTO `problems`(`name`, `photo`, `points`, `IsCompleted`, `IsOpen`, `Duration`, `DateOpen`) VALUES (:name,:photo,:pts,:iscomp,:isopen,:duration,:DateOpen)");
        $query->execute([
            "name" => $name,
            "photo" => $file_name,
            "pts" => $points,
            "iscomp" => false,
            "isopen" => false,
            "duration" => $duration,
            "DateOpen" => (new DateTime())->format('Y-m-d H:i:s'),
        ]);
        header("location:../showExample");
    }
}

show:
$page = "AddExemple";
$page_title = "AddExemple";
include "../layout.phtml";
