<?php
define("IS_NOT_FULL" ,1);
define("SAME_USERNAME" ,2);
define("CLEAR",0);

define("PARAM_TOTAL", 50);
function isPost(){
	if(isset($_POST['name']) && isset($_POST['hp']) && isset($_POST['atk']) 
		&& isset($_POST['def']) && isset($_POST['spd']) ){
		if($_POST['name'] != null && $_POST['hp'] != null && $_POST['atk'] != null && $_POST['def'] != null
		 && $_POST['spd'] != null){
			return true;
		}else{
			return false;
		}
		
	}else{
		return false;
	}
}
function checkparam(){
	//postで送られる値はすべて文字列
	//正規表現で調べる
	if(!preg_match("/^[0-9]+$/",$_POST['hp'])){return false;}
	if(!preg_match("/^[0-9]+$/",$_POST['atk'])){return false;}
	if(!preg_match("/^[0-9]+$/",$_POST['def'])){return false;}
	if(!preg_match("/^[0-9]+$/",$_POST['spd'])){return false;}
	return true;
}

function checkparamtotal(){
	$total = (int)$_POST['hp'] + (int)$_POST['atk'] + (int)$_POST['def'] + (int)$_POST['spd'];
	if($total > PARAM_TOTAL){return false;}
	return true;
}

function isPost2(){
	if(isset($_POST['name']) || isset($_POST['hp']) || isset($_POST['atk']) 
		|| isset($_POST['def']) || isset($_POST['spd']) ){
			return true;
	}else{
		return false;
	}

}

function makecharactor(){
	global $conn;
	//errorのビット 
	$error = 0x0;
	//初めてだったら
	if(!isPost2()){return 0;}
	//項目が埋まっていなかったら(ビット下１桁目)
	if(!isPost()){$error += 1 ;}
	//HPなどが整数ではなかったら(ビット下2桁目)
	if(!checkparam()){$error += (1 << 1);}
	//ステータスの合計が規定値を満たしていなかったら(ビット下3桁目)
	if(!checkparamtotal()){$error += (1 << 2);}
	//クリア
	if($error != 0){
		return $error;
	}
	$userID = $_SESSION['UserID'];
	//SQLを作成してinsertする
	$condition = "'".$_POST['name']."','".$_POST['hp']."','".$_POST['atk']."','".$_POST['def']."','".$_POST['spd']."','".$_POST['type']."','".$userID."'";
	$sql = "INSERT INTO `charactor` (`name`,`hp`,`atk`,`def`,`spd`,`type`,`user`)";
	$sql .= " VALUES (". $condition .")";
	echo $sql;
	$res = mysqli_query($conn,$sql);
	mysqli_free_result($res);
	return 0;
}
?>