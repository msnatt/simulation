<?php
// ตั้งค่าการเชื่อมต่อฐานข้อมูล

include "../config/no-crash.php";
include "../config/connect.php";

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบว่าได้รับข้อมูลจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $group_id = $_POST['group_id_new'] ?? null;
    $device_id = $_POST['device_id_new'] ?? null;
    $type_id = $_POST['type_id_new'] ?? null;
    $data_id = $_POST['data_id_new'] ?? null;
    $value_ = $_POST['box_update_output_new'] ?? null;

    // ตรวจสอบค่าที่รับมา (สามารถเพิ่ม validation ได้)
    if (!$group_id || !$device_id || !$type_id || !$data_id || !$value_) {
        echo "Missing required fields.";
        exit();
    }

    // สร้างคำสั่ง SQL สำหรับการบันทึกข้อมูล
    $sql = "INSERT INTO value_device (group_id, device_id, type_id, data_id, value, is_deleted)
            VALUES (?, ?, ?, ?, ?, 0)";

    // เตรียมคำสั่ง SQL
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // ผูกค่ากับคำสั่ง SQL
        $stmt->bind_param("iiiid", $group_id, $device_id, $type_id, $data_id, $value_);

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
exit()
?>