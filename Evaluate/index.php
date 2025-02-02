<?php
include "../dbConnected.php";
session_start();
if (!isset($_SESSION['id'])) {
    header("location:../login");
}

$query = $pdo->prepare("
    select 
        p.id AS idprob, 
        p.name AS nameprob, 
        p.photo AS photoprob, 
        tp.idTeam, 
        tp.id as IdTP,
        tp.pathFile as pathFile,
        tp.date_submission  
        FROM team_problems tp
    , problems p where tp.idProblems = p.id
    order by tp.date_submission
");

$query->execute();
$submissions = $query->fetchAll();

$problems = [];
foreach ($submissions as $submission) {
    $idprob = $submission['idprob'];
    if (!isset($problems[$idprob])) {
        $problems[$idprob] = [
            'name' => $submission['nameprob'],
            'photo' => $submission['photoprob'],
            'submissions' => []
        ];
    }
    $problems[$idprob]['submissions'][] = $submission;
}


$page = "Evaluate";
$page_title = "Evaluate Example";
include "../layout.phtml";
