<?php 
	header('Access-Control-Allow-Origin:*');
	header("Content-Type:application/json;charset=utf-8");
try {
	//引入連線工作的檔案
	require_once("connectDailyTW.php");
	
	$sql = "SELECT o.ord_id, m.mem_name, m.mem_phone, o.ord_receiver, o.ord_phone, o.ord_addr
			FROM ord AS o
			JOIN member AS m ON o.ord_mem = m.mem_id
			WHERE o.ord_id = :ord_id
			";
		
	$ordInfo = $pdo->prepare($sql); 
	$ordInfo->bindValue(":ord_id", $_GET["ord_id"]);
	$ordInfo->execute();
	
	if( $ordInfo->rowCount() === 0 ){ //找不到
		//傳回空的JSON字串
		echo "{}";
	}else{ //找得到
		//取回資料
		$ordInfoRow = $ordInfo->fetch(PDO::FETCH_ASSOC);
		//送出json字串
		echo json_encode($ordInfoRow);
	}

} catch (Exception $e) {
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	//echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>