<?php
header('Access-Control-Allow-Origin: http://your-front-end-domain.com');
header("Content-Type:application/json;charset=utf-8");

try {
    // 引入连接工作的文件
    require_once("connectDailyTW.php");

    // 写入数据库
    $sql = "INSERT INTO manager (`manager_name`, `manager_account`, `manager_pwd`, `manager_type`) VALUES (:manager_name, :manager_account, :manager_pwd, :manager_type)";
    $tagAdd = $pdo->prepare($sql);
    $tagAdd->bindValue(":manager_name", $_POST['manager_name']);
    $tagAdd->bindValue(":manager_type", $_POST['manager_type']); 
    $tagAdd->bindValue(":manager_account", $_POST['manager_account']);
    $tagAdd->bindValue(":manager_pwd", $_POST['manager_pwd']);
    $tagAdd->execute();
    $msg = ["error" => false, "message" => "新增成功"];
    
} catch (PDOException $e) {
    $message = "錯誤行號 : ". $e->getLine(). "錯誤原因 : ". $e->getMessage();
    $msg = ["error" => true, "message" => $message]; 
}

// 输出 JSON 响应
echo json_encode($msg);
?>
