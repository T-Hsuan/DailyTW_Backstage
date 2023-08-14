<?php
header('Access-Control-Allow-Origin:*');
header("Content-Type:application/json;charset=utf-8");

try {
    // 引入连接工作的文件
    require_once("connectDailyTW.php");

    // 写入数据库
    $sql = "insert into manager (`manager_name`, `manager_id`, `manager_account`, `manager_type`) values (:manager_name, :manager_id, :manager_account, :manager_type)";
    $tagAdd = $pdo->prepare($sql);
    $tagAdd->bindValue(":manager_name", $_POST['manager_name']);
    $tagAdd->bindValue(":manager_id", $_POST['manager_id']);
    $tagAdd->bindValue(":manager_account", $_POST['manager_account']);
    $tagAdd->bindValue(":manager_type", $_POST['manager_type']);  // 根据表单字段名进行修改
    $tagAdd->execute();
    $msg = ["error" => false, "message" => "新增成功"];
    
} catch (PDOException $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
    //echo "系统暂时不能正常运行，请稍后再试<br>";    
    $message = "錯誤行號 : ". $e->getLine(). "錯誤原因 : ". $e->getMessage();
    $msg = ["error" => true, "message" => $message]; 
}
?>
