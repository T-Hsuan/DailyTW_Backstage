<?php 
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=utf-8");
header('Access-Control-Allow-Headers: Content-Type');

try {
    require_once("connectDailyTW.php");
    
    // 假設這裡是處理新增資料的程式碼
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $name = $_post['name']
    $img = $_post['img']
    $region = $_post['region']
    $tag = $_post['tag']
    $adult = $_post['adult']
    $ex = $_post['ex']
    $discount = $_post['discount']
    $desc = $_post['desc']
    $notice = $_post['notice']

    $sql = "INSERT INTO ticket ('ticket_name',ticket_adult,ticket_ex,ticket_discount,'ticket_desc',ticket_notice) VALUES ('$name','$adult','$ex','$discount','$desc','$notice')";
    $result = $pdo->exec($sql);

    if ($result !== false) {
        echo json_encode(array("message" => "資料新增成功"));
    } else {
        echo json_encode(array("message" => "資料新增失敗"));
    }
} catch (Exception $e) {
    echo json_encode(array(
        "error" => array(
            "message" => "錯誤行號: " . $e->getLine() . ", 錯誤原因: " . $e->getMessage()
        )
    ));
}
?>
