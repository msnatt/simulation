<?php 
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

    // ข้อมูลที่ต้องการส่ง to db p tik
    $data = [
        "group_id" => $group_id,
        "type_id" => $type_id,
        "device_id" => $device_id,
        "datax_id" => $data_id,
        "data_value" => $value_
    ];

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

?>