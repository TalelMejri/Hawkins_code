<?php
include "../dbConnected.php";
session_start();



$req = $pdo->prepare("select t.id, tp.IdTeam ,sum(tp.Score) as Score ,count(tp.IdTeam) as ProbSolved,t.nom as name, tp.IdTeam as id from team_problems tp ,teams t where t.id=tp.IdTeam group by tp.IdTeam order by sum(tp.Score) DESC ");
$req->execute([]);
$res = $req->fetchAll(PDO::FETCH_ASSOC);
//Matmeshech
/*$req1 = $pdo->prepare("select * from teams");
$req1->execute([]);
$res1 = $req1->fetchAll(PDO::FETCH_ASSOC);

foreach ($res1 as &$row1) {
    $row1["Score"] = 0;
    foreach ($res as $row) {
        if ($row["IdTeam"] == $row1["id"]) {
            $row1["Score"] += $row["Score"];
        }
    }
}


usort($res1, function ($a, $b) {
    return $a["Score"] <=> $b["Score"];
});
*/


$page = "scoreboard";
$page_title = "scoreboard";
include "../layout.phtml";