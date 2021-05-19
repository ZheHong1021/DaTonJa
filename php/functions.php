<?php
require_once('db.php');

/* 【 註冊 】 */

/* 檢查資料庫中是否已經有人使用了這個帳號 */
function check_username($username)
{
	// 宣告要回傳的結果
	$result = null;
	// 查詢語法
	$sql = "SELECT * FROM `user` WHERE `username` = '{$username}'";
	// 用 mysqli_query來去執行資料庫的請求
	// $_SESSION['link'] 從 db.php中取得的
	$query = mysqli_query($_SESSION['link'], $sql);
	// 如果請求成功就執行
	if ($query) {
		// mysqli_num_rows 方法，用來判別執行的語法，看看是否取得的資料再資料庫中存不存在
		if (mysqli_num_rows($query) >= 1) {
			// 如果 >= 1 就代表這筆資料(帳號)已經有人使用了，所以這個帳號不能使用
			$result = true;
		}
		// 釋放資料查詢到的記憶體
		mysqli_free_result($query);
	}

	// 如果錯誤，代表有哪個部分error了。
	else {
		echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
	}

	// 最後回傳結果 (true = 有這個帳號了； false = 代表沒有，也就是可以使用)
	return $result;
}


/* 檢查資料庫中是否已經有人使用了這個名字 */
function check_name($name)
{
	// 宣告要回傳的結果
	$result = null;
	// 查詢語法
	$sql = "SELECT * FROM `user` WHERE `name` = '{$name}'";
	// 用 mysqli_query來去執行資料庫的請求
	// $_SESSION['link'] 從 db.php中取得的
	$query = mysqli_query($_SESSION['link'], $sql);
	// 如果請求成功就執行
	if ($query) {
		// mysqli_num_rows 方法，用來判別執行的語法，看看是否取得的資料再資料庫中存不存在
		if (mysqli_num_rows($query) >= 1) {
			// 如果 >= 1 就代表這筆資料(帳號)已經有人使用了，所以這個名字不能使用
			$result = true;
		}
		// 釋放資料查詢到的記憶體
		mysqli_free_result($query);
	}

	// 如果錯誤，代表有哪個部分error了。
	else {
		echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
	}

	// 最後回傳結果 (true = 有這個帳號了； false = 代表沒有，也就是可以使用)
	return $result;
}

/* 檢查資料庫中是否已經有人使用了這個電話號碼 */
function check_phone($phone)
{
	// 宣告要回傳的結果
	$result = null;
	// 查詢語法
	$sql = "SELECT * FROM `user` WHERE `phone_number` = '{$phone}'";
	// 用 mysqli_query來去執行資料庫的請求
	// $_SESSION['link'] 從 db.php中取得的
	$query = mysqli_query($_SESSION['link'], $sql);
	// 如果請求成功就執行
	if ($query) {
		// mysqli_num_rows 方法，用來判別執行的語法，看看是否取得的資料再資料庫中存不存在
		if (mysqli_num_rows($query) >= 1) {
			// 如果 >= 1 就代表這筆資料(帳號)已經有人使用了，所以這個名字不能使用
			$result = true;
		}
		// 釋放資料查詢到的記憶體
		mysqli_free_result($query);
	}

	// 如果錯誤，代表有哪個部分error了。
	else {
		echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
	}

	// 最後回傳結果 (true = 有這個帳號了； false = 代表沒有，也就是可以使用)
	return $result;
}


/* 檢查資料庫中是否已經有人使用了這個電子郵件 */
function check_email($email)
{
	// 宣告要回傳的結果
	$result = null;
	// 查詢語法
	$sql = "SELECT * FROM `user` WHERE `email` = '{$email}'";
	// 用 mysqli_query來去執行資料庫的請求
	// $_SESSION['link'] 從 db.php中取得的
	$query = mysqli_query($_SESSION['link'], $sql);
	// 如果請求成功就執行
	if ($query) {
		// mysqli_num_rows 方法，用來判別執行的語法，看看是否取得的資料再資料庫中存不存在
		if (mysqli_num_rows($query) >= 1) {
			// 如果 >= 1 就代表這筆資料(帳號)已經有人使用了，所以這個電子郵件不能使用
			$result = true;
		}
		// 釋放資料查詢到的記憶體
		mysqli_free_result($query);
	}

	// 如果錯誤，代表有哪個部分error了。
	else {
		echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
	}

	// 最後回傳結果 (true = 有這個帳號了； false = 代表沒有，也就是可以使用)
	return $result;
}


