<?php
require("common.php");

require("db_common.php");

require("make_chara_func.php");
$ismake = makecharactor();

$isLogin = false;
if(isSet($_SESSION['Username'])){
	$isLogin = true;
}
$error[] = 0;

for($i = 0;$i < 3; $i++){
	$temp = $ismake & (1 << $i);
	if($temp != 0){$error[$i] = true;}else{$error[$i] = false;}
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" href="css/common.css" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/common.js"></script>
 
<title>s</title>
<!--<head>内に文字コードを指定するために書きこむ -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<div id="top">
	<div id="header">
		<h1>I'm Header</h1>
	</div>
	<div id = "loginMenu">
		
<?php
		if($isLogin){
			echo('<a href="logout.php" class="active">ログアウト</a>');
			echo("ようこそ".$_SESSION['Username']."さん！");
		}else{
			echo('<a href="login.php" class="active">ログイン</a>');
			echo('<p><a href="createaccount.php" class="active">アカウント作成</a>');
		}
		?>
	</div>
	<div id="menu">
      <ul>
         <li><a href="chara_make.php" class="active">キャラクター作成</a></li>
         <li><a href="index.php">メニュー2</a></li>
         <li><a href="index.php">メニュー3</a></li>
         <li><a href="index.php">メニュー4</a></li>
         <li><a href="index.php">メニュー5</a></li>
      </ul>
   </div>
   <div id="topicPath">
      <a href="index.php">ホーム</a> &raquo; カテゴリ &raquo; ページ
   <!-- /#topicPath --></div>
   <div id="contents">
		<div id="main">
		   <h2>キャラクター作成</h2>
				<p>あなただけのオリジナルキャラクターをFreedum Eaterに登録しましょう。</p>
				<?php
				if($error[0] == true){echo("<font color=red>*がついた項目は必須項目です</font><br />");}
				if($error[1] == true){echo("<font color=red>パラメータには正の整数を入力してください</font><br />");}
				if($error[2] == true){echo("<font color=red>パラメータの合計は規定値の50以下を満たしてください</font><br />");}
				?>
				<form action = "chara_make.php" method = "post">
				*名前:<input type = "text"  name = "name"><br \>
				タイプ:<input type = "text"  name = "type"><br \>
				*HP:<input type = "text"  name = "hp"><br \>
				*攻撃力:<input type = "text"  name = "atk"><br \>
				*防御力:<input type = "text"  name = "def"><br \>
				*素早さ:<input type = "text"  name = "spd"><br \>
				画像:<br \>
				<input type = "submit" name = "submit" value = "作成！"><br \>
				</form>
		</div>
   </div>
   <div id="sub">
         <div class="section">
            <h3>カテゴリ</h3>
            <ul>
               <li><a href="index.php">サブメニュー1</a></li>
               <li><a href="index.php">サブメニュー2</a></li>
               <li><a href="index.php">サブメニュー3</a></li>
            </ul>
         <!-- /.section --></div>
         <div class="section">
            <h3>カテゴリ</h3>
            <ul>
               <li><a href="index.php">サブメニュー4</a></li>
               <li><a href="index.php">サブメニュー5</a></li>
               <li><a href="index.php">サブメニュー6</a></li>
            </ul>
         <!-- /.section --></div>
      <!-- /#sub --></div>
	<div id="pageTop">
         <a href="#">ページのトップへ戻る</a>
      <!-- /#pageTop --></div>
   <div id="footer">
      <div class="copyright">Copyright &copy; 2011 YOUR SITE NAME All Rights Reserved.</div>
   <!-- /#footer --></div>

</div>

</body>
</html>