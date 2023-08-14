<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers: Content-Type');

try {
    //引入連線工作的檔案
    require_once("connectDailyTW.php");

    //寫入資料庫
    $sql = "UPDATE trip SET trip_status = :trip_status WHERE trip_id = :trip_id";
    $statusUpdate = $pdo->prepare($sql);
    $statusUpdate -> bindValue(":trip_status", $_REQUEST["trip_status"]);
    $statusUpdate -> bindValue(":trip_id", $_REQUEST["trip_id"]);
    $statusUpdate -> execute();
    echo "更新成功";

} catch (PDOException $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
    //echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>