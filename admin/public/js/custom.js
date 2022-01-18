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





//admin panel courses section javascript


/*......get courses data.......*/


function getCoursesData(){

    axios.get('/getCoursesData').then(function(response){

        if(response.status == 200){


            $('#CourseDataTable').DataTable().destroy();
            $('.coursesTable').empty();
            $('.course-spninner').addClass('d-none');
            let coursesData = response.data;

            

            $.each(coursesData, function(i, item){

                $('<tr>').html('<th class="th-sm">'+ coursesData[i].course_name +'</th><th class="th-sm">'+ coursesData[i].course_fee +'</th><th class="th-sm">'+ coursesData[i].course_totalenroll +'</th><th class="th-sm">'+ coursesData[i].course_totalclass +'</th><th class="th-sm"><a class="courseViewDetailsBtn" data-id='+ coursesData[i].id +' ><i class="fas fa-eye"></i></a></th><th class="th-sm"><a class="courseEditBtn" data-id='+ coursesData[i].id +' ><i class="fas fa-edit"></i></a></th><th class="th-sm"><a class="courseDeleteBtn" data-id='+ coursesData[i].id +' ><i class="fas fa-trash-alt"></i></a></th>').appendTo('.coursesTable');


            /*.......Course Delete Button On Click Event..........*/

            $('.courseDeleteBtn').click(function() {
                let courseId = $(this).data('id');

                $('#courseDeleteId').val(courseId);

                $('#CourseDeleteModal').modal('show');
            });


            /*.......Course Edit Button On Click Event..........*/

            $('.courseEditBtn').click(function() {
                let editCourseID = $(this).data('id');

                $('#editCourseIdvalue').val(editCourseID);
                singleCoursesData(editCourseID);
                $('#editCourseModal').modal('show');
            });


            /*...building data table....*/
            $('#CourseDataTable').DataTable();
            $('.dataTables_length').addClass('bs-select');


            })
        }else{

            $('.course-spninner').addClass('d-none');
            $('.course_error-container').removeClass('d-none');
        }
    })

    .catch(function(error){

            $('.course-spninner').addClass('d-none');
            $('.course_error-container').removeClass('d-none');
        
    })
}


/*......add courses data........*/


$('#addNewCourseBTn').click(function() {

    let coursename = $('#CourseNameId').val("");
    let coursedesc = $('#CourseDesId').val("");
    let coursefee = $('#CourseFeeId').val("");
    let courseenroll = $('#CourseEnrollId').val("");
    let courseclass = $('#CourseClassId').val("");
    let courselink = $('#CourseLinkId').val("");
    let courseimg = $('#CourseImgId').val("");

    $('#addCourseModal').modal('show');



});



$('#CourseAddConfirmBtn').click(function() {

    $(this).html("<div class='spinner-border spinner-border-sm' role='status'>");


    let coursename = $('#CourseNameId').val();
    let coursedesc = $('#CourseDesId').val();
    let coursefee = $('#CourseFeeId').val();
    let courseenroll = $('#CourseEnrollId').val();
    let courseclass = $('#CourseClassId').val();
    let courselink = $('#CourseLinkId').val();
    let courseimg = $('#CourseImgId').val();
    addCoursesData(coursename, coursedesc, coursefee, courseenroll, courseclass, courselink, courseimg);


});


function addCoursesData(coursename, coursedesc, coursefee, courseenroll, courseclass, courselink, courseimg) {



    axios.post('/addCourses', {
            coursename: coursename,
            coursedesc: coursedesc,
            coursefee: coursefee,
            courseenroll: courseenroll,
            courseclass: courseclass,
            courselink: courselink,
            courseimg: courseimg,
        })
        .then(function(response) {



            if (response.status == 200) {

                if (response.data == 1) {

                    $('#addCourseModal').modal('hide');
                    getCoursesData();
                    toastr.success('Course Item Added Successfully');

                    $('#CourseAddConfirmBtn').html("Save");

                } else {
                    $('#addCourseModal').modal('hide');
                    toastr.error('Data Save Failed');
                }

            } else {

                $('#addCourseModal').modal('hide');
                toastr.error('Data Save Failed');

            }


        })
        .catch(function(error) {
            toastr.error('Something Went Wrong!');
        })
}




