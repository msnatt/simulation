<?php
session_start();
// ตรวจสอบว่ามีการส่ง POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // เก็บข้อมูลจากฟอร์มใน $_SESSION
    if (!isset($_SESSION['form_data'])) {
        $_SESSION['form_data'] = [];
    }
    // รับค่า card_id
    $card_id = $_POST['id_card'] ?? null;

    if ($card_id !== null) {
        $formData = [
            'card_id' => htmlspecialchars($card_id),
            'name_device' => htmlspecialchars($_POST['name_device_' . $card_id] ?? ''),
            'descriptions' => htmlspecialchars($_POST['desc_' . $card_id] ?? ''),
            'group_id' => htmlspecialchars($_POST['group_id_' . $card_id] ?? ''),
            'device_id' => htmlspecialchars($_POST['device_id_' . $card_id] ?? ''),
            'type_id' => htmlspecialchars($_POST['type_id_' . $card_id] ?? ''),
            'data_id' => htmlspecialchars($_POST['data_id_' . $card_id] ?? ''),
            'value_' => htmlspecialchars($_POST['box_update_output_' . $card_id] ?? ''),
        ];
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Missing card_id',
        ]);
        exit;
    }

    $_SESSION['form_data'][] = $formData;

    // ส่งผลลัพธ์กลับเป็น JSON
    echo json_encode([
        'success' => true,
        'message' => 'Form submitted successfully!',
        'current_session_data' => $_SESSION['form_data']
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
}
