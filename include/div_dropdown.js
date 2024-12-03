
// สร้างฟอร์ม
const form = document.createElement('form');
form.method = 'POST';
form.className = 'container'; // เพิ่ม class สำหรับการจัดวาง

// สร้าง div สำหรับ Card
const cardDiv = document.createElement('div');
cardDiv.className = 'card col-3 m-4'; // เพิ่ม class "card"

const cardimg = document.createElement('img');
cardimg.className = 'mt-3';
cardimg.src = 'https://via.placeholder.com/300x100';

// สร้างหัวข้อ Card
const cardTitle = document.createElement('div');
cardTitle.className = 'card-title';
cardTitle.textContent = 'New Device'; // ข้อความหัวข้อ

// สร้างข้อความใน Card
const cardText = document.createElement('div');
cardText.className = 'card-text';
cardText.textContent = 'Create device and setup for new device.';

// สร้าง Dropdown
const dropdown_group = document.createElement('select');
dropdown_group.className = 'form-select';
dropdown_group.name = 'group_id';
dropdown_group.id = 'group_id';
// สร้าง Dropdown
const dropdown_device = document.createElement('select');
dropdown_device.className = 'form-select';
dropdown_device.name = 'device_id';
dropdown_device.id = 'device_id';
// สร้าง Dropdown
const dropdown_type = document.createElement('select');
dropdown_type.className = 'form-select';
dropdown_type.name = 'type_id';
dropdown_type.id = 'type_id';
dropdown_type.addEventListener('change', type_show_value);
// document.getElementById('type_id').value = "0";

// สร้าง Dropdown
const dropdown_data = document.createElement('select');
dropdown_data.className = 'form-select';
dropdown_data.name = 'data_id';
dropdown_data.id = 'data_id';
// สร้าง Input
const divinput_value = document.createElement('input');
divinput_value.className = 'form-control';
divinput_value.name = 'input_value';
divinput_value.id = 'input_value';

// สร้าง div สำหรับปุ่ม
const div_btn = document.createElement('div');
div_btn.className = 'row justify-content-center mt-3'; // คลาส row สำหรับจัดเรียง
div_btn.innerHTML = '<br>';


const btn_ = document.createElement('input');
btn_.type = 'submit'; // กำหนดชนิดของ input เป็นปุ่ม
btn_.className = 'btn col-4 c-1 text-white mb-4'; // เพิ่มคลาส btn ของ Bootstrap

div_btn.appendChild(btn_);