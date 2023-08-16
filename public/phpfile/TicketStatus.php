<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers: Content-Type');

try {
    //引入連線工作的檔案
    require_once("connectDailyTW.php");

    //寫入資料庫
    $sql = "update ticket set ticket_status = :ticket_status,ticket_top = :ticket_top
    where ticket_id = :ticket_id";
    $statusUpdate = $pdo->prepare($sql);
    $statusUpdate -> bindValue(":ticket_status", $_REQUEST["ticket_status"]);
    $statusUpdate -> bindValue(":ticket_top", $_REQUEST["ticket_top"]);
    $statusUpdate -> bindValue(":ticket_id", $_REQUEST["ticket_id"]);
    $statusUpdate -> execute();
    echo "[資料庫]更新成功";

} catch (PDOException $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
    //echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>