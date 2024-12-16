
function UpdateDisplayValue(display_value, value) {
    display_value.innerHTML = value; // แสดงค่าของ slider
}
function UpdateInputValue(output_, value) {
    output_.value = value;
}

function UpdateValue(d, o, checked) {
    if (checked === true) {
        UpdateDisplayValue(d, 'ON');
        UpdateInputValue(o, 1);
    }
    else if (checked === false) {
        UpdateDisplayValue(d, 'OFF');
        UpdateInputValue(o, 0);
    } else {
        UpdateDisplayValue(d, checked);
        UpdateInputValue(o, checked);
    }
}


function changeTitle(cardTitle, value) {
    cardTitle.innerHTML = value;
}

function changeDesc(cardText, value) {
    cardText.innerHTML = value;
}

function CheckDropdown_type_Update() {
    // set switch on/off form db
    if (item_.type_id === "1" || item_.type_id == "2") {
        if (item_.value === "1") {
            input_c.checked = true;
            UpdateDisplayValue("ON");
            UpdateInputValue(1);
        } else if (item_.value === "0") {
            input_c.checked = false;
            UpdateDisplayValue("OFF");
            UpdateInputValue(0);
        }
    } else {
        input_r.value = item_.value;
        UpdateDisplayValue(item_.value);
        UpdateInputValue(item_.value);
    }
}

function edit_title_toggle(div_edit, is_edit) {
    if (is_edit) {
        div_edit.hidden = false;
    } else {
        div_edit.hidden = true;
    }
}

function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

// ฟังก์ชันเพื่อส่งคำขอไปที่ PHP เพื่ออัปเดตค่า session
function toggleSwitch(state) {
    fetch('../components/switch_state.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ switch_state: state }) // ส่งค่า switch_state ไปยัง PHP
    })
        .then(response => response.json())
        .then(data => {
            // แสดงผลลัพธ์หลังการอัปเดตค่า session
            if (data.success) {
                console.log('Switch state updated to:', state ? 'ON' : 'OFF');
            }
        })
        .catch(error => console.error('Error:', error));
}



async function startFormSubmission(session_count) {
    let count = 0;
    console.log('Switch : ' + switch_.checked);

    while (switch_.checked) {
        const formItems = contentContainer.querySelectorAll('[id^="form_"]');

        if ((formItems.length - session_count) === 0) {
            await delay(1000);            // delay 10 second
            if (count === formItems.length) {
                count = 0;
                console.log('การส่งฟอร์มทั้งหมดเสร็จสิ้น');
            }
            const form = new FormData(formItems[count]);
            console.log(">>> กำลังส่งฟอร์มที่ " + parseInt(count + 1));
            
            fetch('../config/api_to_db.php', {
                method: 'POST',
                body: form
            }).catch(error => console.error('Error:', error));
            console.log(">>> ส่งสำเร็จ. <<< ");

        }
        else if (session_count < formItems.length) {
            console.log("Add " + count + " to Session.");
            console.log(formItems[count]);
            fetch('../include/session_form.php', {
                method: 'POST',
                body: form
            })
                .then(response => response.json())

                .catch(error => console.error('Error:', error));
            session_count++;
        }

        count++;
    }
}


function stopFormSubmission() {
    // เรียก API ล้างข้อมูลใน Session
    fetch('../include/session_clear.php', { method: 'POST' })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
        })
        .catch(error => console.error('Error:', error));

    clearInterval(submissionInterval); // หยุดการวนลูปส่งฟอร์ม
}

async function fetchAndPopulateDropdown(url, dropdown, selectedValue) {
    try {
        const response = await fetch(url);
        const options = await response.json();

        const defaultOption = document.createElement('option');
        defaultOption.value = "0";
        defaultOption.textContent = "--Please Select--";
        dropdown.appendChild(defaultOption); // เพิ่มตัวเลือก "Please Select"

        options.forEach(option => {
            const opt = document.createElement('option');
            opt.value = option.id;
            opt.textContent = option.name_group || option.name_device || option.name_type || option.name_data;
            if (option.id === selectedValue) {
                opt.selected = true;
            }
            dropdown.appendChild(opt);
        });
    } catch (error) {
        console.error('Error fetching options:', error);
        const errorOption = document.createElement('option');
        errorOption.textContent = 'Error loading options';
        dropdown.appendChild(errorOption);
    }
}
function type_show_value(selectElement, cardId) {
    // ===================================== onchange type_id ===============================================
    const card = document.getElementById(cardId); // เจาะจง card ที่เกี่ยวข้อง
    const dropdown_ = card.querySelector('[id^="type_id"]'); // ตรวจสอบ selector ให้ถูกต้อง
    const label_switch = card.querySelector('[id^="div_switch"]');
    const input_switch_ = card.querySelector('[id^="input_switch"]');
    const display_switch = card.querySelector('[id^="span_switch"]');
    const box_update_output_ = card.querySelector('[id^="box_update_output_"]');
    const div_slide_range = card.querySelector('[id^="div_slide_range"]');
    const input_slide_range = card.querySelector('[id^="input_slide_range"]');
    const display_slide_range = card.querySelector('[id^="display_slide_range"]');

    if (dropdown_.value === "1") { // Digital in
        label_switch.hidden = true;
        input_switch_.hidden = true;
        input_switch_.disabled = true;
        display_switch.hidden = true;
        // display_switch.hidden = true;
        div_slide_range.hidden = false;
        input_slide_range.hidden = false;
        input_slide_range.disabled = false;

        UpdateValue(display_slide_range, box_update_output_, input_slide_range.value);


    } else if (dropdown_.value === "2") { // Digital out
        label_switch.hidden = false;
        input_switch_.hidden = false;
        input_switch_.disabled = false;
        display_switch.hidden = false;
        // display_switch.hidden = true;
        div_slide_range.hidden = true;
        input_slide_range.hidden = true;
        input_slide_range.disabled = true;

        UpdateValue(display_slide_range, box_update_output_, input_switch_.checked);

    } else if (dropdown_.value === "3") { // Analog in
        label_switch.hidden = true;
        input_switch_.hidden = true;
        input_switch_.disabled = true;
        display_switch.hidden = true;
        // display_switch.hidden = true;
        div_slide_range.hidden = false;
        input_slide_range.hidden = true;
        input_slide_range.disabled = true;

        UpdateValue(display_slide_range, box_update_output_, input_slide_range.value);

    } else if (dropdown_.value === "4") { // Analog out

        label_switch.hidden = false;
        input_switch_.hidden = false;
        input_switch_.disabled = true;
        display_switch.hidden = false;
        // display_switch.hidden = true;
        div_slide_range.hidden = true;
        input_slide_range.hidden = true;
        input_slide_range.disabled = true;

        UpdateValue(display_slide_range, box_update_output_, input_switch_.checked);

    } else {
        label_switch.hidden = true;
        input_switch_.hidden = true;
        input_switch_.disabled = true;
        display_switch.hidden = true;
        // display_switch.hidden = true;
        div_slide_range.hidden = true;
        input_slide_range.hidden = true;
        input_slide_range.disabled = true;
    }
}