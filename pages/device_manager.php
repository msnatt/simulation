<?php include "../config/no-crash.php"; ?>

<!DOCTYPE html>
<html lang="en">

<?php require "../include/state_switch.php"; ?>
<?php include "../include/ref.html"; ?>
<?php include "../include/style.html"; ?>


<body class="bg-custom ">
    <?php include "../components/header.php"; ?>
    <div class="row" style="min-height: 90vh;">

        <?php include "../components/Side_menu.php"; ?>

        <div class="d-flex col-10 justify-content-center align-items-center c-3">
            <div class="d-flex box" style="width: 50vw; height: 50vh;">
                <div class="" style="width: 60%;">
                    <div class="row">
                        <label class="f-4 text-center ">List Device</label>

                        <?php include "../components/fetch_device.php"; ?>
                    </div>
                </div>
                <div style="width: 40%;">
                    <form action="../config/create_device.php" method="post" id="create_device" class="form-control h-100 w-100">
                        <div class="row mt-3">
                            <label class="text-center f-5 t-3 fw-bold">New Device</label>
                            <div class=" text-start align-self-center mt-4">
                                <label class="form-label t-2 f-2">Name</label>
                            </div>
                            <div class="">
                                <input id="input_create_device_id" name="input_create_device_id" class="form-control">
                            </div>
                            <div class="mt-3 text-end">
                                <input id="submit_form" name="submit_form" type="submit" value="Create" class="btn c-3 t-2 border border-2">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div id="contentContainer" class="row" hidden>

        </div>
    </div>



    <div class="position-fixed" style="top: 90%; left: 95%;">
        <button class="circle-button" id="addDivButton">+</button>
    </div>

    <?php include "../components/footer.php"; ?>
    <?php include "../include/script_card.php"; ?>

</body>

</html>