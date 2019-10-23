<?php
//セッションのスタート
session_start();

// 関数ファイルの読み込み
include("user_functions.php");
$pdo = connectToDb();

// ログイン状態のチェック
checkSessionId();

// getで送信されたidを取得
$id = $_GET["id"];

//DB接続します
$pdo = connectToDb();

//データ登録SQL作成，指定したidのみ表示する
$sql = 'SELECT*FROM user_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//メニューの表示(管理者用)
$menu_login1 = menu_login1();

//データ表示
if ($status == false) {
  // エラーのとき
  showSqlErrorMsg($stmt);
} else {
  // エラーでないとき
  $rs = $stmt->fetch();
  // fetch()で1レコードを取得して$rsに入れる
  // $rsは配列で返ってくる．$rs["id"], $rs["task"]などで値をとれる
  // var_dump()で見てみよう
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ユーザー情報更新ページ</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
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
      <a class="navbar-brand" href="#">ユーザー情報更新</a>
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

  <form method="post" action="user_update.php">
    <div class="form-group">
      <label for="name">名前</label>
      <!-- 受け取った値をvaluesに埋め込もう -->
      <input type="text" class="form-control" id="name" name="name" value="<?= $rs["name"] ?>">
    </div>
    <div class="form-group">
      <label for="lid">ログインID</label>
      <!-- 受け取った値挿入しよう -->
      <input type="text" class="form-control" id="lid" name="lid" rows="3" value="<?= $rs["lid"] ?>">
    </div>
    <div class="form-group">
      <label for="lpw">ログインPW</label>
      <!-- 受け取った値挿入しよう -->
      <input type="text" class="form-control" id="lpw" name="lpw" rows="3" value="<?= $rs["lpw"] ?>">
    </div>
    <div class="form-group">
      <label for="kanri_flg">一般:0,管理者:0</label>
      <!-- 受け取った値挿入しよう -->
      <input type="text" class="form-control" id="kanri_flg" name="kanri_flg" rows="3" value="<?= $rs["kanri_flg"] ?>">
    </div>
    <div class="form-group">
      <label for="life_flg">アクティブ:0,非アクティブ:1</label>
      <!-- 受け取った値挿入しよう -->
      <input type="text" class="form-control" id="life_flg" name="life_flg" rows="3" value="<?= $rs["life_flg"] ?>">
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary">承認</button>
    </div>
    <!-- idは変えたくない = ユーザーから見えないようにする-->
    <input type="hidden" name="id" value="<?= $rs["id"] ?>">
  </form>

</body>

</html>