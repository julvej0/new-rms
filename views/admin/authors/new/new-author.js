// find cancel button from page
const cancelBtn = document.querySelector(".cancel-btn");

//if cancel button is clicked
cancelBtn.addEventListener("click", (e) => {
    e.preventDefault();
    Swal.fire({
        title: "Are you sure?",
        text: "You want to cancel?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "../authors.php";
        }
    });
});

//find submit button from page
const submitBtn = document.querySelector(".submit-btn");

//checking if name exists from database
function checkIfExist(name, callback) {
    var xhr = new XMLHttpRequest();
    url = `../functionalities/authors_query/checkExist_author.php?author_name=${name}`;
    xhr.open("GET", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.responseText == "Exists") {
                callback(true);
            } else {
                callback(false);
            }
        }
    };
    xhr.send();
}

//error handling for new author form
function checkData(event) {
    event.preventDefault(); // prevent form submission

    var name = document.getElementById("a-name").value;
    var gender = document.getElementById("a-gender").value
    var role = document.getElementById("a-role").value;
    var id = document.getElementById("a-id").value;
    var email = document.getElementById("a-email").value;

    console.log(id);

    //Internal Affiliation
    var internal_dept = document.getElementsByClassName("a-aff-dept").length;
    var internal_prog = document.getElementsByClassName("a-aff-prog").length;
    var internal_camp = document.getElementsByClassName("a-aff-camp").length;

    //External Affiliation
    var external_aff = document.getElementsByClassName("a-ex-aff").length;

    if (
        (internal_dept == 0 &&
            internal_prog == 0 &&
            internal_camp == 0 &&
            external_aff == 0) ||
        gender == "" ||
        role == "" ||
        email == ""
    ) {
        Swal.fire({
            title: "Are you sure?",
            text: "The author information you provided is incomplete. Save anyways?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
        }).then((result) => {
            if (result.isConfirmed) {
                if (id == "") {
                    //pop up when exist
                    checkIfExist(name, function (exists) {
                        if (exists) {
                            Swal.fire({
                                title: "Error",
                                text: "The author name you are trying to add is already existing!",
                                icon: "error",
                            });
                        } else {
                            document.forms["form-author"].submit(); // submit the form when author does not exist
                        }
                    });
                } else {
                    document.forms["form-author"].submit(); // submit the form when edit
                }
            } else {
                return false;
            }
        });
    } else {
        document.forms["form-author"].submit();
    }
}
