<?php
require_once("php/db.php");
require_once("php/functions.php");
// var_dump($_SESSION);

$datas = get_Single_User($_SESSION['login_user_id']);
foreach ($datas as $data) {
	$user_name = $data['name'];
	$user_gender = $data['gender'];
}

// 先將所有產品的資料匯進來
$datas = get_Single_Product($_GET['product_id']);
foreach ($datas as $data) {
	$data_category_id = $data['category_id'];
}

// 從上方得到了分類id
// echo $data_category_id;

// 最後透過得到的 data_category_id來呼叫函式取得product以及product_category的所有資料
$datas = get_Product($_GET['product_id'], $data_category_id);

// 利用foreach將整個HTML包起來，最後面用 endforeach結束
foreach ($datas as $datas_value) :





	// 如果沒有登入的Session 或者 登入的Session是 False的話
	if (!isset($_SESSION['is_login']) || !$_SESSION['is_login']) {

		// 跳回登入畫面
		header('Location: main.php');
	}




?>

	<!DOCTYPE html>
	<html lang="en">

	<head>
		<!-- 文字編碼 -->
		<meta charset="UTF-8">

		<!-- 標題 -->
		<title><?php echo $datas_value['product_name']; ?></title>

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

		<script src="js/functions.js"></script>
	</head>


	<body>

		<!-- 標頭含LOGO -->
		<div class="header">
			<div class="header_container">

				<!-- LOGO -->
				<div class="logo">
					<a href="<?php if ($_SESSION["is_login"]) {
											echo "dashboard.php";
										} else {
											echo "main.php";
										} ?>">
						<img src="img/header_logo.png">
					</a>
				</div>

				<!-- NavBar -->
				<nav class="navbar navbar-expand-lg nav-box">

					<div class="collapse navbar-collapse" id="navbarSupportedContent">

						<ul class="navbar-nav ml-auto">
							<li class="nav-item">
								<!-- 如果登入的話，回首頁就必須到Dashboard.php -->
								<?php
								if (!isset($_SESSION['is_login']) || !$_SESSION['is_login']) {
									$index = "main.php";
								} else {
									$index = "dashboard.php";
								} ?>

								<a class="nav-link nav-link-font" href="<?php echo $index; ?>">Home</a>
							</li>

							<li class="nav-item">
								<a class="nav-link nav-link-font" href="product.php">產品介紹</a>
							</li>

							<li class="nav-item">
								<a class="nav-link nav-link-font" href="about_Us.php">關於我們</a>
							</li>

							<!-- DropDown-Btn -->
							<li class="nav-item dropdown" style="transition: .7s;">
								<a class="nav-link dropdown-toggle user-Navitem" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

									<!-- Fontawesome's Image -->
									<div style="padding-left: 15px;">
										<i class="fas fa-user fa-3x"></i>

									</div>

									<!-- Under Font -->
									<?php
									if (!isset($_SESSION['is_login']) || !$_SESSION['is_login']) {
										$login = '未登入';
									} else {
										$login = '已登入';
									}
									?>
									<label class="user_font"><?php echo "$login"; ?></label>


								</a>


								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<!-- User's Image -->
									<div class="header-user-box">

										<?php
										if (!isset($user_gender)) {
											$gender_color = "";
										} else {
											if ($user_gender == "male") {
												$gender_color = "blue";
											} else if ($user_gender == "female") {
												$gender_color = "red";
											}
										}
										?>
										<i class='fas fa-child header-user-img' style="color: <?php echo $gender_color; ?>"></i>

									</div>

									<!-- User's Name -->
									<div class="header-user-box">
										<?php if (!isset($_SESSION['login_name'])) {
											$login_name = '使用者名稱';
										} else {
											$login_name = $user_name;
										}

										?>

										<Label class="header-user-name">
											<?php echo $login_name; ?>
										</label>
									</div>

									<div class="dropdown-divider"></div>

									<!-- User's Function -->
									<?php if (!isset($_SESSION['is_login']) || !$_SESSION['is_login']) {
										echo " <a class='dropdown-item' href='login.php'>登入</a>";
									}
									?>


									<a class="dropdown-item" href="signUp.php">註冊</a>

									<!-- 登入時才顯現 -->

									<?php if (!isset($_SESSION['is_login']) || !$_SESSION['is_login']) {
									} else {
										echo
											"<a class='dropdown-item' href='manageMent.php'>使用者管理</a>
			          <a href='shopping.php?user_id={$_SESSION['login_user_id']}' class='dropdown-item cart'>
			          	<i class='fas fa-cart-plus'></i>
			          </a>
			          <div class='dropdown-divider'></div>
			          <a class='dropdown-item' href='#' onclick = logout(this)>登出</a>";
									}  ?>
								</div>
							</li>

						</ul>
					</div>
				</nav>
			</div>
		</div>
		<!-- (End)標頭含LOGO -->




		<!-- 個別產品介紹 -->
		<div class="product_Single">

			<div class="product_Single_card">
				<div class="product_Single_price">
					<h2>Price:
						<input type="text" value="<?php echo $datas_value['price']; ?>" class="input-price" disabled="disabled">
					</h2>
					<h2>庫存數量： <?php echo $datas_value['amount']; ?></h2>
				</div>

				<div class="product_Single_amount">
					<div class="cal_amount">
						<i class="fas fa-minus-square" onclick="go_calc('minus');"></i>
						<input type="text" name='order_number' class="order_number" value=1>
						<i class="fas fa-plus-square" onclick="go_calc('plus');"></i>
					</div>
					<button id='confirm_order'>確定購買</button>
					<a href="product.php?page=<?php echo $_SESSION['page']; ?>"><button>產品頁面</button></a>
				</div>
				<div class="product_Single_Box">
					<h1>
						<span>產品分類</span>
						<label><?php echo $datas_value['category_name']; ?></label>
					</h1>
					<!-- <p>Nike</p> -->
					<img src="<?php echo $datas_value['img_dir'] ?>" alt="">
				</div>

				<div class="product_Single_text">
					<!-- <h1>
				<span>產品分類</span>
				<label>電器</label>
			</h1>		 -->
					<h2 class="product_Single_name"><?php echo $datas_value['product_name']; ?></h2>
					<p><?php echo $datas_value['introduce']; ?></p>
				</div>

			</div>
		</div>
		<!-- (End)個別產品介紹 -->




		<!-- 用 Ajax 將訂單數量=> PHP資料庫把product資料表中的amount減少對應的數量，而product_sale中的sale_number增加 -->

		<!-- <script src="js/product_Single.js"></script> -->

		<script>
			var confirm_order = document.querySelector("button#confirm_order");
			confirm_order.addEventListener("click", function() {
				var price = document.querySelector('input.input-price');
				var order_number = document.querySelector('input.order_number');;
				price = price.value;
				order_number = order_number.value;

				price = parseInt(price);
				order_number = parseInt(order_number);
				var total = price * order_number;
				var info = confirm('此次交易總金額為$' + total + "，確認無誤則可送出");
				if (info) {
					// 如果訂單數量超過庫存量，則交易失敗重新跳回頁面
					if (order_number > <?php echo $datas_value['amount']; ?>) {
						alert('交易失敗，庫存僅剩：' + <?php echo $datas_value['amount']; ?> + "，請重新選購!");
						window.location.href = "product_Single.php?product_id=<?php echo $datas_value['product_id']; ?>";
					} else {
						// 設定一個新變數紀錄(更新後的庫存量)
						var new_amount = <?php echo $datas_value['amount']; ?> - order_number;
						alert("交易完成，已成功送出訂單!!");

						// 透過切換新頁面(check_Order.php)的方式重新取得GET，讓PHP可以讀取新的庫存量(JavaScript變數)
						window.location.href = "check_Order.php?product_id=<?php echo $datas_value['product_id']; ?>&new_amount=" + new_amount + "&order_number=" + order_number + "&total_sales=" + total;

					}
				}

			});
		</script>

	<?php endforeach; ?>
	</body>

	</html>