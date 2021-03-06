<!-- gopal file -->
<?php
/* 
【機能】
	　ユーザ名とパスワードを元に認証を行う。認証についてはソースコードに
	直接記述されているユーザ名とパスワードが一致しているかを確認する。
	一致していた場合はログインして書籍一覧を表示し、ログインできない
	場合はエラーとする。
【エラー一覧（エラー表示：発生条件）】
	名前かパスワードが未入力です：IDまたはパスワードが未入力
	ユーザー名かパスワードが間違っています：①IDが間違っている　②IDが正しいがパスワードが異なる
	ログインしてください：ログインしていない状態で他のページに遷移した場合(ログイン画面に遷移し上記を表示)
*/
//⑥セッションを開始する
session_start();
//①名前とパスワードを入れる変数を初期化する
$name = "";
$password = "";
$mg = "";
$errormg= "";

/*
 * ②ログインボタンが押されたかを判定する。
 * 押されていた場合はif文の中の処理を行う
 */
if (isset($_POST["decision"]) && $_POST["decision"] == 1) {
	/*
	 * ③名前とパスワードが両方とも入力されているかを判定する。
	 * 入力されていた場合はif文の中の処理を行う。
	 */
	if(!empty($_POST['name']) && !empty($_POST['pass'])){
	 $name = $_POST['name'];
	 $password = $_POST['pass'];
	
	
}else{
	$error_message[1] = '名前かパスワードが未入力です。';
}
}

	
	// if (/* ③の処理を書く */) {
	// 	//④名前とパスワードにPOSTで送られてきた名前とパスワードを設定する
	// } else {
	// 	//⑤名前かパスワードが入力されていない場合は、「名前かパスワードが未入力です」という文言をメッセージを入れる変数に設定する
	// }


//⑦名前が入力されているか判定する。入力されていた場合はif文の中に入る
 if ($name) {
 $userAdmin = "yse";
 $passwordAdmin = "2021";
	if($name == $userAdmin && $password == $passwordAdmin){
		$_SESSION["user"] = $name;
		$_SESSION["login"] = true;
		
		header("Location: zaiko_ichiran.php");
	}
	else{
		$error_message[2] = "ユーザー名かパスワードがまちがっています。";
	}
}
// 	//⑧名前に「yse」、パスワードに「2021」と設定されているか確認する。設定されていた場合はif文の中に入る
 //	if (/* ⑧の処理を書く */){
// 		//⑨SESSIONに名前を設定し、SESSIONの「login」フラグをtrueにする
// 		//⑩在庫一覧画面へ遷移する
// 		header(/* ⑩の遷移先を書く */);
// 	}else{
// 		//⑪名前もしくはパスワードが間違っていた場合は、「ユーザー名かパスワードが間違っています」という文言をメッセージを入れる変数に設定する
// 	}
// }

// //⑫SESSIONの「error2」に値が入っているか判定する。入っていた場合はif文の中に入る
// if (/* ⑫の処理を書く */) {
// 	//⑬SESSIONの「error2」の値をエラーメッセージを入れる変数に設定する。
// 	//⑭SESSIONの「error2」にnullを入れる。
// }
if(isset($_SESSION['error2'])){
	$error_message[3] = $_SESSION['error2'];
	$_SESSION['error2'] = null;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ログイン</title>
<link rel="stylesheet" href="css/login.css" type="text/css" />
</head>

<body id="login">
	<div id="main">
		<h1>ログイン</h1>
		<?php 
		if(!empty($error_message))
		{
			if(!empty($error_message[1])) $error = $error_message[1] ;
			if(!empty($error_message[2])) $error = $error_message[2];
			if(!empty($error_message[3])) $error = $error_message[3];
			echo "<div id='error'>".@$error."</div>";
		}
		
		?>
		<form action="login.php" method="post" id="log">
			<p>
				<input type='text' name="name" size='6' placeholder="Username">
			</p>
			<p>
				<input type='password' name='pass' size='6' maxlength='25'
					placeholder="Password">
			</p>
			<p>
				<button type="submit" formmethod="POST" name="decision" value="1"
					id="button">Login</button>
			</p>
		</form>
	</div>
</body>
</html>