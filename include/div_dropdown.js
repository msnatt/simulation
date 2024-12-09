
// สร้างฟอร์ม
const form = document.createElement('form');
form.method = 'POST';
form.className = 'container'; // เพิ่ม class สำหรับการจัดวาง
form.id = 'form_' + item_.id;
form.action = '../config/delete_value_device.php'; // URL ที่จะส่งข้อมูล

// สร้าง div สำหรับ Card
const cardDiv = document.createElement('div');
cardDiv.className = 'card col-3 m-4'; // เพิ่ม class "card"
cardDiv.id = 'card_' + item_.id;
cardDiv.name = 'card_' + item_.id;

// ======================== Menu Button ========================
const div_ = document.createElement('div');
div_.className = "col-4 px-0 d-flex justify-content-center";

const div_trash = document.createElement('div');
div_trash.className = "justify-content-center";

const icon_trash = document.createElement('div');
icon_trash.className = "";

const delbtn = document.createElement('button');
delbtn.className = 'd-flex btn';
delbtn.type = 'submit'; // กำหนดประเภทเป็นปุ่ม
delbtn.innerHTML = '<i class="bi bi-trash3"></i>'; // ข้อความในปุ่ม
delbtn.id = 'deleteButton'; // กำหนด id
// delbtn.style.width = "50%";
delbtn.style.justifyContent = "center";
delbtn.style.alignItems = "center";

//edit title card
const rename_title = document.createElement('div'); // ใช้ img สำหรับแสดงรูปภาพ
rename_title.className = 'd-flex btn';
rename_title.type = 'button';
rename_title.innerHTML = '<i class="bi bi-pen"></i>'; // ข้อความในปุ่ม
rename_title.style.width = "50%";
rename_title.style.justifyContent = "center";
rename_title.style.alignItems = "center";
rename_title.onclick = () => {
    edit_checkbox.checked = !edit_checkbox.checked; // toggle สถานะ checkbox
    edit_title_toggle(div_edit_title_card, edit_checkbox.checked); // ส่งค่าไปฟังก์ชัน
};

const edit_checkbox = document.createElement('input'); // สร้าง input สำหรับ checkbox
edit_checkbox.type = 'checkbox'; // กำหนดประเภท input เป็น checkbox
edit_checkbox.style.display = 'none'; // ซ่อน checkbox เพื่อไม่ให้มองเห็น


div_trash.appendChild(delbtn);
div_.appendChild(rename_title);
div_.appendChild(div_trash);
// ======================== image of card =========================
const div_header = document.createElement('div');
div_header.className = 'mb-3 mx-3';

const cardimg = document.createElement('img');
cardimg.className = 'mt-3';
cardimg.src = 'https://via.placeholder.com/300x100';
cardimg.style.borderRadius = "10px";

div_header.appendChild(cardimg);
// ======================== Title of card =========================
const div_title_card = document.createElement('div');
div_title_card.className = 'w-100 ';
div_title_card.id = 'div_title_card';
div_title_card.name = 'div_title_card';

const div_edit_title_card = document.createElement('div');
div_edit_title_card.className = 'w-100';
div_edit_title_card.id = 'div_edit_title_card';
div_edit_title_card.name = 'div_edit_title_card';
div_edit_title_card.hidden = true;

const title_ = document.createElement('div');
title_.className = 'row justify-content-between';





// สร้างหัวข้อ Card
const cardTitle = document.createElement('div');
cardTitle.className = 'card-title col-8';
cardTitle.textContent = item_.Name_device;

// สร้างข้อความใน Card
const cardText = document.createElement('div');
cardText.className = 'card-text';
cardText.textContent = item_.descriptions;

title_.appendChild(cardTitle);
title_.appendChild(div_);
div_title_card.appendChild(title_);
div_title_card.appendChild(cardText);

// สร้างหัวข้อ Card
const edit_Title = document.createElement('input');
edit_Title.className = 'form-control';
edit_Title.id = 'name_device_' + item_.id;
edit_Title.name = 'name_device_' + item_.id;
edit_Title.value = cardTitle.textContent;
edit_Title.addEventListener('change', () => changeTitle(cardTitle, edit_Title.value));

// สร้างข้อความใน Card
const edit_desc = document.createElement('input');
edit_desc.className = 'form-control';
edit_desc.id = 'desc_' + item_.id;
edit_desc.name = 'desc_' + item_.id;
edit_desc.value = cardText.textContent;
edit_desc.addEventListener('change', () => changeDesc(cardText, edit_desc.value));