function addToDataBase($username, $password, $name, $phone, $email, $gender)
{
	$result = null;

	// 用 md5 將密碼加密(以防被人竊取)
	$password = md5($password);

	$sql = "INSERT INTO `user` (`username`, `password`, `name`, `phone_number`, `email`, `gender`) VALUES ('{$username}', '{$password}', '{$name}', '{$phone}', '{$email}', '{$gender}')";

	$query = mysqli_query($_SESSION['link'], $sql);

	if ($query) {
		//使用 mysqli_affected_rows 判別異動的資料有幾筆，基本上只有新增一筆，所以判別是否 == 1
		if (mysqli_affected_rows($_SESSION['link']) == 1) {
			//取得的量大於0代表有資料
			//回傳的 $result 就給 true 代表有該帳號，不可以被新增
			$result = true;
		}
	} else {
		echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
	}
	//回傳結果
	return $result;
}



/* 【 登入 】 */

// 單一找尋是否存在帳號或者電子信箱
function check_has_usn_OR_email($username)
{
	// 宣告要回傳的結果
	$result = null;
	// 查詢語法
	$sql = "SELECT * FROM `user` WHERE `username` = '{$username}' OR `email` = '{$username}'";
	// 用 mysqli_query來去執行資料庫的請求
	// $_SESSION['link'] 從 db.php中取得的
	$query = mysqli_query($_SESSION['link'], $sql);
	// 如果請求成功就執行
	if ($query) {
		// mysqli_num_rows 方法，用來判別執行的語法，看看是否取得的資料再資料庫中存不存在
		if (mysqli_num_rows($query) >= 1) {
			// 如果 >= 1 就代表這筆資料(帳號)已經有人使用了，所以這個帳號不能使用
			$result = true;
		}
		// 釋放資料查詢到的記憶體
		mysqli_free_result($query);
	}

	// 如果錯誤，代表有哪個部分error了。
	else {
		echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
	}

	// 最後回傳結果 (true = 有這個帳號了； false = 代表沒有，也就是可以使用)
	return $result;
}

/* 檢查資料庫中是否已經有人使用了這個帳號或者電子信箱 */
/* 順便檢查是否有這個密碼 */
function check_username_login($username, $password)
{

	// 宣告要回傳的結果
	$result = null;

	// 跟註冊一樣，也要使用 md5來加密密碼，以防被人竊取
	// $password = md5($password);

	// 查詢語法
	$sql = "SELECT * FROM `user` WHERE (`username` = '{$username}' OR `email` = '{$username}') AND `password` = '{$password}'";
	// 用 mysqli_query來去執行資料庫的請求
	// $_SESSION['link'] 從 db.php中取得的
	$query = mysqli_query($_SESSION['link'], $sql);
	// 如果請求成功就執行
	if ($query) {
		// mysqli_num_rows 方法，用來判別執行的語法，看看是否取得的資料再資料庫中存不存在
		if (mysqli_num_rows($query) >= 1) {

			//單一捕捉資料庫的一行，
			$user = mysqli_fetch_assoc($query);

			//來抓取使用者的id
			$_SESSION['login_user_id'] = $user['id'];

			//來抓取使用者的name
			$_SESSION['login_name'] = $user['name'];

			//來抓取使用者的email
			$_SESSION['login_email'] = $user['email'];

			//來抓取使用者的gender
			$_SESSION['gender'] = $user["gender"];

			// 透過 Session來得知使用者已經登入
			$_SESSION['is_login'] = true;

			// 如果 >= 1 就代表這筆資料(帳號)已經有人使用了，所以這個帳號不能使用
			$result = true;
		}
		// 釋放資料查詢到的記憶體
		mysqli_free_result($query);
	}

	// 如果錯誤，代表有哪個部分error了。
	else {
		echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
	}

	// 最後回傳結果 (true = 有這個帳號了； false = 代表沒有，也就是可以使用)
	return $result;
}



