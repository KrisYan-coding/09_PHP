
<pre>
<?php 

	header('Content-Type: application/json');
	// 設定 server 回應的 header 的資料格式
	// 空格、大小寫要一致
	// content type = MIME type
	// 英文拼錯會自動將回應的資料下載

	echo json_encode($_POST, JSON_UNESCAPED_UNICODE); // 編碼成 JSON 字串

	// C:\xampp\apache\conf\mime.types
	// -> 說明 資料格式 對應的 MIME type




?>
</pre>