<!DOCTYPE html>
<html lang="en">

<?php session_start(); ?>
<?php include "../include/ref.html"; ?>
<?php include "../include/style.html"; ?>


<body class="bg-custom ">
    <?php include "../components/header.php"; ?>
    <div class="row" style="min-height: 90vh;">
        <div class="col-2 c-2">
            <div class="btn d-flex justify-content-center align-items-center mt-3" style="height: 70px;">
                <a href="#">Dashboard</a>
            </div>
            <div class="btn d-flex justify-content-center align-items-center mt-3" style="height: 70px;">
                <a href="#">Manager</a>
            </div>
            <div class="btn d-flex justify-content-center align-items-center mt-3" style="height: 70px;">
                <a href="#">Group Manager</a>
            </div>
            <div class="btn d-flex justify-content-center align-items-center mt-3" style="height: 70px;">
                <a href="#">Device Manager</a>
            </div>
            <div class="btn d-flex justify-content-center align-items-center mt-3" style="height: 70px;">
                <a href="#">Data Manager</a>
            </div>
        </div>
        <div class=" col-10 c-3">
            <div id="contentContainer" class="row">

            </div>
        </div>
    </div>



    <div class="position-fixed" style="top: 90%; left: 95%;">
        <button class="circle-button" id="addDivButton">+</button>
    </div>

    <?php include "../components/footer.php"; ?>
    <?php include "../include/scriptjs.php"; ?>
    <?php include "../include/script_addcontent.php"; ?>

</body>

</html>