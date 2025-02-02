<?php
include "../dbConnected.php";
session_start();
if (!isset($_SESSION['id'])) {
    header("location:../login");
}



if (isset($_POST['submit_rang'])) {
    $query = $pdo->prepare("
                 select
                 tp.date_submission as date_submission ,
                 p.points as points,
                 p.DateOpen as DateOpen,
                 p.Duration as Duration
                 FROM team_problems tp , problems p
                 where tp.idProblems = p.id and tp.id=:id ");
    $query->execute([
        "id" => $_POST['idTp']
    ]);
    $problem_submission = $query->fetch();
    $date_open_timestamp = strtotime($problem_submission['DateOpen']);
    $date_submission_timestamp = strtotime($problem_submission['date_submission']);
    $date_final = $date_submission_timestamp - $date_open_timestamp;
    //var_dump("Date Final " .$date_final);
    $duration =$problem_submission['Duration'];
    //var_dump('Duration ' .$duration);
    $answer=$_POST['range'];
   // var_dump("tetetetet" .$date_final < ($duration / 2));
    exit();
    if ($date_final < ($duration / 2)) {
        if ($answer > 15) {
            $answer += $problem_submission['points'] + 5;
        }
    } else {
        $answer += $problem_submission['points'];
    }
    $update_query = $pdo->prepare("UPDATE team_problems SET score = :score WHERE id = :id");
    $update_query->execute([
        "score" => $answer,
        "id" => $_POST['idTp']
    ]);
}


$query = $pdo->prepare("
    select 
        p.id AS idprob, 
        p.name AS nameprob, 
        p.photo AS photoprob, 
        tp.idTeam, 
        tp.id as IdTP,
        tp.pathFile as pathFile,
        tp.score as score,
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
