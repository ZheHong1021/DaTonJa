/*
===product_Single.php中的 + -===
*/

function go_calc($select){
		var order = document.querySelector("input.order_number");
		var order_number = order.value;
		// alert(order.value);
		if($select == 'plus'){	
			order_number = parseInt(order_number);
			order_number += 1;			
			order.value = order_number;
			// alert(typeof(order_number));
			
		}else if($select == 'minus'){
			order_number = parseInt(order_number);
			order_number -= 1;
			if(order_number <= 0){
				order_number = 1;
			}
			order.value = order_number;
		}

	}

/*
===登出===
*/
	function logout(){
			var info = confirm('你確定要登出嗎');
			if(info){
				alert('登出成功');
				window.location.href = 'logout.php';
			}
		}


/*
===登入===
*/
	function check_login(obj){
	
	// 如果帳號密碼都正確
	if(obj.check_ok){
		alert('登入成功');

	// 登入成功跳到後台(dashboard.php)
		window.location.href = 'dashboard.php';
	}
	else {
		alert("登入失敗");
	

/*=== 帳號 & 電子郵件 ===*/

// 	沒有這個帳號或電子郵件
	if(!obj.check_single_usn){
		usn.style.border = '3px solid red';
		usn.classList.add('i_change');
		var img = document.querySelector('i#usn');
		img.classList.add('fas');
		img.classList.add('fa-exclamation-circle');
		img.classList.add('has-error');

		//如果帳號是空的話
		if(usn.value === ''){
			img.setAttribute('title', '請確實輸入帳號或者電子信箱');
		}else{
			img.setAttribute('title', '請確認這個帳號或電子信箱是否有註冊!');
		}
		
	}
// 當帳號正確
	else{
		var img = document.querySelector('i#usn');
		usn.style.border = '3px solid black';	
		usn.classList.remove('i_change');
		img.classList.remove('fas');
		img.classList.remove('fa-exclamation-circle');
		img.classList.remove('has-error');		
	}


// === 密碼 ===

	// 當帳號跟電子郵件沒問題，這邊處理密碼問題
	if(!obj.check_has_usn){
		pwd.style.border = '3px solid red';
		pwd.classList.add('i_change');
		var img = document.querySelector('i#pwd');
		img.classList.add('fas');
		img.classList.add('fa-exclamation-circle');
		img.classList.add('has-error');

		//如果密碼是空的話
		if(pwd.value === ''){
			img.setAttribute('title', '請確實輸入密碼');
		}else{
			img.setAttribute('title', '密碼錯誤，請再試一次!');
		}
		
	}
		// 當密碼正確
	else{
		var img = document.querySelector('i#pwd');		
		usn.style.border = '3px solid black';
		pwd.classList.remove('i_change');
		img.classList.remove('fas');
		img.classList.remove('fa-exclamation-circle');
		img.classList.remove('has-error');		
	}
}
}



/*
===註冊===
*/

