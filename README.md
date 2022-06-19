# 画像クイズ

## 概要
- ユーザーが画像とそれがとられた都道府県をアップロード。
- ほかのユーザーが画像がとられた都道府県をあてるクイズアプリ。

## 機能
- ユーザー登録
    - 管理人はmaster一人。管理人権限は画像の削除。
    - guestとしてユーザー登録可能。
    - Passwordのハッシュ化(New)
- 画像クイズ登録
    - 画像タイトル、画像、撮影された都道府県、説明を登録。
    - Confirm画面を追加(New)
- クイズ回答
    - 登録されたクイズを指定orランダムで回答可能。


## 各ファイルの説明。
- funcs.php
    - 使っている関数群

- login.php
    - User IDとUser Passwordを入れるlogin page

- login_act.php
    - 入力されたIDとPasswordがDatabase内になるかをチェック。
    - ある場合はquiz_topへ、ない場合はloginへ戻る。

- register.php
    - 新規IDを登録

- register_act.php
    - 入力されたIDとPasswordをDatabaseに登録する作業。
    - エラーの場合はログインページに自動で戻る。

- quiz_top
    - クイズ一覧を確認できる。
    - 管理権限 = 1の人のみ削除ボタンが出現。

- delete
    - 該当idのクイズを削除する。
    - 管理権限 = 1の人のみ閲覧可能。

- detail
    - クイズを1問ずつ表示する。
    - 画像に対して何県かをあてる。

- new_quiz
    - 新しいクイズを追加する。
    - FILEをアップロードする必要がある。
    - uploadへ飛ぶ。

- confirm
    - 確認画面。

- upload
    - タイトル、画像、説明、クイズの答えをアップロードする。

- random_quiz.php
    - 登録されている画像クイズからランダムで一つ出す。