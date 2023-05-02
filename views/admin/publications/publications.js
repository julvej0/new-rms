// DELETE MODAL
        $('.delete-btn').click(function() {
            var publicationId = $(this).data('publication-id');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this record!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "publication-delete.php",
                        type: "POST",
                        data: { id: publicationId },
                        success: function(response) {
                            swal("Record has been deleted!", {
                                icon: "success",
                            });
                            // remove the deleted row from the table
                            $('tr[data-publication-id="' + pubId + '"]').remove();
                        },
                        error: function() {
                            swal("Oops", "Something went wrong!", "error");
                        }
                    });
                } else {
                    swal("Your record is safe!");
                }
            });
        });