<?php
header('Access-Control-Allow-Origin:*');
header("Content-Type:application/json;charset=utf-8");

$targetDir = 'C:/wamp64/www/DailyTW/public/placeImg/';
// $targetDir = 'https://tibamef2e.com/chd102/g5/placeImg/';

try {
    require_once 'connectDailyTW.php';

    if (!empty($_FILES['place_img1']['name'])) {
        $pdo->beginTransaction();

        // Sanitize user inputs
        $placeName = $_POST['place_name'];
        $placeStay = $_POST['place_stay'];
        $placeAddr = $_POST['place_addr'];
        $placeLink = $_POST['place_link'];
        $placeDesc = $_POST['place_desc'];
        $regionId = $_POST['region_id'];
        $placeTagId = $_POST['place_tag_id'];

        $extension = pathinfo($_FILES['place_img1']['name'], PATHINFO_EXTENSION);
        $newFileName = uniqid() . '.' . $extension;
        // $targetFile = __DIR__ . DIRECTORY_SEPARATOR . $targetDir . $newFileName;
        $targetFile = $targetDir . $newFileName;

        if (move_uploaded_file($_FILES['place_img1']['tmp_name'], $targetFile)) {
            echo "File uploaded successfully to: " . $targetFile . "<br>";
            $sql = "INSERT INTO place (`place_name`, `place_stay`, `place_addr`, `place_link`, `place_desc`, `region_id`, `place_img1`) values (:place_name, :place_stay, :place_addr, :place_link, :place_desc, :region_id, :file_name)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':place_name', $placeName);
            $stmt->bindValue(':place_stay', $placeStay);
            $stmt->bindValue(':place_addr', $placeAddr);
            $stmt->bindValue(':place_link', $placeLink);
            $stmt->bindValue(':place_desc', $placeDesc);
            $stmt->bindValue(':region_id', $regionId);
            $stmt->bindValue(':file_name', $newFileName, PDO::PARAM_STR);
            $stmt->execute();

            $placeId = $pdo->lastInsertId();

            // Insert into place_tag_connection
            $sql2 = "INSERT INTO place_tag_connection (`place_id`, `place_tag_id`) VALUES (:place_id, :place_tag_id)";
            $stmt2 = $pdo->prepare($sql2);
            $stmt2->bindValue(':place_id', $placeId);
            $stmt2->bindValue(':place_tag_id', $placeTagId);
            $stmt2->execute();

            // Insert into oott_place_connection
            // $sql3 = "INSERT INTO oott_place_connection (`oott_id`, `place_tag_id`) VALUES (:oott_id, :place_id)";
            // $stmt3 = $pdo->prepare($sql3);
            // $stmt3->bindValue(':oott_id', $oottId);
            // $stmt3->bindValue(':place_id', $placeId);
            // $stmt3->execute();

            // $pdo->commit();

            $response = [
                'status' => 'success',
                'message' => 'Both INSERTs were successful.',
            ];
        } else {
            echo "Error moving uploaded file to: " . $targetFile . "<br>";
            $response = [
                'status' => 'error',
                'message' => 'Error uploading file.',
            ];
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'No file uploaded.',
        ];
    }
} catch (Exception $e) {
    $pdo->rollback();
    $response = [
        'status' => 'error',
        'message' => 'An error occurred: ' . $e->getMessage(),
    ];
}

echo json_encode($response);

// try {
//     //引入連線工作的檔案
//     require_once("connectDailyTW.php");

//     //寫入資料庫
//     $sql = "insert into place (`place_name`, `place_stay`, `place_addr`, `place_link`, `place_desc`, `region_id`) values (:place_name, :place_stay, :place_addr, :place_link, :place_desc, :region_id)";
//     $tagAdd = $pdo->prepare($sql);
//     $tagAdd -> bindValue(":place_name", $_POST['place_name']);
//     $tagAdd -> bindValue(":place_stay", $_POST['place_stay']);
//     $tagAdd -> bindValue(":place_addr", $_POST['place_addr']);
//     $tagAdd -> bindValue(":place_link", $_POST['place_link']);
//     $tagAdd -> bindValue(":place_desc", $_POST['place_desc']);
//     $tagAdd -> bindValue(":region_id", $_POST['region_id']);
//     $tagAdd -> execute();

// } catch (PDOException $e) {
//     echo "錯誤行號 : ", $e->getLine(), "<br>";
//     echo "錯誤原因 : ", $e->getMessage(), "<br>";
//     //echo "系統暫時不能正常運行，請稍後再試<br>";	
// }
?>