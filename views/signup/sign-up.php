<title>RMS | SIGN UP</title>
<?php

session_start();

if (isset($_SESSION['user_email'])) {
    if ($_SESSION['account_type'] == "Admin") {
        // header("Location: ../../../views/admin/dashboard/dashboard.php");
        header("Location: " . dirname(__FILE__, 3) . "/views/admin/dashboard/dashboard.php");
        exit;
    } else {
        // header("Location: ../../../views/public-user/home/home.php");
        header("Location: " . dirname(__FILE__, 3) . "/views/public-user/home/home.php");
        exit;
    }
}else{
    include_once dirname(__FILE__, 3) . "/components/header/header.php";
}

?>
<link rel="stylesheet" href="sign-up.css">


<!----------------------------------------------------------- sign up page ---------------------------------------------------------->
<div id="whole_page">
    <!-- <img src="../../../assets/images/redspartan_logo.png" style="width: 150px; height: 170px; position: fixed; bottom: 0; right: 0; margin-bottom: 50px; margin-right: 25px; border-radius: 50% / 20%;"> -->

    <!----------------------------------------------------------- sign up header -------------------------------------------------------->
    <div id="signup-container">
        <img src='./../../assets/images/batStateUNeu-logo.png'
            style='width: 90px; height: 90px; position: fixed; border:solid 3px #cf102d; background-color: white; border-radius: 50%; z-index: 1; transform: translate(-50%, -490%); top: 50%; left: 50%;' />
        <div id='container-header'>
            <h2 id='h2Login'>Create Account</h2>
        </div>
        <br>

        <!----------------------------------------------------------- sign-up content ------------------------------------------------------->

        <form id='user_input' action='sample_db/create-account.php' method='POST'>
            <label class="labelSubHeader">FIRST NAME</label>
            <input id="fName" name="fName" placeholder="Juan" type="text"><br>
            <div class="user-name">
                <div>
                    <label class="labelSubHeader2">MIDDLE NAME</label>
                    <input id="mName" name="mName" placeholder="De Castro" type="text">
                </div>
                <div>
                    <label class="labelSubHeader2">LAST NAME</label>
                    <input id="lName" name="lName" placeholder="De la Cruz" type="text">
                </div>

            </div><br>

            <label class='labelSubHeader'>SR CODE</label>
            <input id="srcode" name="srcode" placeholder="12-34567" type="text" maxlength='8'><br>
            <label class='labelSubHeader'>EMAIL</label>
            <input id="email" name="emailAddress" placeholder="example@g.batstate-u.edu.ph" type="text">
            <span id="emailTooltip" style="display:none;color:red"></span><br>
            <label class='labelSubHeader'>PASSWORD</label>
            <div class='password_container'>
                <input class="passwordInput" name="password1" placeholder="Password" type="password" minlength="8"
                    maxlength='16'>
                <i class="toggle-password2 fas fa-eye-slash"></i>

            </div>
            <br>
            <label class='labelSubHeader'>CONFIRM PASSWORD</label>
            <div class='password_container'>
                <input id="confirmPasswordInput" name="password" placeholder="Confirm Password" type="password"
                    minlength="8" maxlength='16'>
                <i class="toggle-password2 fas fa-eye-slash"></i>
            </div>
            <span id="passwordTooltip" style="display:none;color:red"></span>
            <br>
            <input name="submit" type="button" id="pass" value="SIGN UP" onclick='showModal()'>
            <br>
            <label id='labelSignUp'>Already have an account?<a id='a_SignUp' href='../login/login.php'>&nbsp;Sign In</a></label>
            <br>
        </form>

        <!------------------------------------------------ popup modal ---------------------------------------------------------------------->

        <div id="myModal" class="modal" style='z-index:9999;'>
            <div class="modal-container">
                <div id="modal-header">
                    <h1>Confirm Account</h1>
                </div>
                <form id="form-container" action='email_ver/page/sendcode.php' method='POST'>

                    <span class="close">&times;</span>
                    <br>
                    <br>
                    <label class='labelSubHeader'>NAME</label>
                    <input id="userFullName" type="text" name="name" value=''>
                    <label class='labelSubHeader'>SR CODE</label>
                    <input id="userSrCode" type='text' value=''></input>
                    <label class='labelSubHeader'>EMAIL</label>
                    <input id="userEmailAddressInput" type="text" name="email" value=''>
                    <input id="confirmedPassword" type="hidden" name="password" value=''>
                    <br>
                    <input id="otpVerification" type="text" name="otpBox" placeholder="Enter Your One Time Password"
                        maxlength="6">
                    <button name="send" id='sendOtpLink' type='button'>SEND OTP</button>
                    <br>

                    <button name="confirm" id="btnSubmit" title="btnSubmit" type="button"
                        onclick='signUpConfirmBtn()'>Confirm</button>
                </form>
            </div>
        </div>

    </div>
</div>

<!--------------------------------------------------------- script files ------------------------------------------------------------->

<script src='../helpers/show-hide-password.js'></script>
<script src='./functionalities/show-modal.js'></script>
<script src='../helpers/close-modal.js'></script>
<script src='./functionalities/add-user-btn.js'></script>
<script src='../../helpers/send-otp.js'></script>

<!-------------------------------------------------------- disable buttons on modal -------------------------------------------------->
<script>
    var disableotpInput = document.getElementById("otpVerification");
    var disableconfirmBtn = document.getElementById("btnSubmit");
    var disableEmailAddress = document.getElementById('userEmailAddressInput');
    var disableSrCode = document.getElementById('userSrCode');

    // Disable confirm button initially
    disableotpInput.disabled = true;
    disableconfirmBtn.disabled = true;
    disableSrCode.disabled = true;
    disableEmailAddress.disabled = true;
    disableconfirmBtn.style.backgroundColor = "gray";
    disableconfirmBtn.style.pointerEvents = "none";

    disableotpInput.addEventListener("input", () => {
        if (disableotpInput.value === "") {
            disableconfirmBtn.disabled = true;
            disableconfirmBtn.style.backgroundColor = "gray";
            disableconfirmBtn.style.pointerEvents = "none";
        } else {
            disableconfirmBtn.disabled = false;
            disableconfirmBtn.style.backgroundColor = "";
            disableconfirmBtn.style.pointerEvents = "auto";
        }
    });

</script>