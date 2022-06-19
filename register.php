<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/main.css" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
    <title>登録</title>
</head>

<body>

    <header>
        <nav class="navbar navbar-default">登録</nav>
    </header>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="login.php">ログインページへ戻る</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- register_act.php は新規ID登録用のPHPです。 -->
    <h1>新規ID登録</h1>
    <form name="form1" action="register_act.php" method="post">
        ID:<input type="text" name="lid" />
        PW:<input type="password" name="lpw" />
        <input type="submit" value="Register" />
    </form>


</body>

</html>
