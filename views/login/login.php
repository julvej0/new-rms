<?php
session_start();

if (isset($_SESSION['user_email'])) {
    if($_SESSION['account_type'] == "Admin"){
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

<link rel="stylesheet" href="login.css">

<!----------------------------------------------------------- login page ---------------------------------------------------------->
<div id="whole_page">
    <img src='./../../assets/images/background_img.jpg' style='opacity: 0.7; width: 100%; height: 100%; position:fixed;'/>
    <!-- <div style="width: 155px; height: 230px; background-color: white; position: fixed; bottom: 0; right: 0; margin-bottom: 20px; margin-right: 20px; z-index: 1; padding: 20px; border-radius: 50% / 20%;">
        <img src="../../../assets/images/redspartan_logo.png" style="width: 150px; height: 160px; position: fixed; bottom: 0; right: 0; margin-bottom: 50px; margin-right: 25px; z-index: 2; border-radius: 50% / 20%;">
    </div> -->

    <img src='./../../assets/images/batStateUNeu-logo.png' style='width: 100px; height: 100px; position: fixed; border:solid 3px #cf102d; background-color: white; border-radius: 50%; z-index: 1; transform: translate(-50%, -300%); top: 50%; left: 50%;'/>
<!----------------------------------------------------------- login header ---------------------------------------------------------->
    <div id="login_container">
        <div id='container-header'>
            <h2 id='h2Login'>SIGN IN</h2>
        </div>
        <br>
        <form onsubmit = "return checkdata()" id='user_input' action = "functionalities/login-account.php" method = "POST" >
            <div>
                <label class='labelSubHeader'>EMAIL</label>
                <input id="login_email" name="emailAddress" placeholder="example@g.batstate-u.edu.ph" type="text"><br>
                <label class='labelSubHeader'>PASSWORD</label>
                <div id='password_container'>
                    <input id="login_password" class="passwordInput" name="password" placeholder="Password" type="password" minlength='8' maxlength='16'>
                    <i class="toggle-password2 fas fa-eye-slash"></i>
                </div>  
                <br>
                <input name="login" type="submit" value=" LOGIN ">
                <div style="display: flex; align-items: center; margin-top: 10px; margin-bottom: 10px;">
                    <hr style="flex: 1; margin-right: 10px; border-top: 1px solid gray;">
                    <label style="text-align: center; color: gray;">OR</label>
                    <hr style="flex: 1; margin-left: 10px; border-top: 1px solid gray;">
                </div>

                <input type="button" onclick="window.location.href='./../signup/sign-up.php'" value="SIGN UP">
                <label id='labelSignUp'>Forgot Password?<a id='a_SignUp' onclick="showModal()">&nbsp;Click Here!</a></label>
                <br>
            </div>
        </form>
    </div>
</div>
<!------------------------------------------------- HTML code for change password modal ---------------------------------------------->
<div id="myModal" class="modal">
    <div class="modal-container">
        <span class="close">&times;</span>
        <h2 id='h2pass'>Change Password</h2>
        <form id="change-password-form" action='sample_db/change-password.php' method='POST'>
            <label for="current-password" class='labelSubHeader'>Email:</label>
            <div class='password-container'>
                <input type="text" id="userEmailAddressInput" name="email" placeholder='example@g.batstate-u.edu.ph' required>
            </div>
            <input id="otpVerification" type="text" name="otpBox" placeholder="Enter Your One Time Password" maxlength="6">
            <button name="send" id='sendOtpLink' type='button'>SEND OTP</button>
            <span id="emailTooltip" style="display:none;color:red"></span>
            <label for="new-password" class='labelSubHeader'>New Password:</label>
            <div class='password-container'>
                <input type="password" class="passwordInput" name="new-password" minlength='8' maxlength='16' required>
                <i class="toggle-password fas fa-eye-slash"></i>
            </div>  
            <label for="confirm-password" class='labelSubHeader'>Confirm Password:</label>
            <div class='password-container'>
                <input type="password" id="confirmPasswordInput" name="confirm-password" minlength='8' maxlength='16' required>
                <i class="toggle-password fas fa-eye-slash"></i>
            </div>
            <span id="passwordTooltip" style="display:none;color:red"></span>  
            <button name='confirm' type="button" id="submit-password" onclick='submitPss()'>Submit</button>
        </form>
    </div>
</div>

<!----------------------------------------------------------- SCRIPTS --------------------------------------------------------------->
<!-- <script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css"> -->
<script src='../helpers/show-hide-password.js'></script>
<script src='../helpers/close-modal.js'></script>
<script src='../../helpers/send-otp.js'></script>
<script src='../helpers/submit-password.js'></script>
<script src='login.js'></script>
<script src='../helpers/change-pass-with-otp.js'></script>

<?php
    include_once "functionalities/login_incorrect.php";
?>