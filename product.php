<?php
require_once("php/db.php");
require_once("php/functions.php");

// var_dump($_SESSION);

if(isset($_SESSION['login_user_id'])){
	$datas = get_Single_User($_SESSION['login_user_id']);
	foreach($datas as $data){
		$user_name = $data['name'];
		$user_gender = $data['gender'];
	}

}


// var_dump($_GET);

$get_Page = empty($_GET['page']) ? 1 : $_GET['page'] ;
$_SESSION['page'] = $get_Page;
$get_Category_id = empty($_GET['category_id']) ? 0 : $_GET['category_id'] ;
$get_Search_Product = empty($_GET['search_product']) ? "" : $_GET['search_product'] ;



	// 預設 0
	// $page = 1;
	// 如果沒有category_id的話，就是 0，如果有GET則就依照 category_id
	$category_id = empty($_GET['category_id']) ? 0 :  $_GET['category_id'];
	// echo $category_id;

	// 判斷是否有 $get_Category_id 和 $get_Search_Product，就利用 get_Single_Search同時讀取分類跟搜尋產品
	if($get_Category_id != 0 && $get_Search_Product != ""){
		$categories = get_Single_Search($category_id, $get_Search_Product);

	/*** ===換頁處理===  ***/
		// 我們要得到資料庫有幾筆資料( 1.count(*)取出全部資料數量 、 2. as count將得到值用 count來當變數)
		$sql = "SELECT count(*) as count FROM product INNER JOIN product_category ON product.category_id = product_category.category_id WHERE product.category_id = $category_id AND product_name LIKE '%" . $get_Search_Product . "%'";

	}
	// 只有產品搜尋
	elseif($get_Search_Product != "" && $get_Category_id == 0){
		$categories = get_all_Search(8, $get_Search_Product);
		$sql = "SELECT count(*) as count FROM product WHERE product_name LIKE '%" . $get_Search_Product . "%'";
	}

	// 只有讀取分類
	elseif($get_Category_id != 0 && $get_Search_Product == ""){
		$categories = get_Single_Category($category_id);

	/*** ===換頁處理===  ***/
		// 我們要得到資料庫有幾筆資料( 1.count(*)取出全部資料數量 、 2. as count將得到值用 count來當變數)
		$sql = "SELECT count(*) as count FROM product INNER JOIN product_category ON product.category_id = product_category.category_id WHERE product.category_id = $category_id";

	}


	else{
		// limit 8 =>每頁8個產品
		$categories = get_all_Categories(8);

	/*** ===換頁處理===  ***/

		// 我們要得到資料庫有幾筆資料( 1.count(*)取出全部資料數量 、 2. as count將得到值用 count來當變數)
		$sql = "SELECT count(*) as count FROM product INNER JOIN product_category ON product.category_id = product_category.category_id";
	}


		$query = mysqli_query($_SESSION['link'], $sql);

		// 將得到資料剖析(變成陣列)
		$pageRes = mysqli_fetch_assoc($query);

		// 單一取得count(資料總數)
		$count = $pageRes['count'];

		// 每頁顯示數(8筆資料)
		$num = 8;

		$pageCount = ceil($count / $num);

		// 預設頁數 1
		// $page = 1;
		// 如果沒有GET的話，頁數就是 1，如果有GET則就依照 page。
		$page = empty($_GET['page']) ? 1 :  $_GET['page'];

		$offeset = ($page - 1) * $num;


		// 處理上下一頁
		$next = $page + 1;
		$prev = $page - 1;
		if ($prev < 1){
			$prev = 1;
		}

		if($next > $pageCount){
			$next = $pageCount;
		}



?>




