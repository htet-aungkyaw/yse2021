<?php
/* 
【机能】
书籍の入荷数o指定する。确定ボタンす押すことで确认画面へ入荷数引き継いで迁移す
る。なお、在库数は各书100册o最大在库数とする。
【エラー一覧（エラー表示：発生条件）】
このフィールドの入力して下さい(吹き出し)：入荷个数が未入力
最大在库数oo超える数は入力できません：现在の在库数と入荷の个数の足した値が最大在库数oo超えている
数値以外が入力されています：入力された値に数字以外の文字が含まれている
*/

/*
 * ①session_status()の结果が「PHP_SESSION_NONE」と一致性するか确定する。
 * 同意した场合はif文の中に入る。
 */
if ( session_status () == PHP_SESSION_NONE ) {
	//②セッションの开始する
	session_start ();
}



//③SESSIONの「登录​​」フラグがfalseか判定する。「登录」フラグがfalseの场合はif文の中に入る。
// if (/* ③の处理oo书く */){
// //④SESSIONの「error2」に「ログインしてください」と设定する。
// //⑤ログイン画面へ迁移する。
// }

//⑥データベースへ接続し、接続情报oo変数に保存する
$ dbname = "zaiko2021_yse" ;
$主机= “本地主机”；
$ charset = "UTF8" ;
$ user =   "zaiko2021_yse" ;
$ password = "2021zaiko" ;
$ option = [ PDO :: ATTR_ERRMODE => PDO :: ERRMODE_EXCEPTION ];

//⑦データベースで使用する文字コードo「UTF8」にする
$ dsn = "mysql:dbname={$dbname};host={$host};charset={$charset}" ;
尝试
{
	$ pdo =新 PDO ( $ dsn , $ user , $ password , $ option );
	// echo "成功";
} catch ( PDOException  $ e )
{
	死( $ e -> getMessage ());
}



//⑧POST「书」値が空か甄别するの场合はif文の中に入る。
if (空( $ _POST [ "books" ])){
	//⑨SESSIONの「成功」に「入荷する商品が选妃されていません」と设定する。
	$ _SESSION [ "success" ] = "入荷する商品が选妃されていません" ;
	//⑩在库一覧画面へ迁移する。
	header ( "位置：zaiko_ichiran.php" );
}
//var_dump($_POST);
函数 getId ( $ id , $ con ){
	/* 
	 * ⑪书籍oo取得するSQL∀作成する行する。
	 * その际にWHEREでメソッドの引数の$idに一致性する书籍のみする。
	 * SQLの実行结果oo変数に保存する。
	 */
	$ id = htmlspecialchars ( $ id );
	$ sql = "SELECT * FROM books WHERE id = {$id} " ;
	$语句= $ con ->查询( $ sql );
	//⑫実行した结果から1レコード取得し、返回で値oo返す。
	$ items =   $ statement -> fetch ( PDO :: FETCH_ASSOC );
	返回 $项目；
}

?>
<!DOCTYPE html >
< html  lang =" ja " >
<头>
	< meta  http-equiv =" Content-Type " content =" text/html;charset=UTF-8 " >
	< title >入荷</ title >
	< link  rel =" stylesheet " href =" css/ichiran.css " type =" text/css " />
</头>
<身体>
	<!-- ヘッダ -->
	< div  id ="标题" >
		< h1 >入荷</ h1 >
	</ div >

	<!-- メニュー -->
	< div  id ="菜单" >
		<导航>
			< ul >
				<锂> <一个 HREF = “ zaiko_ichiran.php？页= 1 ” >书籍一覧</一> </李>
			</ ul >
		</导航>
	</ div >

	< form  action =" nyuka_kakunin.php "方法=" post " >
		< div  id ="页面主体" >
			<!-- エラーメッセージ -->
			< div  id ="错误" >
			<?php
			/*
			 * ⑬SESSIONの「错误」にメッセージが设定されているかo识别する。
			 *されていた设置场合はif文の中に入る。
			 */ 
			var_dump ( $ _POST [ "books" ]);
			
			
			// if(/* ⑬の处理oo书く */){
			// //⑭SESSIONの「错误」の中身oo表示する。
			// }
			?>
			</ div >
			< div  id ="居中" >
				<表>
					< THEAD >
						< tr >
							< th  id =" id " > ID </ th >
							< th  id =" book_name " >书名</ th >
							< th  id ="作者" >作者名</ th >
							< th  id =" salesDate " >発売日</ th >
							< th  id =" itemPrice " >金额(円) </ th >
							< th  id =" stock " >在库数</ th >
							< th  id =" in " >入荷数</ th >
						</ tr >
					</ THEAD >
					<?php 
					// /*
					// * ⑮POSTの「书」から一つずつ値hoo取り出し、変数に保存する。
					// */
					$ ids = $ _POST [ “书籍” ];
					//var_dump($_POST["books"]);
    				 foreach ( $ ids 为 $ id ):
    				// ⑯「getId」关数oo呼び出し、変数に戻り値oo入れる。その引数に⑮の处理で取得した値と⑥のDBの接続情报すす。	
					$ selectedBook = getId ( $ id , $ pdo );
					
					?>
					< input  type =" hidden " value =" <?php echo /* ⑰ ⑯の戻り値からidoo取り出し、设定する */ $ selectedBook [ "id" ]; ?> " name =" books[] " >  	
					< tr >
						< td > <?php  echo 	/* ⑱ ⑯の戻り値からidoo取り出し、表示する */  $ selectedBook [ "id" ]; ?> </ td >
						< td > <?php  echo 	/* ⑲ ⑯の戻り値からtitlehoo取り出し、表示する */ $ selectedBook [ "title" ]; ?> </ td >
						< td > <?php  echo 	/* ⑳ ⑯の戻り値からauthoro取り出し、表示する */ $ selectedBook [ "author" ]; ?> </ td >
						< td > <?php  echo 	/* ㉑ ⑯の戻り値からsalesDateο取り出し、表示する */ $ selectedBook [ "salesDate" ]; ?> </ td >
						< td > <?php  echo 	/* ㉒ ⑯の戻り値からpriceo取り出し、表示する */ $ selectedBook [ "price" ]; ?> </ td >
						< td > <?php  echo 	/* ㉓ ⑯の戻り値からstocko取り出し、表示する */ $ selectedBook [ "stock" ]; ?> </ td >
						< td > < input  type =' text ' name =' stock[] ' size =' 5 ' maxlength =' 11 ' required > </ td >
					</ tr >
					<?php  endforeach  ?>
				</表>
				< button  type =" submit " id =" kakutei " formmethod =" POST " name =" decision " value =" 1 " >确定</ button >
			</ div >
		</ div >
	</表单>
	<!-- フッター -->
	< div  id ="页脚" >
		<页脚>株式会社アクロイト</页脚>
	</ div >
</正文>
</ html >