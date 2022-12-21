
<?php 

session_start();

session_destroy();

echo json_encode($_SESSION);
// 第一次還回傳還是有值，因為 browser 還沒清掉 session，第二次就被清除了




 ?>