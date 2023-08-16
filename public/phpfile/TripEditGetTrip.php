<?php 
	header('Access-Control-Allow-Origin:*');
	header("Content-Type:application/json;charset=utf-8");
try {
	require_once("connectDailyTW.php");

	$sql = "SELECT trip_name, trip_author, trip_desc
			FROM trip
			WHERE trip_id = :trip_id;
			";
	$tripInfo = $pdo->prepare($sql); 
	$tripInfo->bindValue(":trip_id", $_GET["trip_id"]);
    $tripInfo->execute();

	if( $tripInfo->rowCount() === 0 ){ 
        echo "{}";
    }else{ 
        $tripInfoRow = $tripInfo->fetch(PDO::FETCH_ASSOC);
        echo json_encode($tripInfoRow);
    }

} catch (Exception $e) {
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	//echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>