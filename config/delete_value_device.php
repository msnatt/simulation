<?php
// ตั้งค่าการเชื่อมต่อฐานข้อมูล

include "../config/connect.php";

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบว่าได้รับข้อมูลจากฟอร์มหรือไม่
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
    if (is_null($group_id) || is_null($device_id) || is_null($type_id) || is_null($data_id) || is_null($value_)) {
        echo "card_id: $card_id<br>";
        echo "group_id: $group_id<br>";
        echo "device_id: $device_id<br>";
        echo "type_id: $type_id<br>";
        echo "data_id: $data_id<br>";
        echo "value_: $value_<br>";

        echo "Missing required fields.";
        exit();
    }

    // สร้างคำสั่ง SQL สำหรับการบันทึกข้อมูล
    $sql = "UPDATE value_device 
        SET Name_device = ?,descriptions = ?, group_id = ?, device_id = ?, type_id = ?, data_id = ?, value = ?, is_deleted = 1
        WHERE id = ?";

    // เตรียมคำสั่ง SQL
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // ผูกค่ากับคำสั่ง SQL
        $stmt->bind_param("ssiiiidi", $name_device, $descriptions, $group_id, $device_id, $type_id, $data_id, $value_, $card_id);

        // ดำเนินการคำสั่ง
        if ($stmt->execute()) {
            header("Location: ../pages/manager.php");
        } else {
            echo "Error: " . $stmt->error;
        }

        // ปิดคำสั่ง
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
exit();
