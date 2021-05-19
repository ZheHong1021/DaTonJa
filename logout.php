<?php 
// 開啟 Session
@session_start();

// 刪除 Session
session_destroy();

// 刪除完後，回到主頁
header("Location: main.php");


 ?>