<!DOCTYPE html>
<html lang="en">
<head>
	<!-- 文字編碼 -->
	<meta charset="UTF-8">

	<!-- 標題 -->
	<title>產品介紹</title>

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
							if(empty($user_gender) ){
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


<!-- 產品分類按鈕 -->
	<div class="dropdown category-container">
		<button type="button" class="btn btn-success dropdown-toggle" data-toggle = 'dropdown' id ='category'>產品分類    </button>
		<div class="dropdown-menu">
			<!-- Get=> page=1: 從第一頁開始 -->
			<a class="dropdown-item" href="product.php?page=1&category_id=0" id='dropdown_0'>全部</a>
			<a class="dropdown-item" href="product.php?page=1&category_id=1" id='dropdown_1'>電器</a>
			<a class="dropdown-item" href="product.php?page=1&category_id=2" id='dropdown_2'>家具</a>
			<a class="dropdown-item" href="product.php?page=1&category_id=3" id='dropdown_3'>日用品</a>
			<a class="dropdown-item" href="product.php?page=1&category_id=4" id='dropdown_4'>運動用品</a>
			<a class="dropdown-item" href="product.php?page=1&category_id=5" id='dropdown_5'>戶外休閒用品</a>
			<a class="dropdown-item" href="product.php?page=1&category_id=6" id='dropdown_5'>藝品</a>
		</div>
	</div>

		<?php
			if ($get_Category_id == 1){
				$category_name = "電器";
			}else if($get_Category_id == 2){
				$category_name = "家具";
			}else if($get_Category_id == 3){
				$category_name = "日用品";
			}else if($get_Category_id == 4){
				$category_name = "運動用品";
			}else if($get_Category_id == 5){
				$category_name = "戶外休閒用品";
			}else if($get_Category_id == 6){
				$category_name = "藝品";
			}
			else if($get_Category_id == 0){
				$category_name = "全部";
			}

		?>

		<div class="dropdown-txt">
			<h1><?php echo $category_name; ?></h1>
		</div>


	<form class="product-search" method="GET">
<!-- <form class="product-search"  method="GET" target="nm_iframe"> -->
<!-- <div class="product-search"> -->
		<input type="text" name="page" value="1" style="display: none;">
		<input type="text" name="category_id" value="<?php echo $get_Category_id; ?>" style="display: none;">
		<input type="search" name="search_product" id='search'placeholder="Search">
		<button id="search-btn"><i class="fas fa-search"></i></button>

<!-- </div> -->


	</form>
<!-- 在form外面加這行，可以防止form表單刷新；記得在form中填入target="nm_iframe" -->
<!-- <iframe id="id_iframe" name="nm_iframe" style="display:none;"></iframe> -->





<div class="wrap-product">
<?php foreach ($categories as $product): ?>
<!-- <?php  var_dump($product);?> -->

	<div class="container-product">
		<div class="card">
			<div class="imgBox">
				<!-- <img src="img/refrigerator.png" alt=""> -->
				<img src="<?php echo $product['img_dir'] ?>" alt="">
			</div>
			<div class="contentBox">
				<h2>
					<?php echo $product['product_name']; ?>
				</h2>

				<div class="product-price">
					<h3>
						<i class="fas fa-dollar-sign"></i>
						<?php echo $product['price']; ?>
					</h3>
				</div>
				<div class="product-amount">
					<h3>
						剩餘數量:
						<?php echo $product['amount']; ?>
					</h3>
				</div>


	<!-- 買東西跟加入購物車都需要先登入 -->
	<!-- 如果沒登入設定兩個變數紀錄一個字串(no_login)=>在js時，直接取消命令 -->
	<!-- 而如果有登入則設定各自的字串變數 =>在js函式中比較好呼叫 -->
		<?php
		$select_product = "product_Single";
		$select_shopping = 'shopping';

		if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']){
			$select_product = 'no_login';
			$select_shopping = 'no_login';
		}

		?>

		<!-- 透過一個onclick(點擊指令)來呼叫函式並給予變數 -->
<?php if(!isset($_SESSION['is_login']) || !$_SESSION['is_login']){ ?>
		<a onclick="go_login();">Buy Now</a>
<?php }
	else{  ?>
		<a href="product_Single.php?product_id=<?php echo $product['product_id']; ?>">Buy Now</a>
<?php } ?>

		<!-- 依照得到的字串變數，得到相對應的回應 -->
		<script>
			function go_login(){
				alert("請先登入帳號才能使用!!");
				window.location.href = 'login.php';
			}
		</script>

			</div>
		</div>
	</div>

<?php endforeach; ?>
</div>




<?php $get_Category_id = empty($get_Category_id)? '' : '&category_id=' . $get_Category_id ?>
<?php $get_Search_Product = empty($get_Search_Product)? '' : '&search_product=' . $get_Search_Product ?>

<div class="page-change">
	<a href="product.php?page=1<?php echo $get_Category_id . $get_Search_Product;?>" class="go-page">
		<!-- 第一頁 -->
		<i class="fas fa-step-backward"></i>
	</a>

	<a href="product.php?page=<?php echo $prev . $get_Category_id . $get_Search_Product; ?>" class='go-page'>
		<!-- 上一頁 -->
		<i class="fas fa-caret-left"></i>
</a>


	<?php
	// 用迴圈判斷 i <= pageCount(7頁)
	for ($i=1; $i <= $pageCount; $i++) {

		// 得知現在第幾頁
		$page_active = ($page == $i) ? 'active' : '';
		echo
		"<a href='product.php?page=$i"  . $get_Category_id ."' class='page-select' id='$page_active'>$i</a>";

	} ?>

	<a href="product.php?page=<?php echo $next . $get_Category_id . $get_Search_Product;?>" class='go-page'>
		<!-- 下一頁 -->
		<i class="fas fa-caret-right"></i>
	</a>

	<a href="product.php?page=<?php echo $pageCount . $get_Category_id . $get_Search_Product;?>" class='go-page'>
		<!-- 最後一頁 -->
		<i class="fas fa-step-forward"></i>
	</a>


</div>




<script>
	function logout(){
			var info = confirm('你確定要登出嗎');
			if(info){
				alert('登出成功');
				window.location.href = 'logout.php';
			}
		}
</script>


</body>
</html>