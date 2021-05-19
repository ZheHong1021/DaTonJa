// 設定變數
var usn = document.querySelector('input#usn');
var pwd = document.querySelector('input#pwd');
var submit = document.querySelector('button#submit-login_btn');


submit.addEventListener('click', function(){
	const request = new XMLHttpRequest();
	console.log('username=' + usn.value);
	console.log('password=' + pwd.value);

	request.onload = function(){
		let responseObj = null;
		try{
		responseObj = JSON.parse(request.responseText);
		console.log(responseObj);
		}catch(e){
			console.error('擷取失敗');
		}
		if(responseObj){
			check_login(responseObj);
		}
	}


	var request_data = 'username=' + usn.value +
						'&password=' + pwd.value;
					
	request.open('POST', 'check_login.php');
	request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	request.send(request_data);
});




