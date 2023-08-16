<?php
header('Access-Control-Allow-Origin:*');

header("Content-Type:application/json;charset=utf-8");

try {
//引入連線工作的檔案
require_once("connectDailyTW.php");

//寫入資料庫
$sql = "insert into style (`style_name`, `style_desc`) values (:style_name, :style_desc)";
$styleAdd = $pdo->prepare($sql);
$styleAdd -> bindValue(":style_name", $_POST['style_name']);
$styleAdd -> bindValue(":style_desc", $_POST['style_desc']);
$styleAdd -> execute();
$msg = ["error" => false, "message" => "新增穿搭成功"];
} catch (PDOException $e) {
echo "錯誤行號 : ", $e->getLine(), "<br>";
echo "錯誤原因 : ", $e->getMessage(), "<br>";

//echo "系統暫時不能正常運行，請稍後再試<br>";	
$message = "錯誤行號 : ". $e->getLine(). "錯誤原因 : ". $e->getMessage();
$msg = ["error" => true, "message" => $message]; 
}
?>