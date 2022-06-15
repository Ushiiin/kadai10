<?php

// ログインチェック
session_start();
require_once('funcs.php');
loginCheck();

// 管理フラグがないときにはアクセス不可
if (!$_SESSION['kanri_flag']) {
    echo "You don't have a permission to access. Back to previous page in 3 seconds.";
    // 5秒後に移動
    header("refresh:3;url=quiz_top.php");
    exit();
}


//1. POSTデータ取得
$id = $_GET['id'];

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('DELETE FROM quiz_table WHERE id = :id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    sql_error($stmt);
} else {
    redirect('quiz_top.php');
}
