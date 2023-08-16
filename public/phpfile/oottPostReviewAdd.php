<?php
header('Access-Control-Allow-Origin:*');

header("Content-Type:application/json;charset=utf-8");

try {
//引入連線工作的檔案
require_once("connectDailyTW.php");

//寫入資料庫
$sql = 
"UPDATE oott
    SET oott_status = :oott_status,
        oott_review_status = :oott_review_status,
        oott_img_feedback = :oott_img_feedback,
        oott_desc_feedback = :oott_desc_feedback,
        oott_style_feedback = :oott_style_feedback,
        oott_type_feedback = :oott_type_feedback,
        oott_season_feedback = :oott_season_feedback
    WHERE oott_id = :oott_id;";
$stmt = $pdo->prepare($sql);
$stmt -> bindValue(":oott_id", $_POST['oott_id']);
$stmt -> bindValue(":oott_status", $_POST['oott_status']);
$stmt -> bindValue(":oott_review_status", $_POST['oott_review_status']);
$stmt -> bindValue(":oott_img_feedback", $_POST['oott_img_feedback']);
$stmt -> bindValue(":oott_desc_feedback", $_POST['oott_desc_feedback']);
$stmt -> bindValue(":oott_style_feedback", $_POST['oott_style_feedback']);
$stmt -> bindValue(":oott_type_feedback", $_POST['oott_type_feedback']);
$stmt -> bindValue(":oott_season_feedback", $_POST['oott_season_feedback']);

$stmt -> execute();
$msg = ["error" => false, "message" => "新增審核回饋成功"];
} catch (PDOException $e) {
echo "錯誤行號 : ", $e->getLine(), "<br>";
echo "錯誤原因 : ", $e->getMessage(), "<br>";

//echo "系統暫時不能正常運行，請稍後再試<br>";	
$message = "錯誤行號 : ". $e->getLine(). "錯誤原因 : ". $e->getMessage();
$msg = ["error" => true, "message" => $message]; 
}
?>