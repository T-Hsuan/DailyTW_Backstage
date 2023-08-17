<?php 
	header('Access-Control-Allow-Origin:*');
	header("Content-Type:application/json;charset=utf-8");
    try {
        require_once("connectDailyTW.php");

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Fetch place data from database
            $sql = "SELECT t.ticket_id 'id', t.ticket_name 'Name', r.region_name 'location', p.place_img1 'img', t.ticket_adult 'price_adult', t.ticket_ex 'price_ex', t.ticket_discount 'discount', t.ticket_desc 'desc', t.ticket_notice 'notice', t.ticket_date 'date', t.ticket_status 'status', t.ticket_top 'top'
            FROM ticket t 
            JOIN place p on t.place_id = p.place_id
            JOIN region r on p.region_id = r.region_id";
            $products = $pdo->query($sql);
            $prodRows = $products->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($prodRows, JSON_NUMERIC_CHECK);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Update status
            $data = json_decode(file_get_contents('php://input'), true);

            $ticket_top = $data['ticket_top'];
            $newStatus = $data['ticket_status'];

            // Update the database
            $sql = "update ticket set ticket_status = :ticket_status,ticket_top = :ticket_top
            where ticket_id = :ticket_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':ticket_top', $ticket_top);
            $stmt->bindValue(':ticket_status', $newStatus);
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