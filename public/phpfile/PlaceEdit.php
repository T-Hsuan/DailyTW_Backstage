<?php 
	header('Access-Control-Allow-Origin:*');
	header("Content-Type:application/json;charset=utf-8");
try {
	//引入連線工作的檔案
	require_once("connectDailyTW.php");
	
	//執行sql指令並取得pdoStatement
	$sql = "SELECT * from place WHERE place_id = :place_id";
	$placeDesc = $pdo->prepare($sql);
    $placeDesc->bindValue(":place_id", $_GET["place_id"]);
    $placeDesc->execute();
    
    if( $placeDesc->rowCount() === 0 ){ //找不到
        //傳回空的JSON字串
        echo "{}";
    }else{ //找得到
        //取回一筆資料
        $placeDescRow = $placeDesc->fetch(PDO::FETCH_ASSOC);
        //送出json字串
        echo json_encode($placeDescRow);
    }

} catch (Exception $e) {
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	//echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>