/* 【 產品區 】 */
function get_all_products()
{
	// 宣告一個空的陣列來存取資料庫的資料
	$products = array();

	//將查詢語法當成字串，記錄在$sql變數中
	$sql = "SELECT * FROM `product`";

	$query = mysqli_query($_SESSION['link'], $sql);

	// 如果請求成功
	if ($query) {
		if (mysqli_num_rows($query) > 0) {
			while ($row = mysqli_fetch_assoc($query)) {
				// 將 fecth擷取的資料存到products陣列中
				$products[] = $row;
			}
		}
		// 釋放資料庫查詢到的記憶體
		mysqli_free_result($query);
	} else {
		echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
	}

	// 最後回傳結果
	return $products;
}



/* 【 產品分類 Categories 】 */
function get_all_Categories($num)
{

	// 【Limit專區】
	// 我們要得到資料庫有幾筆資料( 1.count(*)取出全部資料數量 、 2. as count將得到值用 count來當變數)
	$sql = "select count(*) as count from `product`";
	$query = mysqli_query($_SESSION['link'], $sql);

	// 將得到資料剖析(變成陣列)
	$pageRes = mysqli_fetch_assoc($query);

	// 單一取得count(資料總數)
	$count = $pageRes['count'];

	// 每頁顯示數(4筆資料)
	// $num = 4;

	// 根據每頁顯示數來求出總頁數
	// 無條件進入法(假設 count=25 =>需要7頁)
	$pageCount = ceil($count / $num);

	// 預設頁數 1
	// $page = 1;
	// 如果沒有GET的話，頁數就是 1，如果有GET則就依照 page。
	$page = empty($_GET['page']) ? 1 :  $_GET['page'];

	// select * from product limit 0 , 4  這是第一頁 (0~4)
	// select * from product limit 4 , 4  這是第二頁 (5~8)
	// select * from product limit 8 , 4  這是第三頁 (9~12)
	// select * from product limit 12 , 4 這是第四頁 (13~16)
	// select * from product limit 16 , 4 這是第五頁 (17~20)
	// select * from product limit 20 , 4 這是第六頁 (21~24)
	// select * from product limit 24 , 4 這是第七頁 (25~28)
	// 根據總頁數求出偏移量
	// $page = 1(假設第一頁) => $offset
	$offeset = ($page - 1) * $num;

	// 全部的產品分類都有
	$sql = "SELECT * FROM product INNER JOIN product_category ON product.category_id = product_category.category_id LIMIT " . $offeset . ',' . $num;

	$query = mysqli_query($_SESSION['link'], $sql);

	// 如果請求成功
	if ($query) {
		if (mysqli_num_rows($query) > 0) {
			while ($row = mysqli_fetch_assoc($query)) {
				// 將 fecth擷取的資料存到products陣列中
				$datas[] = $row;
			}
		}
		// 釋放資料庫查詢到的記憶體
		mysqli_free_result($query);
	} else {
		echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
	}

	// 最後回傳結果
	return $datas;
}



function get_Single_Category($category_id)
{

	// 【Limit專區】
	// 我們要得到資料庫有幾筆資料( 1.count(*)取出全部資料數量 、 2. as count將得到值用 count來當變數)
	$sql = "select count(*) as count from `product`";
	$query = mysqli_query($_SESSION['link'], $sql);
	$pageRes = mysqli_fetch_assoc($query);
	$count = $pageRes['count'];
	$num = 8;
	$pageCount = ceil($count / $num);
	$page = empty($_GET['page']) ? 1 :  $_GET['page'];
	$offeset = ($page - 1) * $num;

	$datas = [];

	// 單單只有一個產品分類(判別值： WHERE product.category_id = 1 (分類id))
	$sql = "SELECT * FROM product INNER JOIN product_category ON product.category_id = product_category.category_id WHERE product.category_id = $category_id LIMIT " . $offeset . ',' . $num;

	$query = mysqli_query($_SESSION['link'], $sql);

	// 如果請求成功
	if ($query) {
		if (mysqli_num_rows($query) > 0) {
			while ($row = mysqli_fetch_assoc($query)) {
				// 將 fecth擷取的資料存到products陣列中
				$datas[] = $row;
			}
		}
		// 釋放資料庫查詢到的記憶體
		mysqli_free_result($query);
	} else {
		echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
	}

	// 最後回傳結果
	return $datas;
}