div_edit_title_card.appendChild(edit_Title);
div_edit_title_card.appendChild(edit_desc);

div_header.appendChild(div_title_card);
div_header.appendChild(div_edit_title_card);
// ======================== dropdown of card =========================
// สร้าง Dropdown
const dropdown_group = document.createElement('select');
dropdown_group.className = 'form-select';
dropdown_group.name = 'group_id_' + item_.id;
dropdown_group.id = 'group_id_' + item_.id;
// สร้าง Dropdown
const dropdown_device = document.createElement('select');
dropdown_device.className = 'form-select';
dropdown_device.name = 'device_id_' + item_.id;
dropdown_device.id = 'device_id_' + item_.id;
// สร้าง Dropdown
const dropdown_type = document.createElement('select');
dropdown_type.className = 'form-select';
dropdown_type.name = 'type_id_' + item_.id;
dropdown_type.id = 'type_id_' + item_.id;
dropdown_type.addEventListener('change', () => type_show_value(this, cardDiv.id));
// document.getElementById('type_id').value = "0";

// สร้าง Dropdown
const dropdown_data = document.createElement('select');
dropdown_data.className = 'form-select';
dropdown_data.name = 'data_id_' + item_.id;
dropdown_data.id = 'data_id_' + item_.id;

// ======================== id of card =========================
// สร้าง Input
const id_card = document.createElement('input');
id_card.className = 'form-control';
id_card.name = 'id_card';
id_card.id = 'id_card';
id_card.hidden = true;
id_card.value = item_.id;

// ======================== button Submit ======================
// สร้าง div สำหรับปุ่ม
const div_btn = document.createElement('div');
div_btn.className = 'row justify-content-center mt-3'; // คลาส row สำหรับจัดเรียง
div_btn.innerHTML = '<br>';


const btn_ = document.createElement('input');
btn_.type = 'submit'; // กำหนดชนิดของ input เป็นปุ่ม
btn_.className = 'btn col-4 c-1 text-white mb-4'; // เพิ่มคลาส btn ของ Bootstrap



div_btn.appendChild(btn_);
// ========================= span value ========================

const text_switch = document.createElement('span');
text_switch.className = 'text-black m-2';
text_switch.id = 'span_switch';
text_switch.name = 'span_switch';
text_switch.innerHTML = 'Switch ';


// ========================= input hidden ======================
const output_ = document.createElement('input');
output_.id = 'box_update_output_' + item_.id;
output_.name = 'box_update_output_' + item_.id;
output_.hidden = true;
output_.value = '';


// ========================= display value =====================

// display range value
const display_value = document.createElement('p');
display_value.className = 'text-dark text-center';
display_value.id = 'display_slide_range_' + item_.id;
display_value.style = 'font-size: 3rem;';
// ========================= function ===========================

// ฟังก์ชัน displayValue ที่จะเรียกใช้เมื่อค่าใน slider เปลี่ยน


// ========================= label switch =======================

const div_switch = document.createElement('label');
div_switch.className = 'switch mt-4'; // คลาส row สำหรับจัดเรียง
div_switch.id = 'div_switch'; // คลาส row สำหรับจัดเรียง
div_switch.hidden = true; // ซ่อน label

const input_c = document.createElement('input');
input_c.type = 'checkbox';
input_c.className = 'input';
input_c.id = 'input_switch_' + item_.id;
input_c.name = 'value_device_' + item_.id;

const span_ = document.createElement('span');
span_.className = 'slider';

div_switch.appendChild(input_c);
div_switch.appendChild(span_);

// ======================== slide range =========================

// สร้าง div สำหรับ range
const div_range = document.createElement('div');
div_range.className = 'row justify-content-center mt-3'; // คลาส row สำหรับจัดเรียง
div_range.id = 'div_slide_range';

// input slide range 
const input_r = document.createElement('input');
input_r.type = 'range';
input_r.className = 'form-range mt-4';
input_r.id = 'input_slide_range_' + item_.id;
input_r.min = '0'; // ค่าต่ำสุดของ slider
input_r.max = '5000'; // ค่าสูงสุดของ slider



div_range.appendChild(input_r);
// ======================================================================================================

// เพิ่ม event listener สำหรับเมื่อค่าใน slider เปลี่ยน
input_r.addEventListener('input', () => UpdateValue(display_value, output_, input_r.value));
input_c.addEventListener('change', () => UpdateValue(display_value, output_, input_c.checked));
