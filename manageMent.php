<?php

require_once("php/functions.php");
// var_dump($_SESSION);


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- 文字編碼 -->
	<meta charset="UTF-8">

	<!-- 標題 -->
	<title>使用者管理</title>

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


	<!-- Custom Jquery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>


<body>
	<?php
		$datas = get_Single_User($_SESSION['login_user_id']);
		foreach ($datas as $data):
	 ?>
	<!-- 標頭含LOGO -->
	<div class="header">
		<div class="header_container">

			<!-- LOGO -->
			<div class="logo">
				<a href="<?php if($_SESSION["is_login"]){ echo "dashboard.php"; } else{ echo "main.php";} ?>" >
					<img src="img/header_logo.png">
				</a>
				<img src="img/fox-unscreen.gif">
			</div>

			<!-- NavBar -->
			<nav class="navbar navbar-expand-lg nav-box">

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">

			    <ul class="navbar-nav ml-auto">
			      <li class="nav-item">
			      <!-- 如果登入的話，回首頁就必須到Dashboard.php -->
					<?php
					if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']){
					 $index = "main.php";
					} else{
					 $index = "dashboard.php";
					 } ?>

			        <a class="nav-link nav-link-font" href="<?php echo $index; ?>" >Home</a>
			      </li>

			      <li class="nav-item">
			        <a class="nav-link nav-link-font" href="product.php" >產品介紹</a>
			      </li>

			       <li class="nav-item">
			        <a class="nav-link nav-link-font" href="about_Us.php" >關於我們</a>
			      </li>

					<!-- Under Font -->
					<?php
					if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']){
						$login = '未登入';
						$color_login = "#999";
					}else{
						$login = '已登入';
						$color_login = "";
					}
					 ?>

			      <!-- DropDown-Btn -->
			      <li class="nav-item dropdown"  style="transition: .7s;">
			        <a class="nav-link dropdown-toggle user-Navitem" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: <?php echo $color_login ; ?>">




			        <!-- Fontawesome's Image -->
			         <div style="padding-left: 15px;">
			         	<i class="fas fa-user fa-3x" style="color: <?php echo $color_login; ?>;"></i>

			         </div>


			         <label class = "user_font" style="color: <?php echo $color_login; ?>;"><?php echo "$login"; ?></label>


			        </a>


			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			         	<!-- User's Image -->
			         	<div class="header-user-box">

						<?php
							if(!isset($_SESSION['gender'])){
								$gender_color = "";
							}else{
								if ($data["gender"] == "male"){
									$gender_color = "blue";
								}
								else if($data["gender"] == "female"){
									$gender_color = "red";
								}
							}
						?>
						<i class='fas fa-child header-user-img' style="color: <?php echo $gender_color; ?>"></i>

			         	</div>

						<!-- User's Name -->
			         	<div class="header-user-box">
							<?php if(!isset($_SESSION['login_name'])){
								$login_name = '使用者名稱';
							}else{
								$login_name = $data['name'];
							}

							 ?>

			         		<Label class="header-user-name">
								<?php echo $login_name; ?>
			         		</label>
						</div>

			          <div class="dropdown-divider"></div>

			          <!-- User's Function -->
			           <?php if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']){
			         echo " <a class='dropdown-item' href='login.php'>登入</a>";
			         }
			          ?>


			          <a class="dropdown-item" href="signUp.php">註冊</a>

			          <!-- 登入時才顯現 -->

			         <?php if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']){

			         }else{
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


<?php foreach($datas as $data) ?>
<!-- 使用者管理 -->
<div class="wrap-management">
<div class="main-manage">
		<h2>使用者管理</h2>

		<div class="row-manage">
			<div class="co1">
				<div class ="inputBox">
					<input type="text" id='username' disabled="disabled">
					<span class="text">使用者名稱：<?php echo $data['name']; ?></span>
					<span class="line"></span>
					<!-- <button class="btn_test">123</button> -->
					<i class="fas fa-edit" onclick="edit('username')"></i>
				</div>
			</div>
		</div>

		<div class="row-manage">
			<div class="co1">
				<div class ="inputBox">
					<input type="text" id='phone_number' disabled="disabled">
					<span class="text">手機號碼：<?php echo $data['phone_number']; ?></span>
					<span class="line"></span>
					<i class="fas fa-edit" onclick="edit('phone_number')"></i>
				</div>
			</div>
		</div>

		<div class="row-manage">
			<div class="co1">
				<div class ="inputBox">
					<input type="text" id='email'  disabled="disabled">
					<span class="text">電子郵件：<?php echo $data['email']; ?></span>
					<span class="line"></span>
					<i class="fas fa-edit" onclick ="edit('email')"></i>
				</div>
			</div>
		</div>

		<div class="row-manage">
			<div class="gender-box gender-text" style="color: #fff">
					<label class="mr-3">性別：</label>

				<?php
				// 判別哪個被勾選
				$gender = $data['gender'];
				if($gender == 'male'):
					$gender_male = 'checked';
				else:
					$gender_male = '';
				endif;

				if($gender == 'female'):
					$gender_female = 'checked';
				else:
					$gender_female = '';
				endif;

				 ?>

				<div class="custom-control custom-radio custom-control-inline mr-5">

					<input class="form-check-input custom-control-input" type="radio" name="inlineRadioOptions" id="male" value="option1" <?php echo $gender_male; ?>>

					<label class="custom-control-label" for="male">Male</label>
				</div>

				<div class="custom-control custom-radio custom-control-inline radio-div">
					<input class="form-check-input custom-control-input" type="radio" name="inlineRadioOptions" id="female" value="option2" <?php echo $gender_female; ?>>
					<label class="custom-control-label" for="female">Female</label>
				</div>
				</div>
		</div>

		<div class="row-manage">
			<div class="co1 text-center">
				<a href="main.php"><input class="update-btn-gohome mr-3" type="submit" value="回首頁" ></a>
				<!-- <input class="edit-btn ml-3" type="submit" value="修改" onclick="total_edit()"> -->
				<input class="edit-btn ml-3" type="submit" value="修改"">
			</div>
		</div>
	</div>
</div>
<?php endforeach ?>

<script src="js/functions.js"></script>
<script src="js/update_User.js"></script>

<script>



	function logout(){
			var info = confirm('你確定要登出嗎');
			if(info){
				alert('登出成功');
				window.location.href = 'logout.php';
			}
		}

	function edit($object){
		var username = document.querySelector('input#username');
		var phone_number = document.querySelector('input#phone_number');
		var email = document.querySelector('input#email');

		if($object == 'username'){
			username.removeAttribute('disabled');
			phone_number.setAttribute('disabled', 'disabled');
			email.setAttribute('disabled', 'disabled');
			username.classList.remove('disabled');
			phone_number.classList.add('disabled');
			email.classList.add('disabled');
		}
		else if($object == 'phone_number'){
			phone_number.removeAttribute('disabled');
			username.setAttribute('disabled', 'disabled');
			email.setAttribute('disabled', 'disabled');
			phone_number.classList.remove('disabled');
			username.classList.add('disabled');
			email.classList.add('disabled');
		}
		else if($object == 'email'){
			email.removeAttribute('disabled');
			phone_number.setAttribute('disabled', 'disabled');
			username.setAttribute('disabled', 'disabled');
			email.classList.remove('disabled');
			phone_number.classList.add('disabled');
			username.classList.add('disabled');
		}
	}
</script>


</body>
</html>