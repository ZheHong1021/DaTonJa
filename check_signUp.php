<?php 
/* 呼叫其他的 php*/
require_once('php/db.php'); // 資料庫
require_once('php/functions.php'); // 函式庫

$username = isset($_POST['username']) ? $_POST['username'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$confirm_pwd = isset($_POST['confirm_pwd']) ? $_POST['confirm_pwd'] : "";
$usn_name = isset($_POST['usn_name']) ? $_POST['usn_name'] : "";
$phone = isset($_POST['phone']) ? $_POST['phone'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";

$gender_result = isset($_POST['gender']) ? $_POST['gender'] : "";

/*檢查規則設定*/
$check_ok_usn = true;  // 檢查帳號是否有符合要求(只能為 8~20的英文跟數字)
$check_ok_pwd = true;  // 檢查密碼是否有符合要求(只能為 8~20的英文跟數字)
$check_pwd_same = true; // 檢查確認密碼是否跟密碼一致
$check_name = true;  // 檢查使用者的名字是否符合規定 (只能為英文、數字以及中文)
$check_phone = true;  // 檢查使用者的電話號碼是否符合規定 (只能 10個數字)
$check_email = true;  // 檢查電子郵件是否符合規定 (只能為英文、數字、還必須包含點點(.)跟小老鼠(@))
$check_ok = true;		// 最後做一個統整，如果上述的條件都為 true，代表這筆資料可以直接傳入資料庫中，註冊也就完成了
$messages = array();   // 將訊息回傳回去到原本的php中

	/*檢查資料庫中是否已存在這筆資料*/
	$check_has_usn = true; // 檢查是否已經存在於資料庫了 ( true = 不存在(可以使用) ； false = 存在(不可使用) )
	$check_has_name = true;
	$check_has_email = true;

// 正規表達式
/*php : preg_match(string $pattern , string $subject)*/



/*=====帳號設定=====*/

// 帳號跟密碼的正規表達式(只能為 8~20的英文跟數字)
$pattern = '/^[a-zA-a0-9]{8,20}+$/';

// 如果帳號是空值
if(empty($username) || !isset($username)){
	$messages[] = '帳號必須填寫';
}

// 如果輸入的帳號超過8~20，就錯了 (用正規化比較高竿)
// if( mb_strlen($username) < 8 || mb_strlen($username) > 20){
if(!preg_match($pattern, $username)){
	$check_ok_usn = false;
	$messages[] = '帳號必須為在 8~20之間的英文以及數字';}

// check_username($username) 從 functions.php中過來的
// true 代表這筆資料已經有了 ； false 代表這筆資料沒有，所以可以使用
if(!check_username($username)){
	$messages[] = '這個帳號可使用，不在資料庫中';
	$check_has_usn = true;
}else{
	$messages[] = '這個帳號已經有人使用了';
	$check_has_usn = false;
}


/*=====密碼設定=====*/

// 如果密碼是空值
if(empty($password) || !isset($password)){
	$messages[] = '密碼必須填寫';
}
// if( mb_strlen($password) < 8 || mb_strlen($password) > 20){
if(!preg_match($pattern, $password)){
	$check_ok_pwd = false;

	$messages[] = '密碼必須為在 8~20長度的英文以及數字';
}


/*=====確認密碼設定=====*/

// 如果確認密碼是空值
if(empty($confirm_pwd) || !isset($confirm_pwd)){
	$messages[] = '確認密碼必須填寫';
}
// 確認密碼必須跟密碼相同 & 也不能空值 & 然後也要依照密碼的要求(正規畫)
if($password == $confirm_pwd && isset($confirm_pwd) && !empty($confirm_pwd) && preg_match($pattern, $confirm_pwd)){
	$check_pwd_same = true;
}else{
	$check_pwd_same = false;
	$messages[] = '請確認密碼是否一致';
}


/*=====名字設定=====*/

// 如果名字是空值
if(empty($usn_name) || !isset($usn_name)){
	$messages[] = '名字必須填寫';
}
// 名字的正規表達式 (只能為4~12{4,12} 個英文、數字以及中文【 [\x{4e00}-\x{9fa5}] 】)
$pattern_name = '/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{3,12}+$/u';

// 確認名字是否符合規定要求
if(!preg_match($pattern_name, $usn_name)){
	$check_name = false;
	$messages[] = '名字必須為 3~10字元的英文、數字或者中文';
}

// check_username($username) 從 functions.php中過來的
// true 代表這筆資料已經有了 ； false 代表這筆資料沒有，所以可以使用
if(!check_name($usn_name)){
	$messages[] = '這個名字可使用，不在資料庫中';
	$check_has_name = true;
}else{
	$messages[] = '這個名字已經有人使用了';
	$check_has_name = false;
}


/*=====電話號碼設定=====*/

// 如果電話號碼是空值
if(empty($phone) || !isset($phone)){
	$messages[] = '電話號碼必須填寫';
}
// 電話號碼的正規表達式 (只能為10 個數字)
$pattern_phone = '/^[0-9]{10,10}+$/u';
if(!preg_match($pattern_phone, $phone)){
	$messages[] = '這個電話號碼不能使用';
	$check_phone = false;
}

// check_phone($phone) 從 functions.php中過來的
// true 代表這筆資料已經有了 ； false 代表這筆資料沒有，所以可以使用
if(!check_phone($phone)){
	$messages[] = '這個電話號碼可使用，不在資料庫中';
	$check_has_phone = true;
}else{
	$messages[] = '這個電話號碼已經有人使用了';
	$check_has_phone = false;
}


/*=====電子郵件設定=====*/

// 如果電子郵件是空值
if(empty($email) || !isset($email)){
	$messages[] = '電子郵件必須填寫';
}
// 電子郵件的正規表達式
$pattern_email = '/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/';

// 確認電子郵件是否符合規定要求
if(!preg_match($pattern_email, $email)){
	$check_email = false;
	$messages[] = '電子郵件必須只能為英文、數字之外，還要有.跟@';
}

// check_username($username) 從 functions.php中過來的
// true 代表這筆資料已經有了 ； false 代表這筆資料沒有，所以可以使用
if(!check_email($email)){
	$messages[] = '這個電子郵件可使用，不在資料庫中';
	$check_has_email = true;
}else{
	$messages[] = '這個電子郵件已經有人使用了';
	$check_has_email = false;
}


// 上述條件必須都符合才能讓 $check_ok = true (代表註冊程序完成)
if($check_ok_usn && $check_ok_pwd && $check_pwd_same && $check_name && $check_phone && $check_email 
	&& $check_has_usn && $check_has_name && $check_phone && $check_has_email){
	$check_ok = true;
}else{
	$check_ok = false;
}


// 定義一個 $click 代表最後送出的時候，來讓資料庫去接收資料
$click = isset($_POST['click']) ? $_POST['click'] : "";

// 如果為true 將這筆資料傳入資料庫中
if($check_ok && $click === "1"){
	// 從 functions.php中來的 addToDataBase($username, $password, $name, $email, $gender)
	addToDataBase($username, $password, $usn_name, $phone, $email, $gender_result);
}



// 將資訊傳回給 前端 (原版)
echo json_encode(
	array(
		'gender_result' => $gender_result,		
		'check_ok_usn' => $check_ok_usn,
		'check_ok_pwd' => $check_ok_pwd,
		'check_pwd_same' => $check_pwd_same,		
		'check_name' => $check_name,
		'check_phone' => $check_phone,
		'check_email' => $check_email,
		'check_has_usn' => $check_has_usn,
		'check_has_name' => $check_has_name,
		'check_has_phone' => $check_has_phone,
		'check_has_email' => $check_has_email,
		'check_ok' => $check_ok,
		'msg' => $messages
	)
);



 ?>