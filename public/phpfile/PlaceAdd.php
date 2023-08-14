<?php
header('Access-Control-Allow-Origin:*');
header("Content-Type:application/json;charset=utf-8");

try {
    //引入連線工作的檔案
    require_once("connectDailyTW.php");

    //寫入資料庫
    $sql = "insert into place (`place_name`, `place_stay`, `place_addr`, `place_link`, `place_desc`, `region_id`) values (:place_name, :place_stay, :place_addr, :place_link, :place_desc, :region_id)";
    $tagAdd = $pdo->prepare($sql);
    $tagAdd -> bindValue(":place_name", $_POST['place_name']);
    $tagAdd -> bindValue(":place_stay", $_POST['place_stay']);
    $tagAdd -> bindValue(":place_addr", $_POST['place_addr']);
    $tagAdd -> bindValue(":place_link", $_POST['place_link']);
    $tagAdd -> bindValue(":place_desc", $_POST['place_desc']);
    $tagAdd -> bindValue(":region_id", $_POST['region_id']);
    $tagAdd -> execute();

} catch (PDOException $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
    //echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>