/* 【 產品分類 Categories 】 */
function get_all_Search($num, $search_product)
{

	// 【Limit專區】
	// 我們要得到資料庫有幾筆資料( 1.count(*)取出全部資料數量 、 2. as count將得到值用 count來當變數)
	$sql = "SELECT count(*) as count from `product` WHERE product_name LIKE '%" . $search_product . "%'";
	$query = mysqli_query($_SESSION['link'], $sql);

	// 將得到資料剖析(變成陣列)
	$pageRes = mysqli_fetch_assoc($query);

	// 單一取得count(資料總數)
	$count = $pageRes['count'];

	// 每頁顯示數(4筆資料)
	// $num = 4;

	// 根據每頁顯示數來求出總頁數
	// 無條件進入法(假設 count=25 =>需要7頁)
	$pageCount = ceil($count / $num);

	// 預設頁數 1
	// $page = 1;
	// 如果沒有GET的話，頁數就是 1，如果有GET則就依照 page。
	$page = empty($_GET['page']) ? 1 :  $_GET['page'];

	// select * from product limit 0 , 4  這是第一頁 (0~4)
	// select * from product limit 4 , 4  這是第二頁 (5~8)
	// select * from product limit 8 , 4  這是第三頁 (9~12)
	// select * from product limit 12 , 4 這是第四頁 (13~16)
	// select * from product limit 16 , 4 這是第五頁 (17~20)
	// select * from product limit 20 , 4 這是第六頁 (21~24)
	// select * from product limit 24 , 4 這是第七頁 (25~28)
	// 根據總頁數求出偏移量
	// $page = 1(假設第一頁) => $offset
	$offeset = ($page - 1) * $num;

	// 全部的產品分類都有
	$sql = "SELECT * FROM product INNER JOIN product_category ON product.category_id = product_category.category_id WHERE product_name LIKE '%" . $search_product . "%' LIMIT " . $offeset . ',' . $num;

	$query = mysqli_query($_SESSION['link'], $sql);

	// 如果請求成功
	if ($query) {
		if (mysqli_num_rows($query) > 0) {
			while ($row = mysqli_fetch_assoc($query)) {
				// 將 fecth擷取的資料存到products陣列中
				$datas[] = $row;
			}
		}
		// 釋放資料庫查詢到的記憶體
		mysqli_free_result($query);
	} else {
		echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
	}

	// 最後回傳結果
	return $datas;
}


function get_Single_Search($category_id, $search_product)
{

	// 【Limit專區】
	// 我們要得到資料庫有幾筆資料( 1.count(*)取出全部資料數量 、 2. as count將得到值用 count來當變數)
	$sql = "SELECT count(*) as count FROM `product` WHERE product.category_id = $category_id AND product_name LIKE '%" . $search_product . "%'";
	$query = mysqli_query($_SESSION['link'], $sql);
	$pageRes = mysqli_fetch_assoc($query);
	$count = $pageRes['count'];
	$num = 8;
	$pageCount = ceil($count / $num);
	$page = empty($_GET['page']) ? 1 :  $_GET['page'];
	$offeset = ($page - 1) * $num;

	$datas = [];

	// 單單只有一個產品分類(判別值： WHERE product.category_id = 1 (分類id))
	$sql = "SELECT * FROM product INNER JOIN product_category ON product.category_id = product_category.category_id WHERE product.category_id = $category_id AND product_name LIKE '%" . $search_product . "%' LIMIT " . $offeset . ',' . $num;

	$query = mysqli_query($_SESSION['link'], $sql);

	// 如果請求成功
	if ($query) {
		if (mysqli_num_rows($query) > 0) {
			while ($row = mysqli_fetch_assoc($query)) {
				// 將 fecth擷取的資料存到products陣列中
				$datas[] = $row;
			}
		}
		// 釋放資料庫查詢到的記憶體
		mysqli_free_result($query);
	} else {
		echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
	}

	// 最後回傳結果
	return $datas;
}





