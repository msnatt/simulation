<?php
session_start();

// // ตั้งค่าเริ่มต้นสำหรับ switch ถ้ายังไม่มีการกำหนดในเซสชัน
// if (!isset($_SESSION['switch_state'])) {
//     $_SESSION['switch_state'] = false; // false = ปิด
// }

// // ตรวจสอบการส่งค่า switch ผ่าน POST เพื่ออัปเดตเซสชัน
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $_SESSION['switch_state'] = $_POST['switch_state'] === 'true' ? true : false;
// }

// // ดึงสถานะ switch จากเซสชัน
// $switch_state = $_SESSION['switch_state'];
?>