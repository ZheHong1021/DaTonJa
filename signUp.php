<?php 
require_once("php/db.php");
// var_dump($_SESSION);
 ?>

<!DOCTYPE html>
<html lang="zh-TW">
	<head>
		<meta charset="utf-8">
		<title>使用者註冊</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- =========================== CSS =========================== -->
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


		<!-- 去擷取函式庫的資料 -->
		<script src="js/functions.js"></script>

	</head>
	<body>
<div class="wrap-signUp">
	
	<!-- 大標（好看） -->
	<div class="mb-1 text-center">
		<h1 class="badge badge-danger badge-pill mx-2" style="">用</h1>
		<h1 class="badge badge-secondary badge-pill mx-2">戶</h1>
		<h1 class="badge badge-pill mx-2" style="background: #f0932b; color: #fff;">註</h1>
		<h1 class="badge badge-success badge-pill mx-2">冊</h1>
	</div>
	<form method="POST" target="nm_iframe">

	
	<div class="container-fluid text-center" id='input_group' style="padding: 20px; background: none">	<div class="row">
				<div class="col-md-12">
				<div class="py-3 d-flex align-items-center justify-content-center" id = 'username-div'>
					
					<input type="text" id='username' class="input-box mr-2" placeholder="請輸入你的帳號" autocomplete="true">	
					<i id ='usn'></i>
	
					<!-- 輸入後(ml-4 mr-2) ，因為會跑版 -->
					<!-- <input type="text" id='username' class="input-box ml-4 mr-2" autocomplete="true" placeholder="Username">
					<i class="fas fa-check-circle has-error"></i> -->
				</div>
				
				<div class="py-3 d-flex align-items-center justify-content-center" id = 'password-div'>
					<!-- 還沒輸入前(mr-2) -->
					<input type="password" id='password' class="input-box mr-2" placeholder="請輸入你的密碼">
					<i id="pwd"></i>
				</div>

				<div class="py-3 d-flex align-items-center justify-content-center" id = 'confirm_password-div'>
					<input type="password" id='confirm_pwd' class="input-box mr-2" placeholder="確認密碼">
					<i id="confirm_pwd"></i>
				</div>

				<div class="py-3 d-flex align-items-center justify-content-center" id = 'confirm_password-div'>
					<input type="phone" id='phone' class="input-box mr-2" placeholder="請輸入手機號碼" autocomplete="true">
					<i id="phone"></i>
				</div>

				<div class="py-3 d-flex align-items-center justify-content-center" id = 'confirm_password-div'>
					<input type="text" id='name' class="input-box mr-2" placeholder="請輸入您的名稱" autocomplete="true">
					<i id="name"></i>
				</div>

				<div class="py-3 d-flex align-items-center justify-content-center" id = 'confirm_password-div'>
					<input type="email" id='email' class="input-box mr-2" placeholder="請輸入電子信箱" autocomplete="true">
					<i id="email"></i>
				</div>

				<div class="gender-box gender-text">
					<label>性別：</label>

				<div class="custom-control custom-radio custom-control-inline">

					<input class="form-check-input custom-control-input" type="radio" name="inlineRadioOptions" id="male" value="option1" checked>

					<label class="custom-control-label" for="male">Male</label>
				</div>

				<div class="custom-control custom-radio custom-control-inline radio-div">
					<input class="form-check-input custom-control-input" type="radio" name="inlineRadioOptions" id="female" value="option2">
					<label class="custom-control-label" for="female">Female</label>
				</div>

				</div>
				

				<div>
					<button type="submit" id="submit-btn" class="mx-3">確認註冊</button>					

					<!-- 如果登入的話，回首頁就必須到Dashboard.php -->
					<?php 
					if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']){
					 $index = "main.php";
					} else{
					 $index = "dashboard.php"; 
					 } ?>

					<a href= <?php echo $index; ?>>
						<button type="button" id="home-btn" class="btn-outline-secondary mx-3">回到首頁</button>
					</a>
				</div>
					</div>
			</div>	
			

		</div>
	</div>
</form>
<!-- 在form外面加這行，可以防止form表單刷新；記得在form中填入target="nm_iframe" -->
<iframe id="id_iframe" name="nm_iframe" style="display:none;"></iframe>

	<!-- 將資料都寫在這個 js檔中，如果想看原本的樣子，可以到 main_copy.php -->
		<script src="js/signUp.js"></script>

	</body>
</html>