function get_Single_Product($product_id)
{

	// 單單只有一個產品分類(判別值： WHERE product.category_id = 1 (分類id))
	$sql = "SELECT * FROM product WHERE product.product_id = $product_id";

	$query = mysqli_query($_SESSION['link'], $sql);

	// 如果請求成功
	if ($query) {
		if (mysqli_num_rows($query) > 0) {
			while ($row = mysqli_fetch_assoc($query)) {
				// 將 fecth擷取的資料存到products陣列中
				$datas[] = $row;
			}
		}
		// 釋放資料庫查詢到的記憶體
		mysqli_free_result($query);
	} else {
		echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
	}

	// 最後回傳結果
	return $datas;
}


function get_Product($product_id, $category_id)
{

	// 單單只有一個產品分類(判別值： WHERE product.category_id = 1 (分類id))
	$sql = "SELECT * FROM product INNER JOIN product_category ON product.category_id = product_category.category_id WHERE product.product_id = $product_id and product.category_id = $category_id";

	$query = mysqli_query($_SESSION['link'], $sql);

	// 如果請求成功
	if ($query) {
		if (mysqli_num_rows($query) > 0) {
			while ($row = mysqli_fetch_assoc($query)) {
				// 將 fecth擷取的資料存到products陣列中
				$datas[] = $row;
			}
		}
		// 釋放資料庫查詢到的記憶體
		mysqli_free_result($query);
	} else {
		echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
	}

	// 最後回傳結果
	return $datas;
}


/**
 * 更新庫存
 */
function update_Product_amount($product_id, $new_amount)
{
	$result = null;
	$sql = "UPDATE `product` SET
amount = $new_amount WHERE product_id = $product_id";
	$query = mysqli_query($_SESSION['link'], $sql);
	if ($query) {

		// 如果影響此資料庫的行數的話(true)
		if (mysqli_affected_rows($_SESSION['link']) == 1) {
			$result = true;
		} else {
			echo "{$sql}資料庫語法錯誤：" . mysqli_error();
		}
	}
	return $result;
}


/**
 * 得到銷售數量
 */
function get_Sales($product_id)
{

	// 單單只有一個產品分類(判別值： WHERE product.category_id = 1 (分類id))
	$sql = "SELECT * FROM product_sale WHERE product_id = $product_id";

	$query = mysqli_query($_SESSION['link'], $sql);

	// 如果請求成功
	if ($query) {
		if (mysqli_num_rows($query) > 0) {
			while ($row = mysqli_fetch_assoc($query)) {
				// 將 fecth擷取的資料存到products陣列中
				$datas[] = $row;
			}
		}
		// 釋放資料庫查詢到的記憶體
		mysqli_free_result($query);
	} else {
		echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
	}

	// 最後回傳結果
	return $datas;
}



/**
 * 更新銷售數量
 */
function update_Sales($product_id, $order_number)
{
	$result = null;
	$sql = "UPDATE `product_sale` SET
sales_number = $order_number WHERE product_id = $product_id";
	$query = mysqli_query($_SESSION['link'], $sql);
	if ($query) {

		// 如果影響此資料庫的行數的話(true)
		if (mysqli_affected_rows($_SESSION['link']) == 1) {
			$result = true;
		} else {
			echo "{$sql}資料庫語法錯誤：" . mysqli_error();
		}
	}
	return $result;
}


/**
 * 新增訂單
 */
