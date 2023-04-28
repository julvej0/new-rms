// CANCEL MODAL

const cancelBtn = document.querySelector('.cancel-btn');

cancelBtn.addEventListener('click', (e) => {
  e.preventDefault();
  Swal.fire({
    title: 'Are you sure?',
    text: "You want to cancel?",
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes!'
    }).then((result) => {
    if (result.isConfirmed) {
        history.back(-1);
    }
    })
})

const submitBtn = document.querySelector('.submit-btn');

function checkData(){
    var name = document.getElementById("a-name").value;
    var gender = document.getElementById("a-gender").value;
    var role = document.getElementById("a-role").value;

    //Internal Affiliation
    var internal_dept = document.getElementsByClassName("a-aff-dept").length;
    var internal_prog = document.getElementsByClassName("a-aff-prog").length;
    var internal_camp = document.getElementsByClassName("a-aff-camp").length;
  
    //External Affiliation
    var external_aff = document.getElementsByClassName("a-ex-aff").length;

    if (internal_dept == 0 && internal_prog == 0 && internal_camp==0 && external_aff == 0){
      
        Swal.fire({
        title: 'Error',
        text: "Incomplete Author Details",
        icon: 'error'
        });

      return false;
    }

    else if (name == "" || gender == "" || role == ""){
      Swal.fire({
        title: 'Error',
        text: "Incomplete Author Details",
        icon: 'error'
        });
      return false;
    }
    else{
      return true;
    }
}
    

  
  