<?php
require_once('php/functions.php');

// var_dump($_GET);

/*** 更新 product資料表中的 amount庫存數量 ***/
update_Product_amount($_GET['product_id'], $_GET['new_amount']);


/*** 更新 product_sale資料表中的 sales_number銷售數量 ***/
// 從資料庫中獲得銷售數字
$datas = get_Sales($_GET['product_id']);
foreach ($datas as $data) {
	$order_number = $data['sales_number'];
	// 多寫一個變數來記錄銷售數量的增加
	$order_number += $_GET['order_number'];
}
update_Sales($_GET['product_id'], $order_number);


/*** 訂單銷售總額 ***/
$total_sales = $_GET['total_sales'];

// 設立 order_id
$order_id = date('Y');
echo $order_id . '--->01<br>';


// 將前面的兩個數字給刪除掉=> 20
$order_id = mb_substr($order_id, 2);
echo $order_id . '--->02<br>';

// echo (date('m') . '--->haha<br>');

// $order_id = $order_id . strtoupper(dechex(date('m'))) . date('d') .
// 	substr(time(), -5) . sprintf('d', rand(0, 99));
$order_id = $order_id . date('m') . date('d') .
	substr(time(), -5) . sprintf('d', rand(0, 99));
// echo $order_id . '--->03<br>';





$order_id = mb_substr($order_id, 0, 10);
// echo $order_id . '--->07<br>';

add_Order($order_id, $_GET['product_id'], $_SESSION['login_user_id'], $_GET['order_number'], $total_sales);



$url  = "product_Single.php?product_id=" . $_GET['product_id'];
echo " <script>";
echo "window.location.href = '$url'";
echo "</script>";
