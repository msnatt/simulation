<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>

<script>
    <?php include "../components/functions.js"; ?>
    let item_ = '';
    const switch_ = document.getElementById('update_switch');
    let submissionInterval;


    // JavaScript สำหรับเพิ่ม div
    document.addEventListener('DOMContentLoaded', async function() {

        let form_data_length = <?php echo $form_data_length; ?>;
        const contentContainer = document.getElementById('contentContainer');

        const response_value = await fetch('../config/dropdown_value.php'); // เรียกใช้ PHP
        const options_value = await response_value.json(); // รับผลลัพธ์เป็น JSON

        let count_round = 0;

        while (count_round < options_value.length) {
            item_ = options_value[count_round];

            if (item_.is_deleted === "0") {

                <?php include "../include/div_dropdown.js"; ?>

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




        console.log("page is loaded.");

        if (switch_.checked) {
            console.log(' >>> Start Upload form. [Onload] <<<');
            toggleSwitch(true);
            console.log("START form length [Onload] : " + form_data_length);
            startFormSubmission(form_data_length); // เริ่มส่งฟอร์ม
        } else {
            console.log(' >>> Stop Upload form. [Onload] <<<');
            <?php $form_data_length = 0; ?>
            console.log("STOP form length [Onload] : " + form_data_length);
            toggleSwitch(false);
            stopFormSubmission(); // หยุดการส่งฟอร์ม
        }
    });

    switch_.addEventListener('change', async () => {

        let form_data_length = <?php echo $form_data_length; ?>;
        if (switch_.checked) {
            console.log(' >>> Start Upload form. [Change] <<<');
            toggleSwitch(true);
            console.log("START form length [Change] : " + form_data_length);
            startFormSubmission(form_data_length); // เริ่มส่งฟอร์ม
        } else {
            console.log(' >>> Stop Upload form. [Change] <<<');
            <?php $form_data_length = 0; ?>
            console.log("STOP form length [Change] : " + form_data_length);
            toggleSwitch(false);
            stopFormSubmission(); // หยุดการส่งฟอร์ม
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
</script>