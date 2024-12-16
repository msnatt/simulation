<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ลบข้อมูลในเซสชัน
    unset($_SESSION['form_data']);

    echo json_encode([
        'success' => true,
        'message' => 'Session cleared successfully!'
    ]);
    exit();
}

echo json_encode([
    'success' => false,
    'message' => 'Invalid request method.'
]);
?>