/*==========帳號==========*/
function check_signUp_Single_username(obj){				

		// 如果輸入的長度有 8~20且都是為數字跟英文單字，就 correct  && 這個帳號必須沒有存在於資料庫中
		if(obj.check_ok_usn && obj.check_has_usn){	
			username.style.border = '3px solid green';
			username.classList.add('ml-4');
			// 如果新建一個的話，會跑出很多個，所以我先設一個空的 【i】之後再去做新增、刪除 Class
			var img = document.querySelector("i#usn");

			// 當從 錯誤 => 正確時，將錯誤的 class去除，再把 正確的 class新增進去
			img.classList.remove('fas');
			img.classList.remove('fa-exclamation-circle');
			img.classList.remove('has-error');

			img.classList.add('fas');
			img.classList.add('fa-check-circle');
			img.classList.add('has-correct');
			img.setAttribute('title', '這個帳號可以使用');
			// 所有東西都弄好了，最後把它加上去
			username.parentNode.appendChild(img);

			// check_ok => 當輸入框都符合要求時會是 true
			if(obj.check_ok){
				// 正確時能按註冊
				$submit_btn.removeAttribute('disabled');
			}else{
				$submit_btn.setAttribute('disabled' , 'disabled');
			}
			
		}

		// 如果輸入的長度沒有 8~20，就 error
		else{
			username.style.border = '3px solid red';
			username.classList.add('ml-4');
			// 如果新建一個的話，會跑出很多個，所以我先設一個空的 【i】之後再去做新增、刪除 Class
			// const img = document.createElement("i");

			var img = document.querySelector("i#usn");

			// 當從 錯誤 => 正確時，將錯誤的 class去除，再把 正確的 class新增進去
			img.classList.remove('fas');
			img.classList.remove('fa-exclamation-circle');
			img.classList.remove('has-correct');

			img.classList.add('fas');
			img.classList.add('fa-exclamation-circle');
			img.classList.add('has-error');	


			// 說明文字
			if(!obj.check_ok_usn){
				img.setAttribute('title', '帳號必須為在8~20字元長度的英文或者數字');
			}
			if(!obj.check_has_usn){
				img.setAttribute('title', '這個帳號已經有人使用了');
			}

			username.parentNode.appendChild(img);

			// 一開始就錯了，所以設定為不能點擊
			$submit_btn.setAttribute('disabled', 'disabled');
				
				}
			}

/*==========密碼==========*/
function check_signUp_Single_password(obj){			

		// 如果輸入的長度有 8~20，就 correct
		if(obj.check_ok_pwd){
			password.style.border = '3px solid green';
			password.classList.add('ml-4');
			// 如果新建一個的話，會跑出很多個，所以我先設一個空的 【i】之後再去做新增、刪除 Class
			var img = document.querySelector("i#pwd");

			// 當從 錯誤 => 正確時，將錯誤的 class去除，再把 正確的 class新增進去
			img.classList.remove('fas');
			img.classList.remove('fa-exclamation-circle');
			img.classList.remove('has-error');

			img.classList.add('fas');
			img.classList.add('fa-check-circle');
			img.classList.add('has-correct');
			
			img.setAttribute('title', '這個密碼可以使用');
			password.parentNode.appendChild(img);

			// check_ok => 當輸入框都符合要求時會是 true
			if(obj.check_ok){
				// 正確時能按註冊
				$submit_btn.removeAttribute('disabled');
			}else{
				// 錯誤時不能按註冊
				$submit_btn.setAttribute('disabled' , 'disabled');
			}
		}

		// 如果輸入的長度沒有 8~20，就 error
		else{
			password.style.border = '3px solid red';
			password.classList.add('ml-4');
			// 如果新建一個的話，會跑出很多個，所以我先設一個空的 【i】之後再去做新增、刪除 Class
			// const img = document.createElement("i");

			var img = document.querySelector("i#pwd");

			// 當從 錯誤 => 正確時，將錯誤的 class去除，再把 正確的 class新增進去
			img.classList.remove('fas');
			img.classList.remove('fa-exclamation-circle');
			img.classList.remove('has-correct');

			img.classList.add('fas');
			img.classList.add('fa-exclamation-circle');
			img.classList.add('has-error');
			img.setAttribute('title', '密碼必須為在8~20字元長度的英文或者數字');
			password.parentNode.appendChild(img);


			// 一開始就錯了，所以設定為不能點擊
			$submit_btn.setAttribute('disabled', 'disabled');
					
		}
	}


