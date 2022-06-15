<?php

//最初にSESSIONを開始！！ココ大事！！
session_start();

//POST値を受け取る
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];

//1.  DB接続します
require_once('funcs.php');
$pdo = db_conn();

//2. データ登録SQL作成
// gs_user_tableに、IDとWPがあるか確認する。
$name = "guest"; // フォームからの登録者は全員ゲスト
$stmt = $pdo->prepare('INSERT INTO user_table(name, lid, lpw, kanri_flag, life_flag)VALUES(:name,:lid,:lpw,0,0)');
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status === false){
    sql_error($stmt);
}

ログインページへ遷移
header('Location: login.php');
