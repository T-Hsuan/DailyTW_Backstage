<?php 
	header('Access-Control-Allow-Origin: *');
	//設置 CORS（跨源資源共享）
	header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
	header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

	try {
        require_once("connectDailyTW.php");

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Fetch place data from database
            $sql = "SELECT * FROM member";
            $products = $pdo->query($sql);
            $prodRows = $products->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($prodRows);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Update status
            $data = json_decode(file_get_contents('php://input'), true);

            $memId = $data['mem_id'];
            $newStatus = $data['new_status'];

            // Update the database
            $sql = "UPDATE member SET mem_status = :newStatus WHERE mem_id = :memId";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':newStatus', $newStatus);
            $stmt->bindValue(':memId', $memId);
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
    }	
// try {
// 	//引入連線工作的檔案
// 	require_once("connectDailyTW.php");
	
// 	//執行sql指令並取得pdoStatement
// 	$sql = "select * from member";
// 	$products = $pdo->query($sql); 
// 	$prodRows = $products->fetchAll(PDO::FETCH_ASSOC);
//   echo json_encode($prodRows);

// } catch (Exception $e) {
// 	echo "錯誤行號 : ", $e->getLine(), "<br>";
// 	echo "錯誤原因 : ", $e->getMessage(), "<br>";
// 	//echo "系統暫時不能正常運行，請稍後再試<br>";	
// }


?>