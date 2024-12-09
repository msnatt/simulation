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

        <div class=" col-10 c-3">
            <div id="contentContainer" class="row">

            </div>
        </div>
    </div>



    <div class="position-fixed" style="top: 90%; left: 95%;">
        <button class="circle-button" id="addDivButton">+</button>
    </div>

    <?php include "../components/footer.php"; ?>
    <?php include "../include/script_card.php"; ?>

</body>

</html>