<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers: Content-Type');

try {
    //引入連線工作的檔案
    require_once("connectDailyTW.php");

    //寫入資料庫
    $sql = "update place set place_status = :place_status where place_id = :place_id";
    $statusUpdate = $pdo->prepare($sql);
    $statusUpdate -> bindValue(":place_status", $_REQUEST["place_status"]);
    $statusUpdate -> bindValue(":place_id", $_REQUEST["place_id"]);
    $statusUpdate -> execute();
    echo "更新成功";

} catch (PDOException $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
    //echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>