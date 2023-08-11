<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

try {
    //引入連線工作的檔案
    require_once("connectDailyTW.php");

    //寫入資料庫
    $sql = "update place_tag set place_tag_status = :place_tag_status where place_tag_id = :place_tag_id";
    $tagUpdate = $pdo->prepare($sql);
    $tagUpdate -> bindValue(":place_tag_status", $_REQUEST["place_tag_status"]);
    $tagUpdate -> bindValue(":place_tag_id", $_REQUEST["place_tag_id"]);
    $tagUpdate -> execute();
    echo "更新成功";

} catch (PDOException $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
    //echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>