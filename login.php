<!DOCTYPE html>
<html lang="zh-TW">

<head>
		<meta charset="utf-8">
		<title>使用者登入</title>
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
</head>



<body>

<div class="container-body">

	<!-- 大標（好看） -->
	<div class="mb-5 text-center">
		<h1 class="badge badge-danger badge-pill mx-2">用</h1>
		<h1 class="badge badge-secondary badge-pill mx-2">戶</h1>
		<h1 class="badge badge-info badge-pill mx-2">登</h1>
		<h1 class="badge badge-success badge-pill mx-2">入</h1>
	</div>
	
	
<form method="POST"  target="nm_iframe">
<div class="wrap-login">	
	<div class="text-center container-login">	
		<h2 class="text-center text-white Login_title">登入</h2>
		<div class="row">
			<div class="col-md-12">
				<div class="py-3" id='usn_div'>

					<!-- 原版 -->
					<input type="text" class="pl-2 mr-2" name="usn" id='usn' placeholder="使用者帳號 / 電子信箱" autocomplete="true">
					<!-- 當 i顯示出來的時候，就新增一個 【 i_change 】的class(margin-left: 30px) -->
					<!-- <input type="text" class="pl-1 mr-2 i_change" name="usn" id='usn' placeholder="請輸入您的帳號或者是電子信箱"> -->
					<i id='usn' style="font-size: 24px;"></i>
				</div>				
			</div>

			<div class="col-md-12">
				<div class="py-3" id='pwd_div'>
					<input type="password" class="pl-2 mr-2" name="pwd" id='pwd' placeholder="使用者密碼">	
					<i id='pwd' style="font-size: 24px;"></i>
				</div>
			</div>
			
			<div class="col-md-12 py-3">
			  <button type="submit" class="btn btn-success" id="submit-login_btn">Submit</button>


			  
			  <a href="main.php"><button type="button" class="btn btn-outline-secondary" id="home-login_btn">Home</button></a>
			</div>

	</div>	
	</div>
</div>
</div>
</form>
<!-- 在form外面加這行，可以防止form表單刷新；記得在form中填入target="nm_iframe" -->
<iframe id="id_iframe" name="nm_iframe" style="display:none;"></iframe>

<script src="js/login.js"></script>
	
</body>


</html>

