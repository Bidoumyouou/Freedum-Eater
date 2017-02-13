<?php
define("PLAYER", 0);
define("OPPONENT", 1);

function make_select_chara($mode){
//味方のキャラクラーリストのselectフォームを作成する
global $conn;
global $isLogin;
$UserID = 0;
//ログインしているか否か
if($isLogin == true){
	$UserID = $_SESSION['UserID'];
}else{
}

//自分のIDと同じ作者IDのキャラを選択肢に加える
if($mode == PLAYER){$sql = "SELECT * FROM `charactor` WHERE `user` = 0 or ".$UserID;}
else if($mode == OPPONENT){$sql = "SELECT * FROM `charactor`";}else{
	$sql = "SELECT * FROM `charactor`";
}

//クエリを作成し、データを引用する
$res = mysqli_query($conn,$sql);
if($mode == PLAYER){
echo("<select name = 'player'>");
}else{
echo("<select name = 'opponent'>");	
}
while($row = mysqli_fetch_array($res)){
	print("<option>".$row['name']."</option>");
}
echo("</select>");
mysqli_free_result($res);
}

//実際の戦闘処理
function Battle(){
global $conn;
$condition = $_POST['player'];
$sql1 = 	"SELECT * FROM  `charactor` where `name` LIKE '". $condition."'";
$res1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_array($res1);

$player1['name'] = $row1['name'] ; 
$player1['hp'] = $row1['hp'] ; 
$player1['atk'] = $row1['atk'] ; 
$player1['def'] = $row1['def'] ; 
$player1['spd'] = $row1['spd'] ; 

mysqli_free_result($res1);
$condition = $_POST['opponent'];
$sql = 	"SELECT * FROM  `charactor` where `name` LIKE '". $condition."'";
$res2 = mysqli_query($conn,$sql);
$row2 = mysqli_fetch_array($res2);


$player2['name'] = $row2['name'] ; 
$player2['hp'] = $row2['hp'] ; 
$player2['atk'] = $row2['atk'] ; 
$player2['def'] = $row2['def'] ; 
$player2['spd'] = $row2['spd'] ; 
mysqli_free_result($res2);


//( spd * time)/128　>1 を満たすたびに行動 
$b_time = 0;
$p1action = 0;
$p2action = 0;
while($player1['hp'] > 0 && $player2['hp'] > 0){
	$p1action += $player1['spd'];
	$p2action += $player2['spd'];
	//プレイヤー１の行動
	if(($p1action / 128) >= 1){
		$p1action -= 128;
		//攻撃
		$damege = $player1['atk'] / $player2['def'];
		$player2['hp'] -= (int)$damege;
		echo($player1['name']."の攻撃!".$player2['name']."は".(int)$damege."のダメージを受けた!<br />");
	}
	if(($p2action / 128) >= 1){
		$p2action -= 128;
		//攻撃
		$damege = $player2['atk'] / $player1['def'];
		$player1['hp'] -= (int)$damege;
		echo($player2['name']."の攻撃!".$player1['name']."は".(int)$damege."のダメージを受けた!<br />");
	}

	$b_time++;
	if($player1['hp'] <= 0){
		echo($player1['name']."は力尽きた。".$player2['name']."の勝利！<br />");
	}else if($player2['hp'] <= 0){
		echo($player2['name']."は力尽きた。".$player1['name']."の勝利！<br />");
	}
	if($b_time > 10000){break;}
}
}
?>