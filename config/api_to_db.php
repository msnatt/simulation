<?php
// ตั้งค่าการเชื่อมต่อฐานข้อมูล
include "../config/connect.php";

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// URL ของ API ที่ต้องการส่งข้อมูล
$url = "https://iot-demo.tikky.xyz/api_push_data_by_hardware_process.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $card_id = $_POST['id_card'] ?? null;
    $name_device = $_POST['name_device_' . $card_id] ?? null;
    $descriptions = $_POST['desc_' . $card_id] ?? null;
    $group_id = $_POST['group_id_' . $card_id] ?? null;
    $device_id = $_POST['device_id_' . $card_id] ?? null;
    $type_id = $_POST['type_id_' . $card_id] ?? null;
    $data_id = $_POST['data_id_' . $card_id] ?? null;
    $value_ = $_POST['box_update_output_' . $card_id] ?? null;

    // ตรวจสอบค่าที่รับมา (สามารถเพิ่ม validation ได้)
    if (is_null($name_device) || is_null($group_id) || is_null($device_id) || is_null($type_id) || is_null($data_id) || is_null($value_)) {
        echo "name_device: $name_device<br>";
        echo "card_id: $card_id<br>";
        echo "group_id: $group_id<br>";
        echo "device_id: $device_id<br>";
        echo "type_id: $type_id<br>";
        echo "data_id: $data_id<br>";
        echo "value_: $value_<br>";
        echo "Missing required fields.";
        exit();
    }
    // ข้อมูลที่ต้องการส่ง to db p tik
    $data = [
        "group_id" => $group_id,
        "type_id" => $type_id,
        "device_id" => $device_id,
        "datax_id" => $data_id,
        "data_value" => $value_
    ];

    // ดึงข้อมูลจากตาราง categories
    $sql = "SELECT * FROM value_device";
    $result = $conn->query($sql);

    $options = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options[] = $row; // เก็บข้อมูลในรูปแบบ Array
        }
    }

    $new_id = end($options)['id'] + 1;


    if ($card_id === (string)$new_id) {
        $sql = "INSERT INTO value_device (Name_device, descriptions, group_id, device_id, type_id, data_id, value, is_deleted)
            VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
    } else {
        // สร้างคำสั่ง SQL สำหรับการบันทึกข้อมูล ลง db ตัวเอง local
        $sql = "UPDATE value_device 
        SET Name_device = ?,descriptions = ?, group_id = ?, device_id = ?, type_id = ?, data_id = ?, value = ?, is_deleted = 0
        WHERE id = ?";
    }

    // เตรียมคำสั่ง SQL
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // ผูกค่ากับคำสั่ง SQL
        if ($card_id === (string)$new_id) {
            $stmt->bind_param("ssiiiid", $name_device, $descriptions, $group_id, $device_id, $type_id, $data_id, $value_);
        } else {
            $stmt->bind_param("ssiiiidi", $name_device, $descriptions, $group_id, $device_id, $type_id, $data_id, $value_, $card_id);
        }

        // ดำเนินการคำสั่ง
        if ($stmt->execute()) {
            echo "Status to local : Success";
        } else {
            echo "Error: " . $stmt->error;
        }

        // ปิดคำสั่ง
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // แปลงข้อมูลเป็น JSON
    $jsonData = json_encode($data);
    // ตั้งค่า cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json', // กำหนดว่าเรากำลังส่ง JSON
        'Content-Length: ' . strlen($jsonData)
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

    // ส่งคำขอและรับการตอบกลับ
    $response = curl_exec($ch);

    // ตรวจสอบข้อผิดพลาด
    if (curl_errno($ch)) {
        echo 'Error to db p tik :' . curl_error($ch);
    } else {
        // แสดงผลการตอบกลับจาก API
        echo ($response);
    }
}

// ปิดการเชื่อมต่อ cURL
curl_close($ch);
// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
exit();
