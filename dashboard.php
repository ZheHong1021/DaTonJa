<?php 
require_once("php/functions.php");


// var_dump($_SESSION);

// 如果沒有登入的Session 或者 登入的Session是 False的話
if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']){

	// 跳回登入畫面
	header('Location: main.php');
}

$datas = get_Single_User($_SESSION['login_user_id']);
foreach($datas as $data){
	$user_name = $data['name'];
	$user_gender = $data['gender'];
}

 ?>


<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<!-- 文字編碼 -->
	<meta charset="UTF-8">

	<!-- 標題 -->
	<title>瑋氏企業</title>

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

	


	<!-- =========================== Boostrap =========================== -->

	<!-- JS, Popper.js, and jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
		
	<!-- =========================== (End)Boostrap =========================== -->

	<!-- Custom Jquery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<script src="js/functions.js"></script>
</head>


<body>
	<audio autoplay="autoplay" loop="loop">
		<!-- <source src="img/test.mp3" type="audio/mpeg" /> -->
		<!-- 如果不播放，說明你的瀏覽器不支持！ -->
		<source src="img/AKOG我要做大老闆.mp3" type="audio/mpeg" />
		如果不播放，說明你的瀏覽器不支持！
	</audio>


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
			        <a class="nav-link nav-link-font" href="#about" >關於我們</a>
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



<!-- homepage -->
<div class="wrap-homepage">
   	<div class="carousel slide" data-ride="carousel" id="carousel-demo">
        <ol class="carousel-indicators">
          <li data-target="#carousel-demo" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-demo" data-slide-to="1"></li>
			<li data-target="#carousel-demo" data-slide-to="2"></li>
			<li data-target="#carousel-demo" data-slide-to="3"></li>
			<li data-target="#carousel-demo" data-slide-to="4"></li>
        </ol>
      <div class="carousel-inner">
        <div class="carousel-item active homepage">
         <img class="d-block" src="img/bone01.jpg" alt="">
        </div>

        <div class="carousel-item homepage">
         <img class="d-block" src="img/beer.jpg" alt="">
        </div>

        <div class="carousel-item homepage">
         <img class="d-block" src="img/boss.jpg" alt="">
        </div>

          <div class="carousel-item homepage">
         <img class="d-block" src="img/monkey.jpg" alt="">
        </div>

          <div class="carousel-item homepage">
        <img class="d-block" src="img/113375.jpg" alt="">
        </div>

      </div>
   	 </div>
</div>





<!-- 熱門產品介紹 -->
<h1 class="hot-product-title">
	<i class="fas fa-fire-alt text-danger"></i>
	  熱銷產品  
	  <i class="fas fa-fire-alt text-danger"></i>
</h1>

<?php $datas = get_Hot_Product(); ?>
<?php foreach ($datas as $key => $value): ?>
	<div class="hot-product_wrap">
		<div class="hot-product_container">	
			<div class='hot-product_item'>
	
					<?php if($key % 2 == 0){
						echo "<div class='hot-product_pic'>
					<img src='" . $value['img_dir'] . "' >
				</div>

				<div class='hot-product_txt'>
						<h1>熱銷產品 TOP " . ($key+1) . "</h1>
						<span>熱銷量：" . $value['sales_number'] . "</span>
						<h2>" . $value['product_name'] . "</h2>
						<h6>" . $value['introduce'] . "</h6>
						<p>Price：$" . $value['price'] ."</p>
						<a href='product_Single.php?product_id=" . $value['product_id'] . "'>More</a>

				</div>";
					}else{ 
						echo "<div class='hot-product_txt'>
						<h1>熱銷產品 TOP " . ($key+1) . "</h1>
						<span>熱銷量：" . $value['sales_number'] . "</span>
						<h2>" . $value['product_name'] . "</h2>
						<h6>" . $value['introduce'] . "</h6>
						<p>Price：$" . $value['price'] ."</p>
						<a href='product_Single.php?product_id=" . $value['product_id'] . "'>More</a>
						</div>

						<div class='hot-product_pic'>
							<img src='" . $value['img_dir'] . "' >
						</div>	";
					}

			
?>
		
		</div>
	</div>
</div>

<?php endforeach; ?>
<!-- (End) 熱門產品介紹 -->



<!-- 頁尾部分 -->
<div class="footer">
	<div class="container footer-container">
		<h1 class="hot-product-title" style="margin-bottom: 20px; font-size: 26px;">
			<i class="fas fa-fire-alt text-danger"></i>
			  關於我們 
			  <i class="fas fa-fire-alt text-danger"></i>
		</h1>
			<div class="row">
				<div class="col-4 footer-txt">
					<h2>公司理念</h2>
					<div class="hr-line">
						<hr class="footer-h2-hr">
					</div>
					<p>公司貨都真品，假一賠十，誠信至上</p>
					<p></p>
				</div>

				<div class="col-4 footer-txt footer-img">
					
					<!-- 關於我們 -->
		<div class="container-about" id='about'>
	   	<div class="carousel slide" data-ride="carousel" id="carousel-demo">
<!-- 	        <ol class="carousel-indicators">
	          <li data-target="#carousel-demo" data-slide-to="0" class="active"></li>
	          <li data-target="#carousel-demo" data-slide-to="1"></li>
	          <li data-target="#carousel-demo" data-slide-to="2"></li>
	          <li data-target="#carousel-demo" data-slide-to="3"></li>
	          <li data-target="#carousel-demo" data-slide-to="4"></li>
	        </ol> -->
	    <div class="carousel-inner">
	        <div class="carousel-item active">
	          <a href="about_Us.php"><img class="d-block about-img" src="img/monkey.jpg" alt=""></a>
	        </div>
	        <div class="carousel-item">
	          <a href="about_Us.php"><img class="d-block about-img" src="img/beer.jpg" alt=""></a>
	        </div>
	        <div class="carousel-item">
	          <a href="about_Us.php"><img class="d-block about-img" src="img/bone01.jpg" alt=""></a>
	        </div>
	        <div class="carousel-item">
	          <a href="about_Us.php"><img class="d-block about-img" src="img/fan01.jpg" alt=""></a>
	        </div>
	        <div class="carousel-item">
	          <a href="about_Us.php"><img class="d-block about-img" src="img/boss02.jpg" alt=""></a>
	        </div>
	      </div>
	   	 </div>
		</div>

</div>
<!-- (End) 關於我們 -->
				<div class="col-4 footer-txt">
					<h2>聯絡資訊</h2>
					<div class="hr-line">
						<hr class="footer-h2-hr">
					</div>
					
					<p>C107118210 邱炫鈞</p>
					<p>C107118213 龔詠鴻</p>
					<p>C107118227 陳靖承</p>
					<p>C107118216 林哲弘</p>
					<p>C107118240 陳君瑋</p>
				</div>
			</div>		

			<p class="copyright">&copy; 瑋氏企業團隊版權所有</p>	
		</div>
	</div>

<!-- (End)頁尾部分 -->



</body>

</html>