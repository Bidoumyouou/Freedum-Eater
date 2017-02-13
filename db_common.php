<?php


$host = "localhost";
if(!$conn = mysqli_connect($host,"root","onnbasira184")){
	die("データベース接続エラー.<br/>");
}

if(!mysqli_select_db($conn,"freedum_eater")){
	die("データベース選択エラー");
}



?>