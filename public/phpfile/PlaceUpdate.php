<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers: Content-Type');

try {
    //引入連線工作的檔案
    require_once("connectDailyTW.php");

    //寫入資料庫
    $sql = "UPDATE place p JOIN region r ON p.region_id = r.region_id
                JOIN place_tag_connection ptc ON p.place_id = ptc.place_id
                JOIN place_tag pt ON ptc.place_tag_id = pt.place_tag_id 
    SET p.place_name = :place_name,
    GROUP_CONCAT(pt.place_tag_name SEPARATOR ',') = :place_tag_group,
    r.region_name = :region_name,
    p.place_stay = :place_stay,
    p.place_addr = :place_addr,
    p.place_link = :place_link,
    p.place_desc = :place_desc,
    p.place_img1 = :place_img1,
    p.place_img2 = :place_img2,
    p.place_img3 = :place_img3
    WHERE place_id = :place_id;";
    
    //尚未更新
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