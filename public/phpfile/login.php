<?php 
	header('Access-Control-Allow-Origin: *');
	//設置 CORS（跨源資源共享）
	header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
	header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
	
	if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
		// This is a preflight request, respond with 200 OK without any content.
		http_response_code(200);
		exit();
	}

	try {
		require_once("connectDailyTW.php");

		$account = $_POST["account"];
		$psw = $_POST["psw"];

		$sql = "SELECT *
				FROM manager
				WHERE manager_account=:account AND manager_pwd = :psw";
        $manager = $pdo->prepare($sql);
        $manager->bindValue(':account', $account);
        $manager->bindValue(':psw', $psw);
        $manager->execute();

		if ($manager->rowCount() === 0) {
			echo json_encode([0]);
		} else {
			$managerRow = $manager->fetch(PDO::FETCH_ASSOC);
			
			// 登入成功，將登入者的資料寫入session
			session_start();
			$_SESSION["manager_id"] = $managerRow["manager_id"];
            $_SESSION["manager_name"] = $managerRow["manager_name"];
			$_SESSION["manager_account"] = $managerRow["manager_account"];
			$_SESSION["manager_type"] = $managerRow["manager_type"];
            $_SESSION["manager_state"] = $managerRow["manager_state"];
            $_SESSION["start_date"] = $managerRow["start_date"];
			$_SESSION["manager_pwd"] = $managerRow["manager_pwd"];
			
			echo json_encode($managerRow);	
            // echo json_encode('登入成功，將登入者的資料寫入session');
		}
	} catch (Exception $e) {
		echo json_encode(["連線失敗"]);
	}
?>
