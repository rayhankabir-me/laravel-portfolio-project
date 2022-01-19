$(document).ready(function() {
    $('#VisitorDt').DataTable();
    $('.dataTables_length').addClass('bs-select');
});







//admin panel contacts section javascript


/*......get contacts data.......*/
function getContactData() {

    axios.get('/getContactsData').then(function(response) {

            if (response.status == 200) {


                $('#ContactDataTable').DataTable().destroy();
                $('.contactsTable').empty();
                $('.contact-spninner').addClass('d-none');
                let contactsData = response.data;



                $.each(contactsData, function(i, item) {

                    $('<tr>').html('<th class="th-sm">' + contactsData[i].name + '</th><th class="th-sm">' + contactsData[i].phone + '</th><th class="th-sm">' + contactsData[i].email + '</th><th class="th-sm">' + contactsData[i].message + '</th><th class="th-sm"><a class="contactDeleteBtn" data-id=' + contactsData[i].id + ' ><i class="fas fa-trash-alt"></i></a></th>').appendTo('.contactsTable');


                    /*.......Contact Delete Button On Click Event..........*/

                    $('.contactDeleteBtn').click(function() {
                        let contactId = $(this).data('id');

                        $('#contactDeleteId').val(contactId);

                        $('#ContactDeleteModal').modal('show');
                    });





                    /*...building data table....*/
                    $('#ContactDataTable').DataTable();
                    $('.dataTables_length').addClass('bs-select');


                })
            } else {

                $('.contact-spninner').addClass('d-none');
                $('.contact_error-container').removeClass('d-none');
            }
        })

        .catch(function(error) {

            $('.contact-spninner').addClass('d-none');
            $('.contact_error-container').removeClass('d-none');

        })
}



/*.........Contact Delete Data.......*/

$('#contactDeleteConfirmatinBtn').click(function() {

    $('#ContactDeleteModal').modal('hide');

    deleteContactData();

    function deleteContactData() {


        let inputID = $('#contactDeleteId').val();

        axios.post('/deleteContactsData', {
                id: inputID,
            })
            .then(function(response) {

                if (response.data == 1) {

                    toastr.success('Data Deleted Successfully');
                    getContactData();
                } else {
                    toastr.error('Data Delete Failed');
                }

            })
            .catch(function(error) {
                toastr.error('Something Went Wrong!');
            });
    }

});