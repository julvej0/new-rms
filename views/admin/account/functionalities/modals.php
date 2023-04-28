<link rel="stylesheet" href="popup-modal.css">
<?php
    $errorType = "";
    $errorMessage = "";
    if(isset($_GET['error'])){
        switch ($_GET['error']){
            case "incomplete":
                $errorType="Error";
                $errorMessage="The information you provided is incomplete!";
                break;
            case "srcode":
                $errorType="Error";
                $errorMessage="Existing SRCode, Please Try Again!";
                break;
            case "email":
                $errorType="Error";
                $errorMessage="Existing Email, Please Try Again!";
                break;
            case "wrong":
                $errorType="Error";
                $errorMessage="Account doesn't exist, Please Try Again";
                break;

            

        }
            
    }
    if(isset($_GET['edit'])){
        switch ($_GET['edit']){
            case "success":
                $errorType="Success";
                $errorMessage="The author is successfully updated!";
                break;
            case "failed":
                $errorType="Failed";
                $errorMessage="The author is was not updated!";
                break;
            case "successful":
                $errorType="Success";
                $errorMessage="Password updated successfully.";
                break;
            case "error":
                $errorType="Error";
                $errorMessage="Error updating password.";
                break;


        }
            
    }
    if(isset($_GET['add'])){
        switch ($_GET['add']){
            case "success":
                $errorType="Success";
                $errorMessage="The author is successfully added!";
                break;
            case "failed":
                $errorType="Failed";
                $errorMessage="The author is was not added!";
                break;
            case "correct":
                $errorType="Success";
                $errorMessage="Account Created Successfully!";

        }
            
    }
    if(isset($_GET['delete'])){
        switch ($_GET['delete']){
            case "success":
                $errorType="Success";
                $errorMessage="The author is successfully removed!";
                break;
            case "failed":
                $errorType="Failed";
                $errorMessage="The author is was not removed!";
                break;


        }
            
    }
?>
<?php if(isset($_GET['error'])||isset($_GET['edit'])||isset($_GET['add'])||isset($_GET['delete'])){?>
<div id="notif-popUp" class="popUp-modal">
        <!-- Modal content -->
        <div class="popUp-modal-content">
            <span class="popUp-close" id="span">&times;</span>
            <br><br>
            <div class="popUp-modal-form-container">
                <div id="popUp-container">
                    <label class='popUp-label'><?=$errorType?></label>
                    <hr><br>
                    <p><?=$errorMessage?></p>
                    <br><br>
                    <div class="popUp-foot-containers" style="text-align: center;">
                        <button class="popUp-ok-btn" id="btnOK">OKAY</button>
                    </div>

                </div>
            </div>
           
        </div>
    </div>
<?php } ?>
<script>
    var notif_modal = document.getElementById("notif-popUp");
    <?php
        if(isset($_GET['error'])||isset($_GET['edit'])||isset($_GET['add'])||isset($_GET['delete'])){
            echo 'notif_modal.style.display = "block";';
        }
    ?>
    // Get the <span> element that closes the modal
    var span = document.getElementById("span");
    var btnClose = document.getElementById("btnOK");


    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        notif_modal.style.display = "none";
    }

    btnClose.onclick = function() {
        notif_modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
    if (event.target == modal) {
        notif_modal.style.display = "none";
        }
    }

</script>


