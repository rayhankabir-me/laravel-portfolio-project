$(document).ready(function() {
    $('#VisitorDt').DataTable();
    $('.dataTables_length').addClass('bs-select');
});




/*.....admin panel get services data..........*/

function getServicesData() {
    axios.get('/getServicesData').then(function(response) {

        if (response.status == 200) {


            $('.serviceTable').empty();
            $('.spinner-container').addClass('d-none');

            let servicesData = response.data;
            $.each(servicesData, function(i, item) {
                $('<tr>').html("<th class='th-sm'><img class='table-img' src='" + servicesData[i].services_img + "'></th><th class='th-sm'>" + servicesData[i].services_name + "</th><th class='th-sm'>" + servicesData[i].services_desc + "</th><th class='th-sm'><a class='editBtn' data-id=" + servicesData[i].id + "><i class='fas fa-edit'></i></a></th><th class='th-sm'><a class='deleteBtn' data-id=" + servicesData[i].id + "><i class='fas fa-trash-alt'></i></a></th>").appendTo('.serviceTable');
            });

            /*.......delete button on click event..........*/

            $('.deleteBtn').click(function() {
                let serviceId = $(this).data('id');

                $('#serviceId').val(serviceId);

                $('#deleteModal').modal('show');
            });


            /*.......edit button on click event..........*/

            $('.editBtn').click(function() {
                let editServiceID = $(this).data('id');

                $('#editServiceID').val(editServiceID);
                singleServicesData(editServiceID);
                $('#editModal').modal('show');
            });



        } else {
            $('.spinner-container').addClass('d-none');
            $('.error-container').removeClass('d-none');
        }

    }).catch(function(error) {
        $('.spinner-container').addClass('d-none');
        $('.error-container').removeClass('d-none');
    })
}



/*.....admin panel delete servies data*/

$('#confirmationBtn').click(function() {

    $('#deleteModal').modal('hide');

    deleteServicesData();

    function deleteServicesData() {


        let inputID = $('#serviceId').val();

        axios.post('/deleteServicesData', {
                id: inputID,
            })
            .then(function(response) {

                if (response.data == 1) {

                    toastr.success('Data Deleted Successfully');
                    getServicesData();
                } else {
                    toastr.error('Data Delete Failed');
                }

            })
            .catch(function(error) {
                toastr.error('Data Delete Failed');
            });
    }

});


/*......get single services data for edit form..........*/

function singleServicesData(serviceId) {

    axios.post('/singleServicesData', {
        id: serviceId,
    }).then(function(response) {

        let jsonData = response.data;

        if (response.status == 200) {


            $('.edit-spinner').addClass('d-none');
            $('.edit-error').addClass('d-none');

            $('#serviceName').val(jsonData[0].services_name);
            $('#serviceDesc').val(jsonData[0].services_desc);
            $('#imageUrl').val(jsonData[0].services_img);
        } else {

            $('.edit-spinner').addClass('d-none');
            $('.edit-error').removeClass('d-none');

        }

    }).catch(function(error) {

        $('.edit-spinner').addClass('d-none');
        $('.edit-error').removeClass('d-none');
    })


}



/*........admin panel update services data.......*/

$('#saveBtn').click(function() {

    $('#saveBtn').html("<div class='spinner-border spinner-border-sm' role='status'>");

    let serviceId = $('#editServiceID').val();
    let serviceName = $('#serviceName').val();
    let serviceDesc = $('#serviceDesc').val();
    let imageUrl = $('#imageUrl').val();
    updateServicesData(serviceId, serviceName, serviceDesc, imageUrl);


});


function updateServicesData(serviceId, serviceName, serviceDesc, imageUrl) {



    axios.post('/updateServicesData', {
            serviceid: serviceId,
            servicename: serviceName,
            serviedesc: serviceDesc,
            serviceimage: imageUrl
        })
        .then(function(response) {



            if (response.status == 200) {

                if (response.data == 1) {

                    $('#editModal').modal('hide');
                    getServicesData();
                    toastr.success('Data Updated Successfully');
                    $('#saveBtn').html("Save");

                } else {
                    $('#editModal').modal('hide');
                    toastr.error('Data Update Failed');
                }

            } else {

                $('#editModal').modal('hide');
                toastr.error('Data Update Failed');

            }


        })
        .catch(function(error) {
            toastr.error('Something Went Wrong!');
        })
}


/*........add new services item.........*/


$('#addBtn').click(function() {

    let serviceName = $('#addName').val("");
    let serviceDesc = $('#addDesc').val("");
    let imageUrl = $('#addImg').val("");

    $('#addModal').modal('show');



});



$('#addDataBtn').click(function() {

    $(this).html("<div class='spinner-border spinner-border-sm' role='status'>");


    let serviceName = $('#addName').val();
    let serviceDesc = $('#addDesc').val();
    let imageUrl = $('#addImg').val();
    addServiceData(serviceName, serviceDesc, imageUrl);


});


function addServiceData(serviceName, serviceDesc, imageUrl) {



    axios.post('/addServices', {
            servicename: serviceName,
            serviedesc: serviceDesc,
            serviceimage: imageUrl
        })
        .then(function(response) {



            if (response.status == 200) {

                if (response.data == 1) {

                    $('#addModal').modal('hide');
                    getServicesData();
                    toastr.success('Service Item Added Successfully');

                    $('#addDataBtn').html("Save");

                } else {
                    $('#addModal').modal('hide');
                    toastr.error('Data Save Failed');
                }

            } else {

                $('#addModal').modal('hide');
                toastr.error('Data Save Failed');

            }


        })
        .catch(function(error) {
            toastr.error('Something Went Wrong!');
        })
}