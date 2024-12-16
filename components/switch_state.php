<?php
session_start();

// ตรวจสอบว่าได้รับข้อมูลจาก AJAX หรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลที่ส่งจาก JavaScript
    $data = json_decode(file_get_contents('php://input'), true);

    // ตรวจสอบค่าที่ส่งมาว่าถูกต้องหรือไม่
    if (isset($data['switch_state'])) {
        $_SESSION['switch_state'] = $data['switch_state']; // อัปเดต session
        echo json_encode(['success' => true]); // ส่งผลลัพธ์กลับไปยัง JavaScript
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid data']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
