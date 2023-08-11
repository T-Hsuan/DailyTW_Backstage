<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods: DELETE');
header("Content-Type:application/json;charset=utf-8");

try {
    //引入連線工作的檔案
    require_once("connectDailyTW.php");

    //寫入資料庫
    $sql = "delete from place_tag where place_tag_id = :place_tag_id";
    $tagDelete = $pdo->prepare($sql);
    $tagDelete -> bindValue(":place_tag_id", $_REQUEST["place_tag_id"]);
    $tagDelete -> execute();
    echo "刪除成功";

} catch (PDOException $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
    //echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>