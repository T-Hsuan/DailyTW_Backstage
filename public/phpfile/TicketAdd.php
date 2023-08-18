<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=utf-8");

try {
    require_once("connectDailyTW.php");

    // 獲取前端傳來的資料
    $data = $_POST;
    $sql = "INSERT INTO ticket (`ticket_name`, `place_id`, `ticket_adult`, `ticket_ex`, `ticket_discount`, `ticket_desc`, `ticket_notice`) VALUES (:Name, :id, :adult, :ex, :discount, :desc, :notice);";
    $ticketAdd = $pdo->prepare($sql);
    $ticketAdd->bindValue(":Name", $data['Name']);
    $ticketAdd->bindValue(":id", $data['place_id']);
    $ticketAdd->bindValue(":adult", $data['price_adult']);
    $ticketAdd->bindValue(":ex", $data['price_ex']);
    $ticketAdd->bindValue(":discount", $data['price_discount']);
    $ticketAdd->bindValue(":desc", $data['desc']);
    $ticketAdd->bindValue(":notice", $data['notice']);
    $ticketAdd->execute();

    echo json_encode(array("message" => "資料新增成功"));
} catch (PDOException $e) {
    echo json_encode(array(
        "error" => array(
            "message" => "錯誤行號: " . $e->getLine() . ", 錯誤原因: " . $e->getMessage()
        )
    ));
}
?>
