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
    <form enctype="multipart/form-data" method="POST" action="upload.php">
        <div class="jumbotron">
            <fieldset>
                <legend>新クイズ</legend>
                <label>クイズタイトル：<input type="text" name="title"></label><br>
                <div class="file-up">
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                    <!-- type=fileでファイルを上げることができる。 -->
                    画像ファイル：<input name="img" type="file" accept="image/*" />
                </div>
                <label>答え（都道府県）：<input type="text" name="ans"></label><br>
                <label>説明：<textArea name="desc" rows="3" cols="30"></textArea></label><br>
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->
</body>

</html>
