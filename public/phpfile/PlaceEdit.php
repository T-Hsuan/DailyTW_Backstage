<?php 
	header('Access-Control-Allow-Origin:*');
	header("Content-Type:application/json;charset=utf-8");
    try {
        require_once("connectDailyTW.php");

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Fetch place data from database
            $sql = "SELECT p.place_id, p.place_name, GROUP_CONCAT(pt.place_tag_name SEPARATOR ',') AS place_tag_group, r.region_name, p.place_stay, p.place_addr, p.place_link, p.place_desc, p.place_img1, p.place_img2, p.place_img3 
            FROM place p JOIN region r ON p.region_id = r.region_id
                        JOIN place_tag_connection ptc ON p.place_id = ptc.place_id
                        JOIN place_tag pt ON ptc.place_tag_id = pt.place_tag_id
                        GROUP BY p.place_id;";
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