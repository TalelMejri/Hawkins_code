<?php

try {
    $pdo = new PDO("mysql:host=localhost;dbname=tnajem_css_db", "root", "");
} catch (Exception $e) {
    echo $e->getMessage();
}


?>