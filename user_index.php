<?php
//セッションのスタート
session_start();

// 関数ファイルの読み込み
include("user_functions.php");

// ログイン状態のチェック
checkSessionId();

// getで送信されたidを取得
// $id = $_GET["id"];

//DB接続します
$pdo = connectToDb();

//データ登録SQL作成，指定したidのみ表示する
// $sql = 'SELECT*FROM user_table WHERE id=:id';
// $stmt = $pdo->prepare($sql);
// $stmt->bindValue(':id', $id, PDO::PARAM_INT);
// $status = $stmt->execute();

//メニューの表示(管理者用)
$menu_login1 = menu_login1();

//データ表示
// if ($status == false) {
//     // エラーのとき
//     showSqlErrorMsg($stmt);
// } else {
//     // エラーでないとき
//     $rs = $stmt->fetch();
// fetch()で1レコードを取得して$rsに入れる
// $rsは配列で返ってくる．$rs["id"], $rs["task"]などで値をとれる
// var_dump()で見てみよう
// }
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ユーザー登録</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/css.css">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">user登録</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?= $menu_login1 ?>
                </ul>
            </div>
        </nav>
    </header>

    <form method="post" action="user_insert.php">
        <div class="form-group">
            <label for="name">ユーザー名</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="lid">ログインID</label>
            <input type="text" class="form-control" id="lid" name="lid">
        </div>
        <div class="form-group">
            <label for="lpw">ログインパスワード</label>
            <input type="text" class="form-control" id="lpw" name="lpw">
        </div>
        <div class="form-group">
            <label for="kanri_flg">一般or管理者</label>
            <!-- <input type="text" class="form-control" id="kanri_flg" name="kanri_flg"> -->
            <input type="hidden" class="form-group" id="kanri_flg" name="kanri_flg" value="$shift">
            <p>一般</p>
            <input type="radio" class="form-group" id="kanri_flg" name="kanri_flg" value=0 $checked0 />
            <p>管理者</p>
            <input type="radio" class="form-group" id="kanri_flg" name="kanri_flg" value=1 $checked1 />
        </div>
        <div class="form-group">
            <label for="life_flg">アクティブor非アクティブ</label>
            <!-- <input type="text" class="form-control" id="life_flg" name="life_flg"> -->
            <input type="hidden" class="form-group" id="life_flg" name="life_flg" value="$shift">
            <p>アクティブ</p>
            <input type="radio" class="form-group" id="life_flg" name="life_flg" value=0 $checked0 />
            <p>非アクティブ</p>
            <input type="radio" class="form-group" id="life_flg" name="life_flg" value=1 $checked1 />
        </div>
        <button type="submit" class="btn btn-primary">承認</button>
        </div>

    </form>

</body>
<?php
$shift = 0;
$checked0 = ($shift) ? "" : "checked";
$checked1 = ($shift) ? "checked" : "";
echo <<< EOT
EOT;
?>

</html>