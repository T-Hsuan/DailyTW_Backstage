<?php
header('Access-Control-Allow-Origin:*');
header("Content-Type:application/json;charset=utf-8");

try {
    //引入連線工作的檔案
    require_once("connectDailyTW.php");

    //寫入資料庫
    $sql = "insert into place_tag (`place_tag_name`, `place_tag_desc`) values (:place_tag_name, :place_tag_desc)";
    $tagAdd = $pdo->prepare($sql);
    $tagAdd -> bindValue(":place_tag_name", $_POST['place_tag_name']);
    $tagAdd -> bindValue(":place_tag_desc", $_POST['place_tag_desc']);
    $tagAdd -> execute();
    $msg = ["error" => false, "message" => "新增成功"];

} catch (PDOException $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
    //echo "系統暫時不能正常運行，請稍後再試<br>";	
    $message = "錯誤行號 : ". $e->getLine(). "錯誤原因 : ". $e->getMessage();
    $msg = ["error" => true, "message" => $message]; 
}
?>