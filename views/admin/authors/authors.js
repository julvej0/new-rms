console.log(window.location.search);
function submitDelete(id){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "functionalities/authors_query/delete_author.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {

            if (xhr.responseText === "Success") {
                let queryString = window.location.search;
                const searchParams = new URLSearchParams(queryString);
                if (searchParams.has('delete')) {
                    searchParams.delete('delete');
                }
                window.location.href="?"+searchParams+"&delete=success";
               
            }
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Delete was Unsuccessful',
                    text: 'Something went wrong! Please try again later!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                    });
                    console.log(xhr.responseText)
            }
        }
    };
    xhr.send("id=" + id );

}


function confirmDelete(name, id){
    
    Swal.fire({
        title: 'Are you sure?',
        text: name + " will be deleted from authors. You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            submitDelete(id)
        } 
      });

   

}

let isRotated = false;
const buttonIcon = document.getElementById("button-icon");
const rbdContainer = document.getElementById("rdb-container");

function rotateButton() {
    
    

    if (isRotated) {
        buttonIcon.style.transform = "rotate(0deg)";
        rbdContainer.style.opacity = 0;
        setTimeout(() => {
            rbdContainer.style.display = "none";
        }, 300); // wait for transition to complete before hiding container
        isRotated = false;
    } else {
        buttonIcon.style.transform = "rotate(135deg)";
        rbdContainer.style.display = "block";
        setTimeout(() => {
            rbdContainer.style.opacity = 1;
        }, 0); // wait for display to update before starting transition
        isRotated = true;
    }
}


// FILTER
const allFilter = document.querySelectorAll('main .header .left .filter');
allFilter.forEach(item => {
    const filterBtn = item.querySelector('.btn');
    const filterLink = item.querySelector('.filter-link');
    const dropdownItems = item.querySelectorAll('a');

    filterBtn.addEventListener('click', (e) => {
        e.preventDefault();
        filterLink.classList.toggle('show');
    })

    dropdownItems.forEach(choices => {
        choices.addEventListener('click', () => {
            var icon = document.querySelector('.icon');
            const selected = choices.textContent;
            iconString = icon.toString();

            filterBtn.innerHTML = selected + "<i class='bx bx-chevron-down icon'></i>";
        });
    });
});

window.addEventListener('click', (e) => {
    allFilter.forEach(item => {
        const filterBtn = item.querySelector('.btn');
        const filterLink = item.querySelector('.filter-link');

        if(e.target !== filterBtn){
            if(e.target !== filterLink){
                if(filterLink.classList.contains('show')){
                    filterLink.classList.remove('show');
                }
            }
        }
    })
})


  
