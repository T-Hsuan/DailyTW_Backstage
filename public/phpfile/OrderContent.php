<?php 
	header('Access-Control-Allow-Origin:*');
	header("Content-Type:application/json;charset=utf-8");
try {
	//引入連線工作的檔案
	require_once("connectDailyTW.php");

	$sql="SELECT o.ord_id, o.ord_receiver, o.ord_phone, o.ord_addr,
       i.ticket_adult_count, i.ticket_ex_count, i.total, t.ticket_name,
		FROM `ord` o
		JOIN `item` i ON o.ord_id = i.item_id
		JOIN `ticket` t ON i.item_ticket_id = t.ticket_id;"

	
	// $sql = "select o.ord_id, o.ord_receiver, o.ord_phone, o.ord_addr, i.item_id, i.ticket_adult_count, i.ticket_ex_count, i.total, t.ticket_name
	// 		FROM order o
	// 		JOIN item i ON  o.ord_id= i.item_id
	// 		JOIN ticket t ON i item_ticket_id= t.ticket_id"
	//執行sql指令並取得pdoStatement
	// $sql = "select * from ord
	//  		join member
	// 		 on ord.ord_mem = member.mem_id";

	// 		"select * from item
	// 		join ticket
	// 		on ticket.ticket_name = item.ticket_name";
		
	$products = $pdo->query($sql); 
	$prodRows = $products->fetchAll(PDO::FETCH_ASSOC);
  echo json_encode($prodRows);

} catch (Exception $e) {
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	//echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>