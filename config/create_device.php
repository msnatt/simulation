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
    $name_device = $_POST['input_create_device_id'] ?? null;

    // ตรวจสอบค่าที่รับมา (สามารถเพิ่ม validation ได้)
    if (!$name_device) {
        echo "Missing required fields.";
        exit();
    }


    // สร้างคำสั่ง SQL สำหรับการบันทึกข้อมูล
    $sql = "INSERT INTO devices (name_device, is_deleted)
            VALUES (?, 0)";

    // เตรียมคำสั่ง SQL
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // ผูกค่ากับคำสั่ง SQL
        $stmt->bind_param("s", $name_device);

        // ดำเนินการคำสั่ง
        if ($stmt->execute()) {
            header("Location: ../pages/device_manager.php");
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