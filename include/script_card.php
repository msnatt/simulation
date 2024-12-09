<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>

<script>
    <?php include "../components/functions.js"; ?>
    let item_ = '';
    // JavaScript สำหรับเพิ่ม div
    document.addEventListener('DOMContentLoaded', async function() {


        const response_value = await fetch('../config/dropdown_value.php'); // เรียกใช้ PHP
        const options_value = await response_value.json(); // รับผลลัพธ์เป็น JSON

        let count_round = 0;

        while (count_round < options_value.length) {
            item_ = options_value[count_round];

            if (item_.is_deleted === "0") {
                const contentContainer = document.getElementById('contentContainer');

                <?php include "../include/div_dropdown.js"; ?>
                // form.action = '../config/api_to_db.php'; // URL ที่จะส่งข้อมูล

                // set switch on/off form db
                if (item_.type_id === "4" || item_.type_id == "2") {
                    if (item_.value === "1") {
                        input_c.checked = true;
                        UpdateDisplayValue(display_value, "ON");
                        UpdateInputValue(output_, 1);
                    } else if (item_.value === "0") {
                        input_c.checked = false;
                        UpdateDisplayValue(display_value, "OFF");
                        UpdateInputValue(output_, 0);
                    }
                } else {
                    input_r.value = item_.value;
                    UpdateDisplayValue(display_value, item_.value);
                    UpdateInputValue(output_, item_.value);
                }

                // ดึงค่ามาจาก db
                await Promise.all([
                    fetchAndPopulateDropdown('../config/dropdown_group.php', dropdown_group, item_['group_id']),
                    fetchAndPopulateDropdown('../config/dropdown_device.php', dropdown_device, item_['device_id']),
                    fetchAndPopulateDropdown('../config/dropdown_type.php', dropdown_type, item_['type_id']),
                    fetchAndPopulateDropdown('../config/dropdown_data.php', dropdown_data, item_['data_id']),
                ]);

                <?php include "../include/appendChild.js"; ?>

                // เพิ่มรอบ ตาม value_device
                type_show_value(dropdown_type, cardDiv.id);

            }

            count_round++;

        }
    });



    // JavaScript สำหรับเพิ่ม div
    document.getElementById('addDivButton').addEventListener('click', async function() {


        const response_value = await fetch('../config/dropdown_value.php'); // เรียกใช้ PHP
        const options_value = await response_value.json(); // รับผลลัพธ์เป็น JSON

        item_.id = parseInt(options_value[options_value.length - 1].id) + 1;

        const contentContainer = document.getElementById('contentContainer');


        <?php include "../include/div_dropdown.js"; ?>
        cardTitle.textContent = "New Device";
        cardText.textContent = "This is description of new device.";
        edit_Title.value = "New Device";
        edit_desc.value = "This is description of new device.";
        <?php include "../components/functions.js"; ?>

        await Promise.all([
            fetchAndPopulateDropdown('../config/dropdown_group.php', dropdown_group),
            fetchAndPopulateDropdown('../config/dropdown_device.php', dropdown_device),
            fetchAndPopulateDropdown('../config/dropdown_type.php', dropdown_type),
            fetchAndPopulateDropdown('../config/dropdown_data.php', dropdown_data),
        ]);

        <?php include "../include/appendChild.js"; ?>

        type_show_value(dropdown_type, cardDiv.id);

        console.log('Add Monitor[' + item_.id + '] success.');

    });

    const switch_ = document.getElementById('update_switch');
    switch_.addEventListener('change', async () => {

        console.log('=========== now switch is ' + switch_.checked + ' ==========');

        while (switch_.checked) {
            let count = 0;
            const forms = document.getElementById('contentContainer').querySelectorAll('[id^="form_"]');
            for (const form of forms) {

                const formData = new FormData(form);

                // const idCardElement = form.querySelector('#id_card');
                // console.log('id_card : ' + idCardElement.value);

                // ส่งข้อมูลไปยังเซิร์ฟเวอร์
                try {
                    const response = await fetch('../config/api_to_db.php', {
                        method: 'POST',
                        body: formData,
                    });
                } catch (error) {}


                count++;
                console.log('form ที่ ' + count + ' ส่งสำเร็จ')
            }
            console.log('การส่งฟอร์มทั้งหมดเสร็จสิ้น');
            await delay(4000);
        }
    });
</script>