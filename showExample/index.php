<?php


include "../dbConnected.php";
$query=$pdo->prepare("select * from problems");
$query->execute();
$problems=$query->fetchAll(PDO::FETCH_ASSOC);

 $page="showExample";
 $page_title="showExample";
 include "../layout.phtml";