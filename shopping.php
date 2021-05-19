<?php 
require_once("php/db.php");
require_once("php/functions.php");
// var_dump($_SESSION);
// var_dump($_GET);
$datas = get_Single_User($_SESSION['login_user_id']);
foreach($datas as $data){
	$user_name = $data['name'];
	$user_gender = $data['gender'];
}

@$datas = get_Order($_GET['user_id']);
// var_dump($datas);



?>




<!DOCTYPE html>
<html lang="en">
<head>
	<!-- 文字編碼 -->
	<meta charset="UTF-8">

	<!-- 標題 -->
	<title>訂單紀錄</title>

	<!-- 相容性 -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<!-- RWD響應式 -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- 網頁的描述 -->
	<meta name="description" content="是在哈囉">


	<!-- =========================== CSS =========================== -->

	<!-- 網頁的title_icon -->
<!-- 	<link rel="shortcut icon" type="text/css" href="img/hello2.png"> -->

	<!-- Boostrap CSS file -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<!-- Font Awesome all.min -->
	<link rel="stylesheet" type="text/css" href="css/all.min.css">

	<!-- Font Awesome.min -->
	<link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">

	<!-- Custom CSS -->
	<link rel="stylesheet" type="text/css" href="css/style.css">


	<!-- =========================== JS =========================== -->

	<!-- JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

	<!-- Popper.js -->
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

	<!-- jQuery -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>


<body>
	<!-- 標頭含LOGO -->
	<div class="header">
		<div class="header_container">
			
			<!-- LOGO -->
			<div class="logo">
				<a href="dashboard.php">
					<img src="img/header_logo.png">
				</a>
				<img src="img/fox-unscreen.gif">
			</div>
	
			<!-- NavBar -->
			<nav class="navbar navbar-expand-lg nav-box">

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			   
			    <ul class="navbar-nav ml-auto">
			      <li class="nav-item">
			        <a class="nav-link nav-link-font" href="dashboard.php" >Home</a>
			      </li>

			      <li class="nav-item">
			        <a class="nav-link nav-link-font" href="product.php" >產品介紹</a>
			      </li>

			       <li class="nav-item">
			        <a class="nav-link nav-link-font" href="about_Us.php" >關於我們</a>
			      </li>

			      <!-- DropDown-Btn -->
			      <li class="nav-item dropdown"  style="transition: .7s;">
			        <a class="nav-link dropdown-toggle user-Navitem" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			        		
			        <!-- Fontawesome's Image -->
			         <div style="padding-left: 15px;">
			         	<i class="fas fa-user fa-3x" ></i>	
			         </div>
					
					<!-- Under Font -->
			         <label class = "user_font">已登入</label>								
			        </a>

			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			         	<!-- User's Image -->
			         	<div class="header-user-box">			         		
			         		<i class="fas fa-child header-user-img"
								style="color: <?php if ($user_gender === "male"){echo "blue";}else{echo "red";}  ?>" 
			         		>			         			
			         		</i>			         		
			         	</div>
						
						<!-- User's Name -->
			         	<div class="header-user-box">
			         		<Label class="header-user-name">
								<?php echo $user_name; ?>
			         		</label>
						</div>

			          <div class="dropdown-divider"></div>

			          <!-- User's Function -->
			       <!--    <a class="dropdown-item" href="#">登入</a> -->
			          <a class="dropdown-item" href="signUp.php">註冊</a>
			          
			          <!-- 登入時才顯現 -->
			          <a class="dropdown-item" href="manageMent.php">使用者管理</a>
			          <a href="shopping.php?user_id=<?php echo $_SESSION['login_user_id']; ?>" class="dropdown-item cart">
			          	<i class="fas fa-cart-plus"></i>
			          </a>
			          <div class="dropdown-divider"></div>
			          <a class="dropdown-item" onclick = logout(this)>登出</a>
			        </div>

			      </li>
			     
			    </ul>			 
			  </div>
			</nav>
		</div>
	</div>
<!-- (End)標頭含LOGO -->


<div class="shopping-container">
	<div class="row">
		<div class="col-md-12">
			<table class="table text-center table-bordered order-table">
				<thead class="table-dark table-head">
					<th>訂單編號</th>
					<th>產品分類</th>
					<th>產品名稱</th>
					<th>訂單數量</th>
					<th>訂單總額</th>		
					<th>下單日期</th>
					<th>管理動作</th>
				</thead>
				<tbody class="table-warning table-body">

			<!-- 如果資料庫中沒有任何一筆資料，就為false -->
			<?php if( !empty($datas)): ?>

					<!-- 接收資料庫的資料($value) -->
				<?php foreach ($datas as $value):?>

				
						<tr>
							<td><?php echo $value['order_id'] ?></td>
							<td><?php echo $value['category_name'] ?></td>
							<td><?php echo $value['product_name'] ?></td>
							<td><?php echo $value['order_number'] ?></td>
							<td><?php echo $value['total_sale'] ?></td>
							<td><?php echo $value['order_date'] ?></td>
							<td>
								<button class="btn btn-danger" id='delete-btn' style='text-align: center;' onclick="delete_order(<?php echo $value['order_id'] ?>, <?php echo $value['product_id'] ?>, <?php echo $value['order_number'] ?>);">刪除訂單</button>					
							
							</td>						
						</tr>
				
				<?php endforeach;?>

			<!-- 如果資料庫中沒有資料時，表格顯示無資料 -->
			<?php else: ?>
				<tr>
					<td colspan="7">無資料</td>
				</tr>
			<?php endif; ?>
			
				</tbody>
			</table>
		</div>
	
</div>




<script>
	function logout(){
			var info = confirm('你確定要登出嗎');
			if(info){
				alert('登出成功');
				window.location.href = 'logout.php';
			}
		}

	function delete_order($order_id, $product_id, $order_number){
		var info = confirm('你確定要刪除此筆訂單嗎');
			if(info){
				alert('刪除成功');
				window.location.href = 'delete_order.php?order_id=' + $order_id + '&product_id=' + $product_id + '&order_number=' + $order_number;
			}
		}
	
</script>	


</body>
</html>