/* ======確認密碼跟密碼一致====== */
function check_pwd_same(obj){
	if(obj.check_pwd_same){

			confirm_pwd.style.border = '3px solid green';
			confirm_pwd.classList.add('ml-4');
			// 如果新建一個的話，會跑出很多個，所以我先設一個空的 【i】之後再去做新增、刪除 Class
			var img = document.querySelector("i#confirm_pwd");

			// 當從 錯誤 => 正確時，將錯誤的 class去除，再把 正確的 class新增進去
			img.classList.remove('fas');
			img.classList.remove('fa-exclamation-circle');
			img.classList.remove('has-error');

			img.classList.add('fas');
			img.classList.add('fa-check-circle');
			img.classList.add('has-correct');
			
			img.setAttribute('title', '確認密碼完成');
			confirm_pwd.parentNode.appendChild(img);

			// check_ok => 當輸入框都符合要求時會是 true
			if(obj.check_ok){
				// 正確時能按註冊
				$submit_btn.removeAttribute('disabled');
			}else{
				// 錯誤時不能按註冊
				$submit_btn.setAttribute('disabled' , 'disabled');
			}
	}
	else{
			confirm_pwd.style.border = '3px solid red';
			confirm_pwd.classList.add('ml-4');
			// 如果新建一個的話，會跑出很多個，所以我先設一個空的 【i】之後再去做新增、刪除 Class
			// const img = document.createElement("i");

			var img = document.querySelector("i#confirm_pwd");

			// 當從 錯誤 => 正確時，將錯誤的 class去除，再把 正確的 class新增進去
			img.classList.remove('fas');
			img.classList.remove('fa-exclamation-circle');
			img.classList.remove('has-correct');

			img.classList.add('fas');
			img.classList.add('fa-exclamation-circle');
			img.classList.add('has-error');
			img.setAttribute('title', '請確認密碼是否一致');
			confirm_pwd.parentNode.appendChild(img);


			// 一開始就錯了，所以設定為不能點擊
			$submit_btn.setAttribute('disabled', 'disabled');
					
		}
}



/* ======確認名字是否符合規則====== */
function check_name(obj){
	if(obj.check_name && obj.check_has_name){

			usn_name.style.border = '3px solid green';
			usn_name.classList.add('ml-4');
			// 如果新建一個的話，會跑出很多個，所以我先設一個空的 【i】之後再去做新增、刪除 Class
			var img = document.querySelector("i#name");

			// 當從 錯誤 => 正確時，將錯誤的 class去除，再把 正確的 class新增進去
			img.classList.remove('fas');
			img.classList.remove('fa-exclamation-circle');
			img.classList.remove('has-error');

			img.classList.add('fas');
			img.classList.add('fa-check-circle');
			img.classList.add('has-correct');
			
			img.setAttribute('title', '這個名字可以使用');
			usn_name.parentNode.appendChild(img);

			// check_ok => 當輸入框都符合要求時會是 true
			if(obj.check_ok){
				// 正確時能按註冊
				$submit_btn.removeAttribute('disabled');
			}else{
				// 錯誤時不能按註冊
				$submit_btn.setAttribute('disabled' , 'disabled');
			}
	}
	else{
			usn_name.style.border = '3px solid red';
			usn_name.classList.add('ml-4');
			// 如果新建一個的話，會跑出很多個，所以我先設一個空的 【i】之後再去做新增、刪除 Class
			// const img = document.createElement("i");

			var img = document.querySelector("i#name");

			// 當從 錯誤 => 正確時，將錯誤的 class去除，再把 正確的 class新增進去
			img.classList.remove('fas');
			img.classList.remove('fa-exclamation-circle');
			img.classList.remove('has-correct');

			img.classList.add('fas');
			img.classList.add('fa-exclamation-circle');
			img.classList.add('has-error');

			if(!obj.check_name){
				img.setAttribute('title', '名字只能是含有3~12字元長度的中英文以及數字');
			}
			if(!obj.check_has_name){
				img.setAttribute('title', '這個名字已經有人使用了');
			}

			usn_name.parentNode.appendChild(img);


			// 一開始就錯了，所以設定為不能點擊
			$submit_btn.setAttribute('disabled', 'disabled');
					
		}
}


