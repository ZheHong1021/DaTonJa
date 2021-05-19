
function check_total_sale(){
		var price = document.querySelector('input.input-price');
		var order_number = document.querySelector('input.order_number');;
		price = price.value;
		order_number = order_number.value;

		price = parseInt(price);
		order_number = parseInt(order_number);
		var total = price * order_number;


		var info = confirm('此次交易總金額為$' + total + "，確認無誤則可送出");
		if(info){
			if(order_number > <?php echo $datas_value['amount']; ?>){
				alert('交易失敗，庫存僅剩：' + <?php echo $datas_value['amount']; ?> + "，請重新選購!");
			}
			else{
				// 設定一個新變數紀錄(更新後的庫存量)
				var new_amount = <?php echo $datas_value['amount']; ?> - order_number;

				// 透過切換新頁面的方式重新取得GET，讓PHP可以讀取新的庫存量(JavaScript變數)
				window.location.href= "product_Single.php?product_id=<?php echo $datas_value['product_id'];?>&new_amount=" + new_amount;

				// 最後將最新的庫存量更新到資料庫中
				// <?php update_Order($_GET['product_id'], $_GET['new_amount']); ?>

				alert('交易完成，已成功送出訂單!!');
			}
		}
