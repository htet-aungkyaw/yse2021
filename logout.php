<?php
/* 
【機能】
	セッション情報を削除しログイン画面に遷移する。
*/
//①セッションを開始する。
session_start();
//②セッションを削除する。
if(isset($_SESSION["login"])) {
unset($_SESSION["user"]);
unset($_SESSION["login"]);
}						
//③ログイン画面へ遷移する。
header("Location: login.php");
exit;
