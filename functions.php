<?php
// 共通で使うものを別ファイルにしておきましょう。

// DB接続関数（PDO）
function connectToDb()
{
  $db = 'mysql:dbname=gsacfd04_11;charset=utf8;port=3306;host=localhost';
  $user = 'root';
  $pwd = '';
  try {
    return new PDO($db, $user, $pwd);
  } catch (PDOException $e) {
    exit('dbError:' . $e->getMessage());
  }
}
//一般userのページ非表示処理
// add_action("admin_menu", "remove_menus");
// function remove_menus()
// {
//   global $current_user;
//   get_currentuserinfo();
//   if ($current_user->kanri_flg == "0") {
//     remove_menu_page("user_select.php");
//     remove_menu_page("user_detail.php");
//   }
// }
// SQL処理エラー
function showSqlErrorMsg($stmt)
{
  $error = $stmt->errorInfo();
  exit('sqlError:' . $error[2]);
}

// SESSIONチェック＆リジェネレイト
function checkSessionId()
{
  // ログイン失敗時の処理（ログイン画面に移動）
  // ログイン成功時の処理（一覧画面に移動）
  if (!isset($_SESSION["session_id"]) || $_SESSION["session_id"] != session_id()) {
    header("Location: login.php");
  } else {
    session_regenerate_id(true);
    $_SESSION["session_id"] = session_id();
  }
}

// menuを決める
function menu_nologin()
{
  $menu_nologin = '<li class="nav-item"><a class="nav-link" href="login.php">ログインページ</a></li>
           <li class="nav-item"><a class="nav-link" href="select_nologin.php">todo一覧</a></li>';
  // $menu .= '<li class="nav-item"><a class="nav-link" href="logout.php">ログアウト</a></li>';
  return $menu_nologin;
}

function menu_login0()
{
  $menu_login0 = '<li class="nav-item"><a class="nav-link" href="index.php">todo登録</a></li>
           <li class="nav-item"><a class="nav-link" href="select.php">todo一覧</a></li>';
  $menu_login0 .= '<li class="nav-item"><a class="nav-link" href="logout.php">ログアウト</a></li>';
  return $menu_login0;
}
