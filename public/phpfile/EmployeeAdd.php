<?php
header('Access-Control-Allow-Origin:*');
header("Content-Type:application/json;charset=utf-8");

try {
    // 引入连接工作的文件
    require_once("connectDailyTW.php");

    // 写入数据库
    $sql = "INSERT INTO manager (`manager_name`, `manager_account`, `manager_pwd`, `manager_type`,`manager_state`) VALUES (:manager_name, :manager_account, :manager_pwd, :manager_type, 1)";
    $employeeAdd = $pdo->prepare($sql);
    $employeeAdd->bindValue(":manager_name", $_POST['manager_name']);

    $employeeAdd->bindValue(":manager_type", 0); 
    $employeeAdd->bindValue(":manager_account", $_POST['manager_account']);
    $employeeAdd->bindValue(":manager_pwd", $_POST['manager_pwd']);
    $employeeAdd->execute();

} catch (PDOException $e) {
    echo "錯誤行號 : ", $e->getLine(), "<br>";
    echo "錯誤原因 : ", $e->getMessage(), "<br>";
    //echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>
