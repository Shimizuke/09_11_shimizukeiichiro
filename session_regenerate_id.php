<?php
//必ずsession_startは最初に記述
session_start();

//現在のセッションIDを取得
// var_dump(session_id());
$old_id = session_id();

//新しいセッションIDを発行（前のSESSION IDは無効）
session_regenerate_id(true); //trueにして昔のIDを無効にする

//新しいセッションIDを取得
$new_id = session_id();

//旧セッションIDと新セッションIDを表示
var_dump($old_id); //var_dumpとechoどちらも同じ処理。古い削除されたIDと、新しいIDがそれぞれ表示される。
var_dump($new_id);
echo "old: " .  $old_id . " new: " . $new_id;
