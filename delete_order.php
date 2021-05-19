<?php 
require_once('php/functions.php');
var_dump($_SESSION);
del_Order($_GET['order_id']);
update_Order($_GET['product_id'], $_GET['order_number']);
// var_dump($_GET);

$url  = "shopping.php?user_id=" . $_SESSION['login_user_id']; 
echo " <script>";
echo "window.location.href = '$url'"; 

echo "</script>";  

 ?>