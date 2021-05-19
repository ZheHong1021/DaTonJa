
function check_gender(){
	// 預設已經點擊男生了，所以不用擔心有額外問題
	// 假設選到男生，就將透過一個變數回傳給 requestData
	var male = document.querySelector('input#male');
	if(male.checked){
		// alert('male');
		return 'male';
	}else{
		// alert('female');
		return 'female';
	}
}

/* 設定變數 */
			var username = document.querySelector('input#username');
			var password = document.querySelector('input#password');
			var confirm_pwd = document.querySelector('input#confirm_pwd');
			var usn_name = document.querySelector('input#name');
			var phone = document.querySelector('input#phone');
			var email =  document.querySelector('input#email');
			$submit_btn = document.querySelector('button#submit-btn');

			
			/* 帳號的設定條件 */
			username.addEventListener('keyup', function(){
				const request = new XMLHttpRequest();
				console.log('username=' + username.value);
				request.onload = function(){
					let responseObj_usn = null;
					try{
						responseObj_usn = JSON.parse(request.responseText);
						console.log(responseObj_usn);
					}
					catch(e){
						console.error('擷取失敗');
					}
					// 如果 responseObj_keyup有東西，就執行函式
					if(responseObj_usn){
						check_signUp_Single_username(responseObj_usn);
					}
				}
				// 為了讓 check_ok 在每個階段都能被讀取到，所以每個條件都要帶入進去
				var request_data = 'username=' + username.value + 
									'&password=' + password.value + 
									'&confirm_pwd=' + confirm_pwd.value +
									'&usn_name=' + usn_name.value +
									'&phone=' + phone.value +
									'&email=' + email.value +

				request.open('post', 'check_signUp.php');
				request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				request.send(request_data);
			});

			/* 密碼的設定條件 */
			password.addEventListener('keyup', function(){
				const request = new XMLHttpRequest();
				console.log('password=' + password.value);
				request.onload = function(){
					// let 所以這變數只能出現一次
					let responseObj_pwd = null;
					try{
						responseObj_pwd = JSON.parse(request.responseText);
						console.log(responseObj_pwd);
					}
					catch(e){
						console.error('擷取失敗_password');
					}
					// 如果 responseObj_keyup有東西，就執行函式
					if(responseObj_pwd){
						check_signUp_Single_password(responseObj_pwd);
					}
				}
				var request_data = 'username=' + username.value + 
									'&password=' + password.value + 
									'&confirm_pwd=' + confirm_pwd.value +
									'&usn_name=' + usn_name.value +
									'&phone=' + phone.value +
									'&email=' + email.value +
				// console.log(request_data);
				request.open('post', 'check_signUp.php');
				request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				request.send(request_data);
			});

			//  確認密碼的設定條件 
			confirm_pwd.addEventListener('keyup', function(){
				
				const request_confirm_pwd = new XMLHttpRequest();
				console.log('confirm_pwd=' + confirm_pwd.value);
				request_confirm_pwd.onload = function(){
					let responseObj_pwd_same = null;
					try{
						responseObj_pwd_same = JSON.parse(request_confirm_pwd.responseText);
						console.log(responseObj_pwd_same);
					}
					catch(e){
						console.error('擷取錯誤');
					}

					if(responseObj_pwd_same){
						check_pwd_same(responseObj_pwd_same);
					}
				}
				
				var request_Data_confirm_pwd = 'username=' + username.value + 
									'&password=' + password.value + 
									'&confirm_pwd=' + confirm_pwd.value +
									'&usn_name=' + usn_name.value +
									'&phone=' + phone.value +
									'&email=' + email.value +
				// console.log($request_Data_confirm_pwd);
				request_confirm_pwd.open('post', 'check_signUp.php');
				request_confirm_pwd.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				request_confirm_pwd.send((request_Data_confirm_pwd));

			});

			//  確認名字的設定條件 
			usn_name.addEventListener('keyup', function(){
				const request_name = new XMLHttpRequest();
				console.log('usn_name=' + usn_name.value);
				request_name.onload = function(){
					let responseObj_name = null;
					try{
						responseObj_name = JSON.parse(request_name.responseText);
						console.log(responseObj_name);
					}
					catch(e){
						console.error('擷取錯誤_name');
					}

					if(responseObj_name){
						check_name(responseObj_name);
					}
				}
				
				var request_Data_name = 'username=' + username.value + 
									'&password=' + password.value + 
									'&confirm_pwd=' + confirm_pwd.value +
									'&usn_name=' + usn_name.value +
									'&phone=' + phone.value +
									'&email=' + email.value +
				// console.log($request_Data_name);
				request_name.open('post', 'check_signUp.php');
				request_name.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				request_name.send((request_Data_name));
			});
				
			//  確認電話號碼的設定條件 
			phone.addEventListener('keyup', function(){
				const request_phone = new XMLHttpRequest();
				console.log('phone=' + phone.value);
				request_phone.onload = function(){
					let responseObj_phone = null;
					try{
						responseObj_phone = JSON.parse(request_phone.responseText);
						console.log(responseObj_phone);
					}
					catch(e){
						console.error('擷取錯誤_phone');
					}

					if(responseObj_phone){
						check_phone(responseObj_phone);
					}
				}
				
				var request_Data_phone = 'username=' + username.value + 
									'&password=' + password.value + 
									'&confirm_pwd=' + confirm_pwd.value +
									'&usn_name=' + usn_name.value +
									'&phone=' + phone.value +
									'&email=' + email.value;
				// console.log($request_Data_name);
				request_phone.open('post', 'check_signUp.php');
				request_phone.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				request_phone.send((request_Data_phone));
			});


			//  確認電子郵件的設定條件 
			email.addEventListener('keyup', function(){
				const request_email = new XMLHttpRequest();
				console.log('email=' + email.value);
				request_email.onload = function(){
					let requestObj_email = null;
					try{
						requestObj_email = JSON.parse(request_email.responseText);
						console.log(requestObj_email);
					}
					catch(e){
						console.error('擷取錯誤_mail');
					}

					if(requestObj_email){
						check_email(requestObj_email);
					}
				}
				
				var request_Data_email = 'username=' + username.value + 
											'&password=' + password.value + 
											'&confirm_pwd=' + confirm_pwd.value +
											'&usn_name=' + usn_name.value + 
											'&phone=' + phone.value +
											'&email=' + email.value;
				// console.log($request_Data_email);
				request_email.open('post', 'check_signUp.php');
				request_email.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				request_email.send((request_Data_email));
			});



			/*確定程序都 OK時，呼叫資料庫將資訊都載入到資料庫中*/
			$submit_btn.addEventListener('click', function(){
				const request = new XMLHttpRequest();
				request.onload = function(){
					let responseObj = null;					
					// 容錯
					try{
					// 接收從 php中所獲取的資訊
					responseObj = JSON.parse(request.responseText);
					
					// 印出
					console.log(responseObj);
					}catch(e){
						console.error('Could not parse JSON');
					}
					// 如果在 responseObj有正確執行函式的話
					// 所接收到的資訊是 Json型別
					if(responseObj){
						check_SignUp(responseObj);						
					}
				};
				
				

				// click = '1' 來判別已經按下按鈕了
				const requestData = 'username=' + username.value + 
									'&password=' + password.value + 
									'&confirm_pwd=' + confirm_pwd.value +
									'&usn_name=' + usn_name.value +
									'&phone=' + phone.value +
									'&email=' + email.value +
									'&gender=' + check_gender() +									
									'&click=' + '1';
				// console.log(requestData);
				request.open('post', 'check_signUp.php');
				request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				request.send(requestData);
			});



			function check_SignUp(obj){
				if(obj.check_ok){
					alert('註冊成功');

					var info = confirm('親，現在要直接去登入嗎??');
					if(info){
						window.location.href = 'login.php';	
					}else{
						// 成功後跳離這個頁面，重新整理
						window.location.href = 'signUp.php';	
					}

					
				}
				else{
					alert('註冊失敗');	
					check_error_usn();		
					check_error_pwd();
					check_error_confirm_pwd();
					check_error_phone();					
					check_error_email();
					check_error_name();
				}
			}

			// 送出後如果失敗，清除資料
			function clear(){
				username.value = "";
				password.value = "";
				confirm_pwd.value = "";
				usn_name.value = "";
				email.value = "";
			}


		
			function check_error_usn(){
				username.style.border = '3px solid red';
				username.classList.add('ml-4');
				var i_usn = document.querySelector("i#usn");
				i_usn.classList.add('fas');
				i_usn.classList.add('fa-exclamation-circle');
				i_usn.classList.add('has-error');
				i_usn.setAttribute('title', '請確實填寫資料');
			}

			function check_error_pwd(){
				password.style.border = '3px solid red';
				password.classList.add('ml-4');
				var i_pwd = document.querySelector("i#pwd");
				i_pwd.classList.add('fas');
				i_pwd.classList.add('fa-exclamation-circle');
				i_pwd.classList.add('has-error');
				i_pwd.setAttribute('title', '請確實填寫資料');
			}

			function check_error_confirm_pwd(){
				confirm_pwd.style.border = '3px solid red';
				confirm_pwd.classList.add('ml-4');
				var i_confirm_pwd = document.querySelector("i#confirm_pwd");
				i_confirm_pwd.classList.add('fas');
				i_confirm_pwd.classList.add('fa-exclamation-circle');
				i_confirm_pwd.classList.add('has-error');
				i_confirm_pwd.setAttribute('title', '請確實填寫資料');
			}

			function check_error_phone(){
				phone.style.border = '3px solid red';
				phone.classList.add('ml-4');
				var i_phone = document.querySelector("i#phone");
				i_phone.classList.add('fas');
				i_phone.classList.add('fa-exclamation-circle');
				i_phone.classList.add('has-error');
				i_phone.setAttribute('title', '請確實填寫資料');
			}

				function check_error_name(){
				usn_name.style.border = '3px solid red';
				usn_name.classList.add('ml-4');
				var i_name = document.querySelector("i#name");
				i_name.classList.add('fas');
				i_name.classList.add('fa-exclamation-circle');
				i_name.classList.add('has-error');
				i_name.setAttribute('title', '請確實填寫資料');
			}

				function check_error_email(){
				email.style.border = '3px solid red';
				email.classList.add('ml-4');
				var i_email = document.querySelector("i#email");
				i_email.classList.add('fas');
				i_email.classList.add('fa-exclamation-circle');
				i_email.classList.add('has-error');
				i_email.setAttribute('title', '請確實填寫資料');
			}
