<?php 
require_once('php/functions.php');

$name = "你好";
$phone_number = '0957623579';
$email = '';
$gender = 'female';


$datas = get_Single_User(214);
foreach ($datas as $data) {	
$name_data = empty($name) ? $data['name'] : $name;
$phone_number_data = empty($phone_number) ? $data['phone_number'] : $phone_number;
$email_data = empty($email) ? $data['email'] : $email;
$gender_data = empty($gender) ? $data['gender'] : $gender;
}
echo '1:' . $name_data;
echo '1:' . $phone_number_data;
echo '1:' . $email_data;

// /*
// **更新使用者資料
// */
// function update_User($user_id, $name, $phone, $email, $gender){

// $result = null;
// // $sql = "UPDATE `user` SET `name` = {'$name'}, `phone_number` = {'$phone'}, `email` = {'$email'} WHERE `id` = {'$user_id'}";
// $sql = "UPDATE `user` SET name = '{$name}', phone_number = '{$phone}', email = '{$email}', gender = '{$gender}' WHERE `id` = '{$user_id}'";
// $query = mysqli_query($_SESSION['link'], $sql);
// if($query){
// 	// 如果影響此資料庫的行數的話(true)
// 	if(mysqli_affected_rows($_SESSION['link']) == 1){
// 		$result = true;
// 	}else{
// 		echo "{$sql}資料庫語法錯誤：" . mysqli_error();
// 	}
// }
// return $result;
// }

// update_User(214, $name_data, $phone_number_data, $email_data, $gender_data);





// $datas = get_Hot_Product(); 
// foreach ($datas as $key => $value) {
// 	echo $key . '<br>';	
// 	// echo $value;
// }


// var_dump($_GET);
// echo "<br>";

// $datas = get_Search_Product('冰');
// $datas = get_all_Search(2, '冰');
// $datas = get_all_Search(2, $_GET['search_product']);
// var_dump($datas);



// function get_all_Categories($num){

// // 【Limit專區】
// 	// 我們要得到資料庫有幾筆資料( 1.count(*)取出全部資料數量 、 2. as count將得到值用 count來當變數)
// 	$sql = "select count(*) as count from `product`";
// 	$query = mysqli_query($_SESSION['link'], $sql);

// 	// 將得到資料剖析(變成陣列)
// 	$pageRes = mysqli_fetch_assoc($query);

// 	// 單一取得count(資料總數)
// 	$count = $pageRes['count'];

// 	// 每頁顯示數(4筆資料)
// 	// $num = 4;

// 	// 根據每頁顯示數來求出總頁數
// 	// 無條件進入法(假設 count=25 =>需要7頁)
// 	$pageCount = ceil($count / $num);

// 	// 預設頁數 1
// 	// $page = 1;
// 	// 如果沒有GET的話，頁數就是 1，如果有GET則就依照 page。
// 	$page = empty($_GET['page']) ? 1 :  $_GET['page'];

// 	// select * from product limit 0 , 4  這是第一頁 (0~4)
// 	// select * from product limit 4 , 4  這是第二頁 (5~8)
// 	// select * from product limit 8 , 4  這是第三頁 (9~12)
// 	// select * from product limit 12 , 4 這是第四頁 (13~16)
// 	// select * from product limit 16 , 4 這是第五頁 (17~20)
// 	// select * from product limit 20 , 4 這是第六頁 (21~24)
// 	// select * from product limit 24 , 4 這是第七頁 (25~28)
// 	// 根據總頁數求出偏移量
// 	// $page = 1(假設第一頁) => $offset
// 	$offeset = ($page - 1) * $num;

// 	$datas = [];

// // 全部的產品分類都有
// $sql = "SELECT product.product_id, product_category.category_id, product_category.category_name FROM product INNER JOIN product_category ON product.category_id = product_category.category_id LIMIT " . $offeset . ',' . $num;

// $query = mysqli_query($_SESSION['link'], $sql);

// // 如果請求成功
// 	if($query){
// 		if(mysqli_num_rows($query) > 0){
// 			while ($row = mysqli_fetch_assoc($query)) {
// 				// 將 fecth擷取的資料存到products陣列中
// 				$datas[] = $row;
// 			}
// 		}
// 		// 釋放資料庫查詢到的記憶體
// 		mysqli_free_result($query);
// 	}
// 	else{
// 		echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
// 	}

// 	// 最後回傳結果
// 	return $datas;
// }

// function get_Single_Category($category_id){

// // 【Limit專區】
// 	// 我們要得到資料庫有幾筆資料( 1.count(*)取出全部資料數量 、 2. as count將得到值用 count來當變數)
// 	$sql = "select count(*) as count from `product`";
// 	$query = mysqli_query($_SESSION['link'], $sql);
// 	$pageRes = mysqli_fetch_assoc($query);
// 	$count = $pageRes['count'];
// 	$num = 8;
// 	$pageCount = ceil($count / $num);
// 	$page = empty($_GET['page']) ? 1 :  $_GET['page'];
// 	$offeset = ($page - 1) * $num;

// $datas = [];

// // 單單只有一個產品分類(判別值： WHERE product.category_id = 1 (分類id))
// $sql = "SELECT product.product_id, product_category.category_id, product_category.category_name FROM product INNER JOIN product_category ON product.category_id = product_category.category_id WHERE product.category_id = $category_id LIMIT " . $offeset . ',' . $num;

// $query = mysqli_query($_SESSION['link'], $sql);

// // 如果請求成功
// 	if($query){
// 		if(mysqli_num_rows($query) > 0){
// 			while ($row = mysqli_fetch_assoc($query)) {
// 				// 將 fecth擷取的資料存到products陣列中
// 				$datas[] = $row;
// 			}
// 		}
// 		// 釋放資料庫查詢到的記憶體
// 		mysqli_free_result($query);
// 	}
// 	else{
// 		echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
// 	}

// 	// 最後回傳結果
// 	return $datas;
// }


// // 全部的產品分類都有
// // $sql = "SELECT product.product_id, product_category.category_id, product_category.category_name FROM product INNER JOIN product_category ON product.category_id = product_category.category_id LIMIT " . $offeset . ',' . $num;

// // 單單只有一個產品分類(判別值： WHERE product.category_id = 1 (分類id))
// // $sql = "SELECT product.product_id, product_category.category_id, product_category.category_name FROM product INNER JOIN product_category ON product.category_id = product_category.category_id WHERE product.category_id = 1 LIMIT " . $offeset . ',' . $num;


// // 有limit的所有產品
// // $categories = get_all_Categories(8);

// // 有limit的單一產品
// $categories = get_Single_Category(2);

	
// foreach ($categories as $category) {
// 	echo "product_id：" . $category['product_id'];
// 	echo "  &&    category_id：" . $category['category_id'];
// 	echo "  &&    category_name：" . $category['category_name'];
// 	echo "<br>";
// }


 ?>