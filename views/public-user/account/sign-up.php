<?php
include_once "../../../includes/public-user/templates/header.php";
include_once 'functionalities/modals.php';
?>
<link rel="stylesheet" href="../../../css/public-user/templates/sign-up.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<div id="whole_page">
        <div id="signup-container">
            <!-- sign up header -->
            <div id='container-header'>
                <h2>Create Account</h2>
            </div>
            <br>

            <!-- sign-up content -->
            <form id='user_input' action='sample_db/create-account.php' method='POST' >
                <label class='labelSubHeader'>SR CODE</label>
                <input id="srcode" name="srcode" placeholder="SR Code" type="text"><br>
                <label class='labelSubHeader'>EMAIL</label>
                <input id="email" name="emailAddress" placeholder="example@g.batstate-u.edu.ph" type="text">
                <span id="emailTooltip" style="display:none;color:red"></span><br>
                <label class='labelSubHeader'>PASSWORD</label>
                <div class='password_container'>
                    <input class="passwordInput" name="password1" placeholder="Password" type="password" maxlength='8'>
                    <i class="toggle-password2 fas fa-eye-slash"></i>

                </div>
                <br>
                <label class='labelSubHeader'>CONFIRM PASSWORD</label>
                <div class='password_container'>
                    <input id="confirmPasswordInput" name="password" placeholder="Confirm Password" type="password" maxlength='8'>
                    <i class="toggle-password2 fas fa-eye-slash"></i>
                </div>    
                <span id="passwordTooltip" style="display:none;color:red"></span>
                <br>
                <input name="submit" type="button" value="Sign Up" onclick='showModal()'>
                <br>
                <label id='labelSignUp'>Already have an account?<a id='a_SignUp' href='login.php'>&nbsp;Sign In</a></label>
                <br>
            </form>

            <!-- popup modal -->

            <div id="myModal" class="modal">  
                <div class="modal-container">
                    <div id="modal-header" > 
                        <h1>Confirm Account</h1>
                    </div> 
                    <form id="form-container" action='email_ver/page/sendcode.php' method='POST'> 
                        <span class="close">&times;</span>
                        <label>SR Code:</label>
                        <input id="userSrCode" type='text' value=''></input>
                        <br>
                        <label>Email</label>
                        <input id="userEmailAddressInput" type="text" name="email" value=''>
                        <input id="confirmedPassword" type="hidden" name="password" value=''>
                        <br>
                        <input id="otpVerification" type="text" name="otpBox" placeholder="Enter Your One Time Password" maxlength="6">
                        <button name="send" id='sendOtpLink' type='button'>SEND OTP</button>
                        <br>

                        <button name="confirm" id="btnSubmit" title="btnSubmit" type="button" onclick='confirmBtn()'>Confirm</button>
                    </form>
                </div>
            </div>

        </div>
</div>
<script src='../../../js/public-user/show-hide-password.js'></script>
<script src='../../../js/public-user/show-modal.js'></script>
<script src='../../../js/public-user/close-modal.js'></script>
<script src='../../../js/public-user/add-user-btn.js'></script>
<script src='../../../js/public-user/send-otp.js'></script>

<!-- modal function -->

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



<?php
include_once "../../../includes/public-user/templates/footer.php";
?>