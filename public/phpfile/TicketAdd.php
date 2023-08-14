<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=utf-8");

try {
    require_once("connectDailyTW.php");

    // 獲取前端傳來的資料
    $data = $_POST;
    $sql = "INSERT INTO ticket (`ticket_name`, `place_id`, `ticket_adult`, `ticket_ex`, `ticket_discount`, `ticket_desc`, `ticket_notice`) VALUES (:Name, :id, :adult, :ex, :discount, :desc, :notice)";
    $tagAdd = $pdo->prepare($sql);
    $tagAdd->bindValue(":Name", $data['Name']);
    $tagAdd->bindValue(":id", $data['place_id']);
    $tagAdd->bindValue(":adult", $data['price_adult']);
    $tagAdd->bindValue(":ex", $data['price_ex']);
    $tagAdd->bindValue(":discount", $data['price_discount']);
    $tagAdd->bindValue(":desc", $data['desc']);
    $tagAdd->bindValue(":notice", $data['notice']);
    $tagAdd->execute();

    echo json_encode(array("message" => "資料新增成功"));
} catch (PDOException $e) {
    echo json_encode(array(
        "error" => array(
            "message" => "錯誤行號: " . $e->getLine() . ", 錯誤原因: " . $e->getMessage()
        )
    ));
}
?>
