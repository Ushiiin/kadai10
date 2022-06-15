<?php
// 0. SESSION開始！！
session_start();
// 0．関数群の読み込み
require_once('funcs.php');

// 1. ログインチェック処理！
// 以下、セッションID持ってたら、ok
// 持ってなければ、閲覧できない処理にする。

// if ($_SESSION['chk_ssid'] != session_id()) {
//     // loginに失敗した場合
//     exit('LOGIN ERROR');
// } else {
//     // loginに成功した場合
//     // カギを変更する。
//     session_regenerate_id(true);
//     $_SESSION['chk_ssid'] = session_id();

// }

loginCheck();


//２．データ登録SQL作成
$pdo = db_conn();
$stmt = $pdo->prepare('SELECT * FROM quiz_table');
$status = $stmt->execute();

//３．データ表示
$view = '';
if ($status == false) {
    sql_error($stmt);
} else {
    while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<p>';
        $view .= '<a href="detail.php?id=' . $r["id"] . '">'; //ここでURLにid=?xxxをつけて識別可能にしている。
        $view .= h($r['id']) . " " . h($r['quiz_name']) . " " . h($r['description']);
        $view .= '</a>';
        $view .= "　";

        // echo $_SESSION;
        
        // 管理者の場合には削除ボタンを表示する。
        if ($_SESSION['kanri_flag']) {
            $view .= '<a class="btn btn-danger" href="delete.php?id=' . $r['id'] . '">';
            $view .= '[<i class="glyphicon glyphicon-remove"></i>削除]';
            $view .= '</a>';
            $view .= '</p>';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>クイズ一覧表示</title>
    <link rel="stylesheet" href="css/range.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body id="main">
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="new_quiz.php">新規画像クイズ登録</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="random_quiz.php">ランダム画像クイズに挑戦</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <div>
        <div class="container jumbotron"><?= $view ?></div>
    </div>
    <!-- Main[End] -->

</body>

</html>
