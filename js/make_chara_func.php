<?php
define("IS_NOT_FULL" ,1);
define("SAME_USERNAME" ,2);
define("CLEAR",0);

define("PARAM_TOTAL", 50);
function isPost(){
	if(isset($_POST['name']) && isset($_POST['hp']) && isset($_POST['atk']) 
		&& isset($_POST['def']) && isset($_POST['spd']) ){
		return true;
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

function makecharactor(){
	//errorのビット 
	$error = 0x0;
	//項目が埋まっていなかったら(ビット下１桁目)
	if(!isPost()){$error += (1 << 0);}
	//HPなどが整数ではなかったら(ビット下2桁目)
	if(!checkparam()){$error += (1 << 1);}
	//ステータスの合計が規定値を満たしていなかったら
	if(!checkparamtotal()){$error += (1 << 2);}
	//クリア
	echo $error;
	return $error;
}
?>