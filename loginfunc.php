<?php
function isPost(){
	if(isset($_POST['username']) && isset($_POST['password']) ){
		return true;
	}else{
		return false;
	}
}
function isLogin(){
	global $conn;
	
	if(!isPost()){return false;}
	//一時データにpostの中身を代入
	$temp = $_POST['username'];
	$username = mysqli_real_escape_string($conn,$temp);
	$username = str_replace("%","\%",$username);
	$condition = "WHERE name LIKE '".$username."'";
	$temp = $_POST['password'];	
	$password = mysqli_real_escape_string($conn,$temp);
	$password = str_replace("%","\%",$password);
	$condition .= " AND password LIKE '".$password."'";
	
	$sql = "SELECT * FROM User ".$condition." ORDER BY id LIMIT 10";
	//$sql = "SELECT * FROM user WHERE 1";
	//クエリの作成
	$res = mysqli_query($conn,$sql);
	if(__DEBUG__){
		echo $sql;

			if(!isset($res)){echo("Dead");}
		if($res === false){
			echo "foo";
		}
		
	}
	$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
	if(__DEBUG__){
		echo $row['name'];
	}
	$_SESSION['UserID'] = $row['id'];

	mysqli_free_result($res);
	
	return $row['name'];
}

function logout(){
	$_SESSION['Username'] = null;
	$_SESSION['UserID'] = null;
	return true;
}
?>