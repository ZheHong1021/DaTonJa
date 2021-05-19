<?php
// var_dump($_SESSION);
require_once("php/functions.php");

if(isset($_SESSION['login_user_id'])){
	$datas = get_Single_User($_SESSION['login_user_id']);
	foreach($datas as $data){
	$user_name = $data['name'];
	$user_gender = $data['gender'];
	}
}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- 文字編碼 -->
	<meta charset="UTF-8">

	<!-- 標題 -->
	<title>關於我們</title>

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
							if(empty($user_gender)){
								$gender_color = "";
							}else{
								if ($user_gender == "male"){
									$gender_color = "blue";
								}
								else if($user_gender == "female"){
									$gender_color = "red";
								}
							}
						?>
						<i class='fas fa-child header-user-img' style="color: <?php echo $gender_color; ?>"></i>

			         	</div>

						<!-- User's Name -->
			         	<div class="header-user-box">
							<?php if(!isset($user_name)){
								$login_name = '使用者名稱';
							}else{
								$login_name = $user_name;
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


<h1 class="hot-product-title">
	<i class="fas fa-fire-alt text-danger"></i>
	 	關於我們
	  <i class="fas fa-fire-alt text-danger"></i>
</h1>

<div class="aboutUs_Wrap">
		<div class="aboutUs_Container">
			<div class='aboutUs_Item'>

					<div class='aboutUs_Img'>
					<img src='img/boss02.jpg' >
				</div>

				<div class='aboutUs_Text'>
						<span>BOSS</span>
						<h2>陳君瑋</h2>
						<p><br>一位土生土長的高雄旗山小王子，家裡開早餐店 平常我都在早餐店打工，興趣騎車，最喜歡把車騎到家裏面都裝飾品
						</p>
							<p class="text-center">PS:最喜歡看天峰直播，<i class="fas fa-tooth mx-2" style="font-size: 28px; transform: rotate(-15deg); color:#eee;"></i>忠實牙粉<i class="fas fa-tooth mx-2" style="font-size: 28px; transform: rotate(15deg); color: #eee"></i></p>

				</div>
		</div>
	</div>
</div>




<div class="aboutUs_Wrap">
		<div class="aboutUs_Container">
			<div class='aboutUs_Item'>


				<div class='aboutUs_Text'>
						<span>執行長</span>
						<h2>林哲弘</h2>
						<p><br>正港台南人，全糖飲料+流氓口氣的雙重保護，讓我頭好又壯壯
跑跑專精，code 小達人，騎上GP就是你X再喘、三寶滾一邊
認真負責成績好，腳踏實地的真男人


						</p>

				</div>
				<div class='aboutUs_Img'>
					<img src='img/113376.jpg' >
				</div>
		</div>
	</div>
</div>

<div class="aboutUs_Wrap">
		<div class="aboutUs_Container">
			<div class='aboutUs_Item'>

					<div class='aboutUs_Img'>
					<img src='img/monkey.jpg' >
				</div>

				<div class='aboutUs_Text'>
						<span>財務長</span>
						<h2>邱炫鈞</h2>
						<p><br>苗栗嘴砲王，你講屁話我就嘴你，嘴到你男生變女生，女生變男生，後台絕對有，比地板還硬。

						</p>

				</div>
		</div>
	</div>
</div>

<div class="aboutUs_Wrap">
		<div class="aboutUs_Container">
			<div class='aboutUs_Item'>


				<div class='aboutUs_Text'>
						<span>總經理</span>
						<h2>龔詠鴻</h2>

						<p><br>來自台南歸仁的一位平凡大學生，曾經為神明服務過，專精處理大大小小的社會事，在江湖中，用一招"搖花手"打遍天下，在處理完事情後，以一句:"別愛我，沒結果，除非花手搖過我!"來拯救那些差點走錯路的年輕人。
 <br> <br></p>
 <h5 style="font-weight: bolder;">座右銘：低調做人，高調做事</h5>
<h5 style="font-weight: bolder;">稱號：龔抹聽、高科暖男、陣頭因仔</h5>

				</div>
				<div class='aboutUs_Img'>
					<img src='img/beer.jpg' >
				</div>
		</div>
	</div>
</div>


<div class="aboutUs_Wrap">
		<div class="aboutUs_Container">
			<div class='aboutUs_Item'>

					<div class='aboutUs_Img'>
					<img src='img/bone02.jpg' >
				</div>

				<div class='aboutUs_Text'>
						<span>直播網紅</span>
						<h2>
					陳靖承
					</h2>
					 <!-- <p><br>一個從北部南下求學很普通的大學生 還在練如何掌控繪圖板</p> -->

						<p>【外號】<br>北投骨頭老大、高科蛙人、人體爬蟲、背骨囝仔、寸勁大師<br>

							<p>【成就】<br>shadowverse龍族最強玩家、楓之谷專精七、駕照八次過關、發明BoneSQL、劍道八段(台灣史上第一位破格)、曾幫友人討回債款，牽車第一次上路就撞賓士<br></p>

							<p>【興趣】<br>經典台啤開掛喝(不喝金牌的喔)、OS大師、研究肢體語言、愛好研究日本ACG文化、蝙蝠溝通(能聽見超音波)、高速壓鴨鴨</p>

						<p>【口頭禪】<br>惹到我讓你頭下腳上、小心我把你拿起來旋轉、我是Bad，不是Broken、Scheiße、我瘋起來連我自己都會怕</p>
						<p class="text-center mt-auto"><i class="fas fa-tooth mx-2" style="font-size: 28px; transform: rotate(-15deg); color:#eee;"></i>附註:牙齒完好<i class="fas fa-tooth mx-2" style="font-size: 28px; transform: rotate(15deg); color: #eee"></i></p>

				</div>
		</div>
	</div>
</div>

<!--
<div class="aboutUs_Wrap">
		<div class="aboutUs_Container">
			<div class='aboutUs_Item'>

					<div class='aboutUs_Img'>
					<img src='img/bone01.jpg' >
				</div>

				<div class='aboutUs_Text'>
						<span>直播網紅</span>
						<h2>
					陳靖承
					</h2> -->
					 <!-- <p><br>一個從北部南下求學很普通的大學生 還在練如何掌控繪圖板</p> -->

					<!-- 	<p>【外號】<br>北投骨頭老大、高科蛙人、人體爬蟲、高科皮卡丘、寸勁大師<br>

							<p>【成就】<br>shadowverse龍族最強玩家、楓之谷專精七、駕照八次過關、發明BoneSQL、劍道八段(台灣史上第一位破格)、曾幫友人討回債款<br></p>

							<p>【興趣】<br>經典台啤開掛喝(不喝金牌的喔)、OS大師、研究肢體語言、愛好研究日本ACG文化、蝙蝠溝通(能聽見超音波)、高速壓鴨鴨</p>

						<p>【口頭禪】<br>惹到我讓你頭下腳上、小心我把你拿起來旋轉、我是Bad，不是Broken、Scheiße、我瘋起來連我自己都會怕</p>
						<p class="text-center mt-auto"><i class="fas fa-tooth mx-2" style="font-size: 28px; transform: rotate(-15deg); color:#eee;"></i>附註:牙齒完好<i class="fas fa-tooth mx-2" style="font-size: 28px; transform: rotate(15deg); color: #eee"></i></p>

				</div>
		</div>
	</div>
</div>
 -->

<div class="aboutUs_Wrap">
		<div class="aboutUs_Container">
			<div class='aboutUs_Item'>


				<div class='aboutUs_Text'>
						<span>新進職員</span>
						<h2>背骨電風扇</h2>

						<p>因為會逼逼叫，所以時常被上司們欺負，甚至被丟包在外頭</p>

				</div>
				<div class='aboutUs_Img'>
					<img src='img/fan.jpg' >
				</div>
		</div>
	</div>
</div>

<div class="aboutUs_Wrap">
		<div class="aboutUs_Container">
			<div class='aboutUs_Item'>


				<div class='aboutUs_Text'>
						<span>退休職員</span>
						<h2>剩屍體的電風扇</h2>

						<p>因為會逼逼叫，所以已被拆解</p>

				</div>
				<div class='aboutUs_Img'>
					<img src='img/fan01.jpg' >
				</div>
		</div>
	</div>
</div>
<!--

<div class="aboutUs_Wrap">
		<div class="aboutUs_Container">
			<div class='aboutUs_Item'>

				<div class='aboutUs_Img'>
					<img src='img/123jpg.jpg' >
				</div>

				<div class='aboutUs_Text'>
						<span>總裁</span>
						<h2>葉柏漢</h2>

						<p>胡凱彬直播團隊-老闆，喜歡在公園打太極，強身健骨</p>

				</div>
		</div>
	</div>
</div>
 -->


</body>
<script>
	function logout(){
			var info = confirm('你確定要登出嗎');
			if(info){
				alert('登出成功');
				window.location.href = 'logout.php';
			}
		}
</script>


</html>