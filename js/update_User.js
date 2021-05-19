$(document).ready(function(){
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




function go_edit(obj){
	if(obj.empty_update){
		alert('並無更新任何資料');
		window.location.href = 'manageMent.php';
	}

	if(!obj.check_email){
		alert('電子郵件不符合規定 (只能為英文、數字、還必須包含點點(.)跟小老鼠(@))');
		window.location.href = 'manageMent.php';
	}

	if(!obj.check_phone){
		alert('使用者的電話號碼不符合規定 (只能 10個數字)');
		window.location.href = 'manageMent.php';
	}


	if(!obj.check_name){
		alert('使用者的名字是否符合規定 (只能為2~10的英文、數字或者中文)');
		window.location.href = 'manageMent.php';
	}

	if(!obj.check_has_name){
		alert('此名稱已被人使用過了!!');
		window.location.href = 'manageMent.php';
	}

		if(!obj.check_has_phone){
		alert('此電話號碼已被人使用過了!!');
		window.location.href = 'manageMent.php';
	}
		if(!obj.check_has_email){
		alert('此電子信箱已被人使用過了!!');
		window.location.href = 'manageMent.php';
	}



	if(obj.check_ok){
		alert('更新成功');
		window.location.href = 'manageMent.php';
	}
}


$(".edit-btn").click(function(){

	//  擷取輸入框中的資料
	let name = $("input#username").val();
	let phone_number = $("input#phone_number").val();
	let email = $("input#email").val();
	mydata = {name: name, phone_number: phone_number, email: email, gender: check_gender()};
	// console.log(mydata);


    $.ajax({
				url: 'update_User.php',
				// contentType: 'application/json; charset=UTF-8',
				data: mydata,
				type: "POST",
				url: "update_User.php",
        dataType: "json",
        success: function(data)
        {
					console.log(data);
					go_edit(data);


        }
    });


});



function total_edit(){
		var name = document.querySelector('input#username');
		var phone_number = document.querySelector('input#phone_number');
		var email = document.querySelector('input#email');
		name = name.value;
		phone_number = phone_number.value;
		email = email.value;

				const request = new XMLHttpRequest();
				request.onload = function(){
					let responseObj = null
					try{
						responseObj = JSON.parse(request.responseText);
						console.log(responseObj);
					}
					catch(e){
						console.error('擷取錯誤');
					}

					if(responseObj){
						go_edit(responseObj);
					}
				}

				var request_Data = 'name=' + name +
									'&phone_number=' + phone_number +
									'&email=' + email +
									'&gender=' + check_gender();

				console.log($request_Data_confirm_pwd);
				request.open('post', 'update_User.php');
				request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				request.send((request_Data));


	}

});