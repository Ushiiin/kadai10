<?php
// 0. SESSION開始！！
session_start();

require_once('funcs.php');

print_r($_SESSION);

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
print_r($_POST);
print_r($description);
print_r($save_path);

// キャプションのバリデーション
// 未入力
if (empty($description)) {
    array_push($err_msgs, '説明を入力してください');
};
// 140文字以下か
if (strlen($description) > 140) {
    array_push($err_msgs, 'キャプションは140文字以下で入力してください');
}

// ファイルのバリデーション
// ファイルサイズが1MB未満か. 超えている場合にはError2で返ってくる。
if ($filesize > 1048576 || $file_err == 2) {
    array_push($err_msgs, 'ファイルサイズは1MB未満');
}

// 拡張子は画像形式か
$allow_ext = array('jpg', 'jpeg', 'png');
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);

if (!in_array(strtolower($file_ext), $allow_ext)) {
    array_push($err_msgs, 'jpgかpngの拡張子のみ対応しています。');
}

if (count($err_msgs) === 0) {
    // ファイルがあるかどうか
    if (is_uploaded_file($tmp_path)) {
        if (move_uploaded_file($tmp_path, $save_path)) {
            echo $filename . 'を' . $upload_dir .'にアップした';
            // DBに保存(名前名、ファイルパス、説明、答え、クリエーター)
            $result = fileSave($name, $save_path, $description, $answer, $_SESSION['id']);
            if ($result) {
                echo 'アップロード成功！';
            } else {
                echo 'アップロード失敗！';
            }
        } else {
            echo 'ファイルのアップ失敗';
        }

    } else {
        echo 'ファイルが選択されていません';
    }
} else {
    foreach($err_msgs as $msg) {
        echo $msg;
        echo '<br>';
    }
}

?>
<a href="./quiz_top.php">戻る</a>