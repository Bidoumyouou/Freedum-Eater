<?php
require("common.php");

require("db_common.php");

$isLogin = false;
if(isSet($_SESSION['Username'])){
	$isLogin = true;
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
      <a href="index.html">ホーム</a> &raquo; カテゴリ &raquo; ページ
   <!-- /#topicPath --></div>
   <div id="contents">
		<div id="main">
		   <h2>ようこそ！FreedumEaterの世界へ！</h2>
				<p>Freedum Eaterではあなただけのキャラクターを使ったバトルストーリーを演出できます。</p>

		</div>
   </div>
   <div id="sub">
         <div class="section">
            <h3>カテゴリ</h3>
            <ul>
               <li><a href="index.html">サブメニュー1</a></li>
               <li><a href="index.html">サブメニュー2</a></li>
               <li><a href="index.html">サブメニュー3</a></li>
            </ul>
         <!-- /.section --></div>
         <div class="section">
            <h3>カテゴリ</h3>
            <ul>
               <li><a href="index.html">サブメニュー4</a></li>
               <li><a href="index.html">サブメニュー5</a></li>
               <li><a href="index.html">サブメニュー6</a></li>
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