function add_Order($order_id, $product_id, $user_id, $order_number, $total_sale)
{
	$result = null;

	$order_id = (int)$order_id;
	$sql = "INSERT INTO `product_order` (`order_id`, `product_id`, `user_id`, `order_number`, `total_sale`) VALUES ($order_id, '{$product_id}', '{$user_id}', '{$order_number}', '{$total_sale}')";

	$query = mysqli_query($_SESSION['link'], $sql);
	if ($query) {
		//使用 mysqli_affected_rows 判別異動的資料有幾筆，基本上只有新增一筆，所以判別是否 == 1
		if (mysqli_affected_rows($_SESSION['link']) == 1) {
			//取得的量大於0代表有資料
			//回傳的 $result 就給 true 代表有該帳號，不可以被新增
			$result = true;
		}
	} else {
		echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
	}
	//回傳結果
	return $result;
}


/**
 * 得到訂單資料
 */
function get_Order($user_id)
{

	// 單單只有一個產品分類(判別值： WHERE product.category_id = 1 (分類id))
	$sql = "SELECT * FROM (product NATURAL JOIN product_category) NATURAL JOIN product_order WHERE product_order.user_id = $user_id";

	$query = mysqli_query($_SESSION['link'], $sql);

	// 如果請求成功
	if ($query) {
		if (mysqli_num_rows($query) > 0) {
			while ($row = mysqli_fetch_assoc($query)) {
				// 將 fecth擷取的資料存到products陣列中
				$datas[] = $row;
			}
		}
		// 釋放資料庫查詢到的記憶體
		mysqli_free_result($query);
	} else {
		echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
	}

	// 最後回傳結果
	return $datas;
}

/*
**刪除訂單
*/
function del_Order($order_id)
{
	$result = null;
	$sql = "DELETE FROM `product_order` WHERE `order_id` = '{$order_id}'";
	$query = mysqli_query($_SESSION['link'], $sql);
	if ($query) {
		if (mysqli_affected_rows($_SESSION['link']) == 1) {
			$result = true;
		} else {
			echo "{$sql}資料庫語法錯誤：" . mysqli_error();
		}
	}
	return $result;
}


/*
**更新訂單
*/
function update_Order($product_id, $amount)
{
	$result = null;
	$sql = "UPDATE product SET product.amount = product.amount + $amount  WHERE product.product_id = $product_id";
	$query01 = mysqli_query($_SESSION['link'], $sql);
	$sql = "UPDATE product_sale SET product_sale.sales_number = product_sale.sales_number - $amount  WHERE product_sale.product_id = $product_id";
	$query02 = mysqli_query($_SESSION['link'], $sql);
	if ($query01 && $query02) {

		// 如果影響此資料庫的行數的話(true)
		if (mysqli_affected_rows($_SESSION['link']) == 1) {
			$result = true;
		} else {
			echo "{$sql}資料庫語法錯誤：" . mysqli_error();
		}
	}
	return $result;
}




/**
 * 得到熱門產品
 */
function get_Hot_Product()
{

	// 單單只有一個產品分類(判別值： WHERE product.category_id = 1 (分類id))
	$sql = "SELECT * FROM `product_sale` NATURAL JOIN `product`  ORDER BY `sales_number` DESC LIMIT 0, 4";

	$query = mysqli_query($_SESSION['link'], $sql);

	// 如果請求成功
	if ($query) {
		if (mysqli_num_rows($query) > 0) {
			while ($row = mysqli_fetch_assoc($query)) {
				// 將 fecth擷取的資料存到products陣列中
				$datas[] = $row;
			}
		}
		// 釋放資料庫查詢到的記憶體
		mysqli_free_result($query);
	} else {
		echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
	}

	// 最後回傳結果
	return $datas;
}


/**
 * 得到單一使用者
 */
function get_Single_User($user_id)
{


	$sql = "SELECT * FROM `user` WHERE id = '{$user_id}'";

	$query = mysqli_query($_SESSION['link'], $sql);

	// 如果請求成功
	if ($query) {
		if (mysqli_num_rows($query) > 0) {
			while ($row = mysqli_fetch_assoc($query)) {
				// 將 fecth擷取的資料存到products陣列中
				$datas[] = $row;
			}
		}
		// 釋放資料庫查詢到的記憶體
		mysqli_free_result($query);
	} else {
		echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
	}

	// 最後回傳結果
	return $datas;
}
