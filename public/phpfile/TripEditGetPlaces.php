<?php 
	header('Access-Control-Allow-Origin:*');
	header("Content-Type:application/json;charset=utf-8");
try {
	require_once("connectDailyTW.php");

	$sql = "SELECT p.place_name, p.place_desc, CONCAT_WS(',', p.place_img1, p.place_img2, p.place_img3) AS place_img
			FROM trip AS t
			JOIN trip_item AS ti on t.trip_id = ti.trip_id
			JOIN place AS p on ti.place_id = p.place_id
			WHERE t.trip_id = :trip_id AND p.place_status = 1;
			";
	$placeInfo = $pdo->prepare($sql); 
	$placeInfo->bindValue(":trip_id", $_GET["trip_id"]);
    $placeInfo->execute();

	if( $placeInfo->rowCount() === 0 ){ 
        echo "{}";
    }else{ 
        $placeInfoRow = $placeInfo->fetchAll(PDO::FETCH_ASSOC);
		foreach ($placeInfoRow as &$row) {
            $row['place_img'] = explode(',', $row['place_img']);
        }
        echo json_encode($placeInfoRow);
    }

} catch (Exception $e) {
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	//echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>