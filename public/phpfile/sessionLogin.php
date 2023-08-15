<?php
header('Access-Control-Allow-Origin: *');
//設置 CORS（跨源資源共享）
header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
try{
    require_once("connectDailyTW.php");
    
    $managerId = $_POST["manager_id"];
    // $manageid = 1;
    
        $sql = "select *
		from manager
		where manager_id = :manager_id";
        $manager = $pdo->prepare($sql);
        $manager->bindValue(":manager_id", $managerId);
        $manager->execute();
        // where manage_id=:manage_id
        $managerRow = $manager->fetch(PDO::FETCH_ASSOC);
        
        
        echo json_encode($managerRow);
        
}catch(Exception $e){
        // echo "連線失敗";
        echo json_encode(["連線失敗"]);
    }


?>