/*.........Course Delete Data.......*/

$('#courseDeleteConfirmatinBtn').click(function() {

    $('#CourseDeleteModal').modal('hide');

    deleteCourseData();

    function deleteCourseData() {


        let inputID = $('#courseDeleteId').val();

        axios.post('/deleteCoursesData', {
                id: inputID,
            })
            .then(function(response) {

                if (response.data == 1) {

                    toastr.success('Data Deleted Successfully');
                    getCoursesData();
                } else {
                    toastr.error('Data Delete Failed');
                }

            })
            .catch(function(error) {
                toastr.error('Something Went Wrong!');
            });
    }

});



/*......Get Single Course Data For Update Form..........*/

function singleCoursesData(courseId) {

    axios.post('/singleCoursesData', {
        id: courseId,
    }).then(function(response) {

        let jsonData = response.data;

        if (response.status == 200) {


            $('.editCourse-spinner').addClass('d-none');
            $('.edit-error').addClass('d-none');

            $('#CourseEditNameId').val(jsonData[0].course_name);
            $('#CourseEditDesId').val(jsonData[0].course_desc);
            $('#CourseEditFeeId').val(jsonData[0].course_fee);
            $('#CourseEditEnrollId').val(jsonData[0].course_totalenroll);
            $('#CourseEditClassId').val(jsonData[0].course_totalclass);
            $('#CourseEditLinkId').val(jsonData[0].course_link);
            $('#CourseEditImgId').val(jsonData[0].course_img);
        } else {

            $('.editCourse-spinner').addClass('d-none');
            $('.editCourse-error').removeClass('d-none');

        }

    }).catch(function(error) {

        $('.editCourse-spinner').addClass('d-none');
        $('.editCourse-error').removeClass('d-none');
    })


}



/*........admin panel update services data.......*/

$('#CourseEditConfirmBtn').click(function() {

    $(this).html("<div class='spinner-border spinner-border-sm' role='status'>");

    let courseEditId = $('#editCourseIdvalue').val();
    let CourseEditNameId = $('#CourseEditNameId').val();
    let CourseEditDesId = $('#CourseEditDesId').val();
    let CourseEditFeeId = $('#CourseEditFeeId').val();
    let CourseEditEnrollId = $('#CourseEditEnrollId').val();
    let CourseEditClassId = $('#CourseEditClassId').val();
    let CourseEditLinkId = $('#CourseEditLinkId').val();
    let CourseEditImgId = $('#CourseEditImgId').val();
    
    updateCoursesData(courseEditId, CourseEditNameId, CourseEditDesId, CourseEditFeeId, CourseEditEnrollId, CourseEditClassId, CourseEditLinkId, CourseEditImgId);


});


function updateCoursesData(courseEditId, CourseEditNameId, CourseEditDesId, CourseEditFeeId, CourseEditEnrollId, CourseEditClassId, CourseEditLinkId, CourseEditImgId) {



    axios.post('/updateCoursesData', {
            courseid: courseEditId,
            coursename: CourseEditNameId,
            coursedesc: CourseEditDesId,
            coursefee: CourseEditFeeId,
            courseenroll: CourseEditEnrollId,
            courseclass: CourseEditClassId,
            courselink: CourseEditLinkId,
            courseimg: CourseEditImgId,
        })
        .then(function(response) {



            if (response.status == 200) {

                if (response.data == 1) {

                    $('#editCourseModal').modal('hide');
                    getCoursesData();
                    toastr.success('Data Updated Successfully');
                    $('#CourseEditConfirmBtn').html("Save");

                } else {
                    $('#editCourseModal').modal('hide');
                    toastr.error('Data Update Failed');
                }

            } else {

                $('#editCourseModal').modal('hide');
                toastr.error('Data Update Failed');

            }


        })
        .catch(function(error) {
            toastr.error('Something Went Wrong!');
        })
}