/* ======確認電話號碼是否符合規則====== */
function check_phone(obj){
	if(obj.check_phone && obj.check_has_phone){

			phone.style.border = '3px solid green';
			phone.classList.add('ml-4');
			// 如果新建一個的話，會跑出很多個，所以我先設一個空的 【i】之後再去做新增、刪除 Class
			var img = document.querySelector("i#phone");

			// 當從 錯誤 => 正確時，將錯誤的 class去除，再把 正確的 class新增進去
			img.classList.remove('fas');
			img.classList.remove('fa-exclamation-circle');
			img.classList.remove('has-error');

			img.classList.add('fas');
			img.classList.add('fa-check-circle');
			img.classList.add('has-correct');
			
			img.setAttribute('title', '這個電話號碼可以使用');
			phone.parentNode.appendChild(img);

			// check_ok => 當輸入框都符合要求時會是 true
			if(obj.check_ok){
				// 正確時能按註冊
				$submit_btn.removeAttribute('disabled');
			}else{
				// 錯誤時不能按註冊
				$submit_btn.setAttribute('disabled' , 'disabled');
			}
	}
	else{
			phone.style.border = '3px solid red';
			phone.classList.add('ml-4');
			// 如果新建一個的話，會跑出很多個，所以我先設一個空的 【i】之後再去做新增、刪除 Class
			// const img = document.createElement("i");

			var img = document.querySelector("i#phone");

			// 當從 錯誤 => 正確時，將錯誤的 class去除，再把 正確的 class新增進去
			img.classList.remove('fas');
			img.classList.remove('fa-exclamation-circle');
			img.classList.remove('has-correct');

			img.classList.add('fas');
			img.classList.add('fa-exclamation-circle');
			img.classList.add('has-error');

			if(!obj.check_phone){
				img.setAttribute('title', '電話號碼只能為10字元長度的數字');
			}
			if(!obj.check_has_phone){
				img.setAttribute('title', '這個電話號碼已經有人使用了');
			}
			phone.parentNode.appendChild(img);


			// 一開始就錯了，所以設定為不能點擊
			$submit_btn.setAttribute('disabled', 'disabled');
					
		}
}


/* ======確認電子郵件是否符合規則====== */
function check_email(obj){
	if(obj.check_email && obj.check_has_email){
			email.style.border = '3px solid green';
			email.classList.add('ml-4');
			// 如果新建一個的話，會跑出很多個，所以我先設一個空的 【i】之後再去做新增、刪除 Class
			var img = document.querySelector("i#email");

			// 當從 錯誤 => 正確時，將錯誤的 class去除，再把 正確的 class新增進去
			img.classList.remove('fas');
			img.classList.remove('fa-exclamation-circle');
			img.classList.remove('has-error');

			img.classList.add('fas');
			img.classList.add('fa-check-circle');
			img.classList.add('has-correct');
			
			img.setAttribute('title', '這個電子信箱可以註冊');
			email.parentNode.appendChild(img);

			// check_ok => 當輸入框都符合要求時會是 true
			if(obj.check_ok){
				// 正確時能按註冊
				$submit_btn.removeAttribute('disabled');
			}else{
				// 錯誤時不能按註冊
				$submit_btn.setAttribute('disabled' , 'disabled');
			}
	}
	else{
			email.style.border = '3px solid red';
			email.classList.add('ml-4');
			// 如果新建一個的話，會跑出很多個，所以我先設一個空的 【i】之後再去做新增、刪除 Class
			// const img = document.createElement("i");

			var img = document.querySelector("i#email");

			// 當從 錯誤 => 正確時，將錯誤的 class去除，再把 正確的 class新增進去
			img.classList.remove('fas');
			img.classList.remove('fa-exclamation-circle');
			img.classList.remove('has-correct');

			img.classList.add('fas');
			img.classList.add('fa-exclamation-circle');
			img.classList.add('has-error');
			if(!obj.check_email){
				img.setAttribute('title', '電子信箱必須含有英文、數字以及@和.');
			}
			if(!obj.check_has_email){
				img.setAttribute('title', '這個電子信箱已經有人使用了');
			}
			email.parentNode.appendChild(img);


			// 一開始就錯了，所以設定為不能點擊
			$submit_btn.setAttribute('disabled', 'disabled');
					
		}
}






// 錨點特效
		$(function() {
 $('a[href*="#"]:not([href="#"])').click(function() {
  if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname && this.hash.slice(1) != 'top') {
    var target = $(this.hash);
    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
    if (target.length) {
   $('html, body').animate({
     scrollTop: target.offset().top
   }, 1000);
   return false;
    }
  }
 });
});






