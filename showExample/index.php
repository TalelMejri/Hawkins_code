<?php
include "../dbConnected.php";
session_start();
if(!isset($_SESSION['id'])){
    header("location:../login");
}

if (isset($_GET['IsOpen'])) {
    $query_count = $pdo->prepare("Update `problems` Set IsOpen=:isopen where id=:id");
    $query_count->execute([
        "isopen" => 1,
        "id" => $_GET['IsOpen']
    ]);
}

if (isset($_GET['IsExpired'])) {
    $query_count = $pdo->prepare("Update `problems` Set IsCompleted=:IsCompleted where id=:id");
    $query_count->execute([
        "IsCompleted" => 1,
        "id" => $_GET['IsExpired']
    ]);
}

if (isset($_GET['delete'])) {
    $query_count = $pdo->prepare("delete from problems where id=:id");
    $query_count->execute([
        "id" => $_GET['delete']
    ]);
}

$page_current = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$limit = isset($_GET['record']) && is_numeric($_GET['record']) ? $_GET['record'] : 5;
$query_count = $pdo->prepare("select count(id) from problems");
$query_count->execute();
$count_user = $query_count->fetch()['count(id)'];
$start = ($page_current - 1) * $limit;
$pages = ceil($count_user / $limit);
$next = $page_current < $count_user / $limit ? $page_current + 1 : 1;
$previous = $page_current > 1 ? $page_current - 1 : 1;
$query = $pdo->prepare("select * from problems LIMIT $start,$limit");
$query->execute();
$problems = $query->fetchAll(PDO::FETCH_ASSOC);

$page = "showExample";
$page_title = "showExample";
include "../layout.phtml";
