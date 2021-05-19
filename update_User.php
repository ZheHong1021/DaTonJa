<?php
require_once("php/functions.php");

$name = isset($_POST['name']) ? $_POST['name'] :"";
$phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] :"";
$email = isset($_POST['email']) ? $_POST['email'] :"";
$gender = isset($_POST['gender']) ? $_POST['gender'] :"";




// 確認傳過來的值
$datas = get_Single_User($_SESSION['login_user_id']);


foreach ($datas as $data) :
	$name_data = empty($name) ? $data['name'] : $name;
	$phone_number_data = empty($phone_number) ? $data['phone_number'] : $phone_number;
	$email_data = empty($email) ? $data['email'] : $email;
	$gender_data = $data['gender'];


// 確認修改的資料是否符合資料庫規則
$check_name = true;  // 檢查使用者的名字是否符合規定 (只能為英文、數字以及中文)
$check_phone = true;  // 檢查使用者的電話號碼是否符合規定 (只能 10個數字)
$check_email = true;  // 檢查電子郵件是否符合規定 (只能為英文、數字、還必須包含點點(.)跟小老鼠(@))
$check_ok = true;		// 最後做一個統整，如果上述的條件都為 true，代表這筆資料可以直接更新到資料庫中。


/*檢查資料庫中是否已存在這筆資料(預設沒有存在，代表可以加進去)*/
$check_has_name = true;
$check_has_phone = true;
$check_has_email = true;




/* 看有無更新資料(預設沒有) */
$empty_update = false;

if($name == "" && $phone_number == "" && $email == "" && $gender == $gender_data){
	// 如果完全沒有更改資料
	$empty_update = true;
}

endforeach;

/*=====名字設定=====*/

// 名字的正規表達式 (只能為4~12{4,12} 個英文、數字以及中文【 [\x{4e00}-\x{9fa5}] 】)
$pattern_name = '/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{2,10}+$/u';

// 確認名字是否符合規定要求
if(!preg_match($pattern_name, $name) && $name != ""){
	$check_name = false;
	$messages[] = '名字必須為 2~10字元的英文、數字或者中文';
}

// check_username($username) 從 functions.php中過來的
// true 代表這筆資料已經有了 ； false 代表這筆資料沒有，所以可以使用
if(!check_name($name)){
	$messages[] = '這個名字可使用，不在資料庫中';
	$check_has_name = true;
}else{
	$messages[] = '這個名字已經有人使用了';
	$check_has_name = false;
}


/*=====電話號碼設定=====*/

// 電話號碼的正規表達式 (只能為10 個數字)
$pattern_phone = '/^[0-9]{10,10}+$/u';
if(!preg_match($pattern_phone, $phone_number) && $phone_number != ""){
	$messages[] = '這個電話號碼不能使用';
	$check_phone = false;
}

// check_phone($phone) 從 functions.php中過來的
// true 代表這筆資料已經有了 ； false 代表這筆資料沒有，所以可以使用
if(!check_phone($phone_number)){
	$messages[] = '這個電話號碼可使用，不在資料庫中';
	$check_has_phone = true;
}else{
	$messages[] = '這個電話號碼已經有人使用了';
	$check_has_phone = false;
}


/*=====電子郵件設定=====*/
// 電子郵件的正規表達式
$pattern_email = '/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/';

// 確認電子郵件是否符合規定要求
if(!preg_match($pattern_email, $email) && $email != ""){
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


if($check_phone && $check_name && $check_email && $check_has_email && $check_has_name && $check_has_phone && !$empty_update){
	$check_ok = true;
}else{
	$check_ok = false;
}



/*
**更新使用者資料
*/
function update_User($user_id, $name, $phone, $email, $gender){

$result = null;

$sql = "UPDATE `user` SET name = '{$name}', phone_number = '{$phone}', email = '{$email}', gender = '{$gender}' WHERE `id` = '{$user_id}'";
$query = mysqli_query($_SESSION['link'], $sql);
if($query){
	// 如果影響此資料庫的行數的話(true)
	if(mysqli_affected_rows($_SESSION['link']) == 1){
		$result = true;
	}else{
		echo "{$sql}資料庫語法錯誤：" . mysqli_error();
	}
}
return $result;
}




if($check_ok){
	update_User($_SESSION['login_user_id'], $name_data, $phone_number_data, $email_data, $gender);
}


// 將資訊傳回給 前端 (原版)
echo json_encode(
	array(
		'name' => $name,
		'gender' => $gender,
		'gender_data' => $gender_data,
		'check_name' => $check_name,
		'check_phone' => $check_phone,
		'check_email' => $check_email,
		'check_has_name' => $check_has_name,
		'check_has_phone' => $check_has_phone,
		'check_has_email' => $check_has_email,
		'empty_update' => $empty_update,
		'check_ok' => $check_ok
	)
);

 ?>