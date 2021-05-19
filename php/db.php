<?php 
@session_start();
	$host = 'localhost';
	$usn = 'root';
	$pwd = '123456';
	$my_db = 'project_db';

	$_SESSION['link'] = mysqli_connect($host, $usn, $pwd, $my_db);

	if($_SESSION['link']){
		// echo "資料庫連線成功";
	}else{
		echo "資料庫連線失敗：<br>" . mysqli_connect_error() ;
	}



 ?>