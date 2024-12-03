<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>

<script>
    // JavaScript สำหรับเพิ่ม div
    document.addEventListener('DOMContentLoaded', async function() {


        const response_value = await fetch('../config/dropdown_value.php'); // เรียกใช้ PHP
        const options_value = await response_value.json(); // รับผลลัพธ์เป็น JSON

        let count_round = 0;
        console.log("length : " + options_value.length);

        while (count_round < options_value.length) {

            const item_ = options_value[count_round];
            console.log(item_);

            const contentContainer = document.getElementById('contentContainer');

            <?php include "../include/div_dropdown.js"; ?>
            form.action = '../config/update_value_device.php'; // URL ที่จะส่งข้อมูล
            btn_.value = 'Update'; // กำหนดข้อความในปุ่ม


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

            // เรียกใช้ฟังก์ชันสำหรับแต่ละ dropdown
            fetchAndPopulateDropdown('../config/dropdown_group.php', dropdown_group, item_['group_id']);
            fetchAndPopulateDropdown('../config/dropdown_device.php', dropdown_device, item_['device_id']);
            fetchAndPopulateDropdown('../config/dropdown_type.php', dropdown_type, item_['type_id']);
            fetchAndPopulateDropdown('../config/dropdown_data.php', dropdown_data, item_['data_id']);



            // เพิ่มหัวข้อและข้อความลงใน Card
            form.appendChild(cardimg);
            form.appendChild(cardTitle);
            form.appendChild(cardText);
            form.appendChild(dropdown_group);
            form.appendChild(dropdown_device);
            form.appendChild(dropdown_type);
            form.appendChild(dropdown_data);
            // form.appendChild(label_);
            // form.appendChild(div_range);
            form.appendChild(div_btn);

            cardDiv.appendChild(form);
            // เพิ่ม Card ลงใน contentContainer
            contentContainer.appendChild(cardDiv);

            // เพิ่มรอบ ตาม value_device
            count_round = count_round + 1;

        }

    });
</script>