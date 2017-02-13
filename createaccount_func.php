<?php
//CreateAccount関数の返り値の定義
define("NO_USERNAME" ,0);
define("SAME_USERNAME" ,1);
define("CLEAR",2);

function isPost(){
	if(isset($_POST['username']) && isset($_POST['password']) ){
		return true;
	}else{
		return false;
	}
}

function CreateAccount(){
//共通するユーザー名のｱｶｳﾝﾄがすでに作られていればfalseを返す
	global $conn;

	if(!isPost()){return NO_USERNAME;}
	$temp = $_POST['username'];
	$username = mysqli_real_escape_string($conn,$temp);
	$username = str_replace("%","\%",$username);
	$condition = "WHERE name LIKE '".$username."'";
	
	$sql = "SELECT * FROM User ".$condition." ORDER BY id LIMIT 10";
	
	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($res);	
	
	if(isset($row)){return SAME_USERNAME;}
	mysqli_free_result($res);//結果オブジェクトが必要なくなったら解放すべき
	//そうでない場合はそのアカウントを作成
	$condition =  "'".$_POST['username']."','".$_POST['password']."'";
	$sql = "INSERT INTO `user` (`name`, `password`) VALUES (". $condition .");";
	if(__DEBUG__){
		echo $sql;
	}
	$res = mysqli_query($conn,$sql);
	return CLEAR;
}
?>
