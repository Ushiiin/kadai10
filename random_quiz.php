<?php

//1.  DB接続します
require_once('funcs.php');
$pdo = db_conn();

$stmt = $pdo->prepare('SELECT * FROM quiz_table ORDER BY RAND() LIMIT 1');
$status = $stmt->execute();
var_dump($status);

$val = $stmt->fetch();

$id = $val['id'];
$url = 'detail.php?id=' . $id;

redirect($url);