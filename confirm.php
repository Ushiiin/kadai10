<?php
// 0. SESSION開始！！
session_start();

require_once('funcs.php');

// print_r($_SESSION);

// ファイル関連の取得
$file = $_FILES['img'];
$filename = basename($file['name']); //パスからファイル名を取得
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
// var_dump($file);
$upload_dir = 'images/';
$save_filename = $filename;
$err_msgs = array();
$save_path = $upload_dir . $save_filename;

// キャプションの取得
$name = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
$description = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_SPECIAL_CHARS);
$answer = filter_input(INPUT_POST, 'ans', FILTER_SANITIZE_SPECIAL_CHARS);
// print_r($_POST);
// print_r($description);
// print_r($save_path);

// タイトルのバリデーション
if (empty($name)) {
    redirect('new_quiz.php?error=タイトルを入力してください');
}

// キャプションのバリデーション
// 未入力
if (empty($description)) {
    // array_push($err_msgs, '説明を入力してください');
    redirect('new_quiz.php?error=説明を入力してください');
};
// 140文字以下か
if (strlen($description) > 140) {
    array_push($err_msgs, 'キャプションは140文字以下で入力してください');
    redirect('new_quiz.php?error=キャプションは140文字以下で入力してください');
}

// ファイルのバリデーション
// ファイルサイズが1MB未満か. 超えている場合にはError2で返ってくる。
if ($filesize > 1048576 || $file_err == 2) {
    // array_push($err_msgs, 'ファイルサイズは1MB未満');
    redirect('new_quiz.php?error=ファイルサイズは1MB未満にしてください');
}

// 拡張子は画像形式か
$allow_ext = array('jpg', 'jpeg', 'png');
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);

if (!in_array(strtolower($file_ext), $allow_ext)) {
    // array_push($err_msgs, 'jpgかpngの拡張子のみ対応しています。');
    redirect('new_quiz.php?error=jpgかpngの拡張子のみ対応しています。');
}

// ここではアップロードしない

// if (count($err_msgs) === 0) {
//     // ファイルがあるかどうか
//     if (is_uploaded_file($tmp_path)) {
//         if (move_uploaded_file($tmp_path, $save_path)) {
//             echo $filename . 'を' . $upload_dir .'にアップした';
//             // DBに保存(名前名、ファイルパス、説明、答え、クリエーター)
//             $result = fileSave($name, $save_path, $description, $answer, $_SESSION['id']);
//             if ($result) {
//                 echo 'アップロード成功！';
//             } else {
//                 echo 'アップロード失敗！';
//             }
//         } else {
//             echo 'ファイルのアップ失敗';
//         }

//     } else {
//         echo 'ファイルが選択されていません';
//     }
// } else {
//     foreach($err_msgs as $msg) {
//         echo $msg;
//         echo '<br>';
//     }
// }

// SESSIONへの保存
$_SESSION['img'] = $_FILES['img'];


// 画像の処理
// ある場合にはimage.phpから呼べるようにする。
if (isset($_FILES['img']['name'])){
    $file_name = $_SESSION['post']['file_name'] = $_FILES['img']['name'];
    // 一時保存されているファイル内容を取得して、セッションに格納
    $image_data = $_SESSION['post']['image_data'] = file_get_contents($_FILES['img']['tmp_name']);
    // 一時保存されているファイルの種類を確認して、セッションにその種類に当てはまる特定のintを格納
    $image_type = $_SESSION['post']['image_type'] = exif_imagetype($_FILES['img']['tmp_name']);
} else {
    // 画像がない場合は空白を保存
    $image_data = $_SESSION['post']['image_data'] = [];
    $image_type = $_SESSION['post']['image_type'] = [];
}


?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="quiz_top.php">クイズ一覧</a></div>
                <!-- <div class="navbar-header"><a class="navbar-brand" href="login.php">ログイン</a></div> -->
                <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->

    <!--ifと:で最後endifするとhtmlタグをそのまま使える-->
    <?php if(isset($_GET['error'])) : ?>
        <p class="text-danger"><?= $_GET['error']?></p>
    <?php endif; ?>

    <form enctype="multipart/form-data" method="POST" action="upload.php">
        <div class="jumbotron">
            <fieldset>
                <legend>新クイズ（確認画面）</legend>
                <label>クイズタイトル：<?= $name ?></label><br>
                <input type="hidden" name="title" value="<?= $name ?>"> <!--隠しフォーム-->

                <?php if ($image_data) : ?>
                    <div class="mb-3">
                        <img src="image.php" alt="">
                    </div>
                <?php endif; ?>

                <label>答え（都道府県）：<?= $answer ?>
                <input type="hidden" name="ans" value="<?= $answer ?>"></label><br> <!--隠しフォーム-->

                <label>説明：
                <div><?= nl2br($description) ?></div></label><br>
                <input type="hidden" name="desc" value="<?= $description ?>"> <!--隠しフォーム-->

                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->
</body>

</html>
