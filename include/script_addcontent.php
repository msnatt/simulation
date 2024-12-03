<script>
    // JavaScript สำหรับเพิ่ม div
    console.log('Start Addcontent');
    document.getElementById('addDivButton').addEventListener('click', async function() {

        console.log('addDivContent');

        // const response_value = await fetch('../config/dropdown_value.php'); // เรียกใช้ PHP
        // const options_value = await response_value.json(); // รับผลลัพธ์เป็น JSON

        let count_round = 0;


        const contentContainer = document.getElementById('contentContainer');


        <?php include "../include/div_dropdown.js"; ?>
        form.action = '../config/create_value_device.php'; // URL ที่จะส่งข้อมูล
        btn_.value = 'Create'; // กำหนดข้อความในปุ่ม


        try {
            const response_group = await fetch('../config/dropdown_group.php'); // เรียกใช้ PHP
            const options_group = await response_group.json(); // รับผลลัพธ์เป็น JSON

            const response_device = await fetch('../config/dropdown_device.php'); // เรียกใช้ PHP
            const options_device = await response_device.json(); // รับผลลัพธ์เป็น JSON

            const response_type = await fetch('../config/dropdown_type.php'); // เรียกใช้ PHP
            const options_type = await response_type.json(); // รับผลลัพธ์เป็น JSON

            const response_data = await fetch('../config/dropdown_data.php'); // เรียกใช้ PHP
            const options_data = await response_data.json(); // รับผลลัพธ์เป็น JSON



            // เพิ่มตัวเลือกใน Dropdown
            options_group.forEach(option => {
                const opt_g = document.createElement('option');
                if (option.id === "1") {
                    const opt_ = document.createElement('option');
                    opt_.value = "0";
                    opt_.textContent = "--Please Select--";
                    dropdown_group.appendChild(opt_);
                }
                opt_g.value = option.id; // ใช้ id จากฐานข้อมูล
                opt_g.textContent = option.name_group; // ใช้ชื่อหมวดหมู่จากฐานข้อมูล
                // ตั้งค่า selected ถ้า value ตรงกับ selectedValue


                dropdown_group.appendChild(opt_g);
            });
            options_device.forEach(option => {
                const opt_de = document.createElement('option');
                if (option.id === "1") {
                    const opt_ = document.createElement('option');
                    opt_.value = "0";
                    opt_.textContent = "--Please Select--";
                    dropdown_device.appendChild(opt_);
                }
                opt_de.value = option.id; // ใช้ id จากฐานข้อมูล
                opt_de.textContent = option.name_device; // ใช้ชื่อหมวดหมู่จากฐานข้อมูล
                // ตั้งค่า selected ถ้า value ตรงกับ selectedValue



                dropdown_device.appendChild(opt_de);
            });
            options_type.forEach(option => {
                const opt_t = document.createElement('option');
                if (option.id === "1") {
                    const opt_ = document.createElement('option');
                    opt_.value = "0";
                    opt_.textContent = "--Please Select--";
                    dropdown_type.appendChild(opt_);
                }
                opt_t.value = option.id; // ใช้ id จากฐานข้อมูล
                opt_t.textContent = option.name_type; // ใช้ชื่อหมวดหมู่จากฐานข้อมูล
                // ตั้งค่า selected ถ้า value ตรงกับ selectedValue



                dropdown_type.appendChild(opt_t);
            });
            options_data.forEach(option => {
                const opt_da = document.createElement('option');
                if (option.id === "1") {
                    const opt_ = document.createElement('option');
                    opt_.value = "0";
                    opt_.textContent = "--Please Select--";
                    dropdown_data.appendChild(opt_);
                }
                opt_da.value = option.id; // ใช้ id จากฐานข้อมูล
                opt_da.textContent = option.name_data; // ใช้ชื่อหมวดหมู่จากฐานข้อมูล
                // ตั้งค่า selected ถ้า value ตรงกับ selectedValue


                dropdown_data.appendChild(opt_da);
            });
        } catch (error) {
            console.error('Error fetching options:', error);
            const errorOption = document.createElement('option');
            errorOption.textContent = 'Error loading options';
            dropdown_group.appendChild(errorOption);
        }





        // ============================================ function ==============================================

        // ฟังก์ชัน displayValue ที่จะเรียกใช้เมื่อค่าใน slider เปลี่ยน
        function displayValue() {
            display_range.innerHTML = input_r.value; // แสดงค่าของ slider
        }

        // ============================================ label switch ===========================================

        const div_switch = document.createElement('div');
        div_switch.className = 'switch mt-4'; // คลาส row สำหรับจัดเรียง
        div_switch.id = 'div_switch'; // คลาส row สำหรับจัดเรียง
        div_switch.hidden = true; // ซ่อน label

        const input_c = document.createElement('input');
        input_c.type = 'checkbox';
        input_c.id = 'input_switch';
        input_c.name = 'value_device';
        input_c.hidden = true;

        const span_ = document.createElement('span');
        span_.className = 'slider';

        div_switch.appendChild(input_c);
        div_switch.appendChild(span_);

        // ============================================= slide range ===========================================

        // สร้าง div สำหรับ range
        const div_range = document.createElement('div');
        div_range.className = 'row justify-content-center mt-3'; // คลาส row สำหรับจัดเรียง
        div_range.id = 'div_slide_range';

        // input slide range 
        const input_r = document.createElement('input');
        input_r.type = 'range';
        input_r.className = 'form-range';
        input_r.id = 'input_slide_range';
        input_r.name = 'value_device';
        input_r.min = '0'; // ค่าต่ำสุดของ slider
        input_r.max = '100'; // ค่าสูงสุดของ slider
        input_r.value = '50'; // ค่าตั้งต้นของ slider
        input_r.hidden = true; // ค่าตั้งต้นของ slider

        // display range value
        const display_range = document.createElement('div');
        display_range.className = 'text-dark text-center';
        display_range.id = 'display_slide_range';
        display_range.style = 'font-size: 3rem;';
        display_range.innerHTML = input_r.value;
        display_range.hidden = true;

        div_range.appendChild(display_range);
        div_range.appendChild(input_r);
        // ======================================================================================================

        // เพิ่ม event listener สำหรับเมื่อค่าใน slider เปลี่ยน
        input_r.addEventListener('input', displayValue);




        // เพิ่มหัวข้อและข้อความลงใน Card
        form.appendChild(cardimg);
        form.appendChild(cardTitle);
        form.appendChild(cardText);
        form.appendChild(dropdown_group);
        form.appendChild(dropdown_device);
        form.appendChild(dropdown_type);
        form.appendChild(dropdown_data);
        form.appendChild(div_switch);
        form.appendChild(div_range);
        form.appendChild(div_btn);

        cardDiv.appendChild(form);
        // เพิ่ม Card ลงใน contentContainer
        contentContainer.appendChild(cardDiv);



    });
</script>
<?php include "../include/script_type.html"; ?>