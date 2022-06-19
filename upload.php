<?php
// 0. SESSION開始！！
session_start();

require_once('funcs.php');

// print_r($_SESSION);

// // ファイル関連の取得
// $file = $_SESSION['img'];  // $_FILES['img'];
// var_Dump($file);
// $filename = basename($file['name']); //パスからファイル名を取得
// $tmp_path = $file['tmp_name'];
// $file_err = $file['error'];
// $filesize = $file['size'];
// echo $tmp_path;
// // var_dump($file);
// $upload_dir = 'images/';
// $save_filename = $filename;
// $err_msgs = array();
// $save_path = $upload_dir . $save_filename;

if ($_SESSION['post']['image_data']){
    // 名前を一意にするために日付・時間をファイル名の前に追記
    $img = 'images/' . date('YmdHis') . '_' . $_SESSION['post']['file_name'];
}

if ($_SESSION['post']['image_data']) {
    file_put_contents($img, $_SESSION['post']['image_data']);
}

// キャプションの取得
// var_dump($_POST);
$name = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
$description = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_SPECIAL_CHARS);
$answer = filter_input(INPUT_POST, 'ans', FILTER_SANITIZE_SPECIAL_CHARS);
$creater = 2; //基本的に全部2
echo $description;
echo $answer;

//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('INSERT INTO quiz_table(
                            quiz_name, file_path, description, answer, creater
                        )VALUES(
                            :quiz_name, :file_path, :description, :answer, :creater
                        )');
$stmt->bindValue(':quiz_name', $name, PDO::PARAM_STR);
$stmt->bindValue(':file_path', $img, PDO::PARAM_STR);
$stmt->bindValue(':description', $description, PDO::PARAM_STR);
$stmt->bindValue(':answer', $answer, PDO::PARAM_STR);
$stmt->bindValue(':creater', $creater, PDO::PARAM_STR);
$status = $stmt->execute(); //実行

?>
<a href="./quiz_top.php">戻る</a>