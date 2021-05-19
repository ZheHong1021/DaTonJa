<?php 
// 呼叫函式庫(functions.php)跟資料庫(db_php)
require_once('php/db.php');
require_once('php/functions.php');

// 帳號或者是電子信箱
$username = isset($_POST['username']) ? $_POST['username'] : "";

// 密碼
$password = isset($_POST['password']) ? $_POST['password'] : "";

// 透過訊息得知資訊
$messages = array();

// 觀察輸入的值
$value = array('username' => $username, 'password' => $password);


// 單一判斷是否存在這個帳號或者電子信箱
$check_single_usn = false;

// 判斷帳號以及密碼是否符合資料庫
$check_has_username = false;


// 判斷上述條件是否都符合，如果符合就登入
$check_ok = false;

// 單一抓取帳號和電子信箱，如果這個為 ture，但下面 $check_has_username同時抓取密碼的 false的話
// 代表密碼錯誤
if(check_has_usn_OR_email($username)){
	$check_single_usn = true;
}else{
	$messages[] = '請確認這個帳號或者電子信箱是否已經註冊';
}


// 從函式庫抓取的 check_username($username) => 當這個帳號和密碼確實在資料庫中，就為true(可登入)
if(check_username_login($username, $password)){
	$check_has_username = true;
}else{
	$messages[] = '密碼錯誤，請重新再試';
}

if($check_single_usn && $check_has_username){
	$check_ok = true;
}


echo json_encode(
	array(	
	'msg' => $messages,
	'check_ok' =>$check_ok,
	'check_single_usn' =>$check_single_usn,
	'check_has_usn' =>$check_has_username,
	'input_value' =>$value
	)
);


 ?>