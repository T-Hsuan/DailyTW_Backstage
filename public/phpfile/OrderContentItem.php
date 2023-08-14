<?php 
	header('Access-Control-Allow-Origin:*');
	header("Content-Type:application/json;charset=utf-8");
try {
	//引入連線工作的檔案
	require_once("connectDailyTW.php");

	// $sql="SELECT o.ord_id, o.ord_receiver, o.ord_phone, o.ord_addr,
    //    i.ticket_adult_count, i.ticket_ex_count, i.total, t.ticket_name,
    //    t.ticket_adult, t.ticket_ex, t.ticket_desc, t.ticket_discount,
    //    t.ticket_notice, t.ticket_date, t.ticket_status, t.ticket_top
	// 	FROM `ord` o
	// 	JOIN `item` i ON o.ord_id = i.item_id
	// 	JOIN `ticket` t ON i.item_ticket_id = t.ticket_id;"

	
	// $sql = "select o.ord_id, o.ord_receiver, o.ord_phone, o.ord_addr, i.item_id, i.ticket_adult_count, i.ticket_ex_count, i.total, t.ticket_name
	// 		FROM order o
	// 		JOIN item i ON  o.ord_id= i.item_id
	// 		JOIN ticket t ON i item_ticket_id= t.ticket_id"
	//執行sql指令並取得pdoStatement
	$sql = "SELECT t.ticket_name, i.ticket_adult_count, i.ticket_ex_count, i.total
			FROM ord AS o
			JOIN item AS i ON o.ord_id = i.item_id
			JOIN ticket AS t ON i.item_ticket_id = t.ticket_id
			WHERE o.ord_id = :ord_id
			";
		
	$itemInfo = $pdo->prepare($sql); 
	$itemInfo->bindValue(":ord_id", $_GET["ord_id"]);
	$itemInfo->execute();
	
	if( $itemInfo->rowCount() === 0 ){ //找不到
		//傳回空的JSON字串
		echo "{}";
	}else{ //找得到
		//取回資料
		$itemInfoRow = $itemInfo->fetchAll(PDO::FETCH_ASSOC);
		//送出json字串
		echo json_encode($itemInfoRow);
	}

} catch (Exception $e) {
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	//echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>