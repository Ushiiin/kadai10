<?php

// ログインチェック
session_start();
require_once('funcs.php');
loginCheck();

$id = $_GET['id']; //?id~**を受け取る
require_once('funcs.php');
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM quiz_table WHERE id=:id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    sql_error($stmt);
} else {
    $file = $stmt->fetch();
    // print_r($file);
}

$view = "";
// 画像を表示
$view .= '<img src=';
$view .= $file['file_path'];
$view .= ' alt="" width="500px">';
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>クイズ</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
            text-align: center;
        }
    </style>
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="quiz_top.php">クイズ一覧へ戻る</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <div class="align-center">
        <?= $view ?>
        <p>上の写真は何県で撮影された？</p>
        <input type="text" id="check"> <br>
        <button id="btn">提出</button>
        <!-- <p id="answer">解答：<?= $file['answer'] ?></p> -->

        <p id="result"></p>
        <!--正解は隠しinput formのhtmlに入れる-->
        <input type="hidden" id="answer" value=<?= $file['answer'] ?>>
    </div>

    

    <!-- Main[End] -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/judge.js"></script>


</body>

</html>