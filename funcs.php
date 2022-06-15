<?php
//アラート表示
function func_alert($message) {
    echo "<script>alert('$message');</script>";
}

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続
function db_conn()
{
    try {
        $db_name = 'gs_quiz_db';    //データベース名
        $db_id   = 'root';      //アカウント名
        $db_pw   = 'root';      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = 'localhost'; //DBホスト
        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}

//SQLエラー
function sql_error($stmt)
{
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('SQLError:' . $error[2]);
}

//リダイレクト
function redirect($file_name)
{
    header('Location: ' . $file_name);
    exit();
}


// ログインチェック処理 loginCheck()
function loginCheck() {
    if ($_SESSION['chk_ssid'] != session_id()) {
        // loginに失敗した場合
        exit('LOGIN ERROR');
    } else {
        // loginに成功した場合
        // カギを変更する。ログインするたびに毎回変更する。
        session_regenerate_id(true);
        $_SESSION['chk_ssid'] = session_id();
    }
}

// ファイルデータを保存
// @param string $filename ファイル名
// @param string $save_path 保存先のパス
// @param string $caption 投稿の説明
// return bool $result

function fileSave($name, $save_path, $description, $answer, $creater)
{
    $result = false;
    $sql = "INSERT INTO quiz_table (quiz_name, file_path, description, answer, creater) VALUE (?,?,?,?,?)";

    try {
        $stmt = db_conn()->prepare($sql);
        // ?二個の三つを入れる。
        $stmt->bindValue(1, $name);
        $stmt->bindValue(2, $save_path);
        $stmt->bindValue(3, $description);
        $stmt->bindValue(4, $answer);
        $stmt->bindValue(5, $creater);
        echo "AAA";
        $result = $stmt->execute();
        return $result;
    } catch(\Exception $e) {
        echo $e->getMessage();
        return $result;
    }
}