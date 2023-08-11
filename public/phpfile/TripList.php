<?php 
	header('Access-Control-Allow-Origin:*');
	header("Content-Type:application/json;charset=utf-8");
try {
	require_once("connectDailyTW.php");
	
	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		// Fetch trip data from database
		$sql = "SELECT * FROM trip";
		$trips = $pdo->query($sql);
		$tripRows = $trips->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($tripRows);
	} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// Update status
		$data = json_decode(file_get_contents('php://input'), true);

		$tripId = $data['trip_id'];
		$newStatus = $data['new_status'];

		// Update the database
		$sql = "UPDATE trip SET trip_status = :newStatus WHERE trip_id = :tripId";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':newStatus', $newStatus);
		$stmt->bindValue(':tripId', $tripId);
		$stmt->execute();

		// Respond with success
		echo json_encode(["message" => "Status updated successfully"]);
	} else {
		http_response_code(400);
		echo json_encode(["message" => "Invalid request method"]);
	}

} catch (Exception $e) {
	echo "錯誤行號 : ", $e->getLine(), "<br>";
	echo "錯誤原因 : ", $e->getMessage(), "<br>";
	//echo "系統暫時不能正常運行，請稍後再試<br>";	
}
?>