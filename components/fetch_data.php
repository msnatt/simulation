<?php
include "../config/connect.php";

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลจากตาราง
$sql = "SELECT * FROM datas";
$result = $conn->query($sql);

// ตรวจสอบผลลัพธ์
if ($result->num_rows > 0) {
    echo '<table class="table table-bordered mx-4">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Data Name</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['name_data']) . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo '<p>No datas found.</p>';
}

// ปิดการเชื่อมต่อ
$conn->close();
?>


