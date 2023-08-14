<?php 
	header('Access-Control-Allow-Origin:*');
	header("Content-Type:application/json;charset=utf-8");
    try {
        require_once("connectDailyTW.php");

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Fetch place data from database
            $sql = "SELECT * FROM place;";
            $products = $pdo->query($sql);
            $prodRows = $products->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($prodRows);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Update status
            $data = json_decode(file_get_contents('php://input'), true);

            $placeId = $data['place_id'];
            $newStatus = $data['new_status'];

            // Update the database
            $sql = "UPDATE place SET place_status = :newStatus WHERE place_id = :placeId";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':newStatus', $newStatus);
            $stmt->bindValue(':placeId', $placeId);
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
?>