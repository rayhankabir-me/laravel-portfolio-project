@extends('Layout.app')

@section('content')



<div class="container">
<div class="row">
<div class="col-md-12 p-5">

	<button id="addNewCourseBTn" class="btn btn-danger mb-4 m-0 btn-md">Add New</button>

<table id="CourseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>

	  <th class="th-sm">Name</th>
	  <th class="th-sm">Fee</th>
	  <th class="th-sm">Total Enroll</th>
	  <th class="th-sm">Total Class</th>
	  <th class="th-sm">Details</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody class="coursesTable">

	
	
	
  </tbody>
</table>
	
	<!----courses loading spinner and error section---->

	<div class="course-spninner text-center mt-5">
		<div class="spinner-border text-danger" style="width: 3rem; height: 3rem;" role="status"></div>
	</div>
	<div class="course_error-container text-center mt-2 d-none">
		<h4 class="text-danger">Something Went Wrong!</h4>
	</div>


</div>
</div>
</div>



<!-----Add New Course Modal----->

<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image Link">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>



<!-----Course Delete Confirmation Modal--------->

<!-- Delete Modal -->
<div class="modal fade" id="CourseDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p>Are you want to delete?</p>
        <input id="courseDeleteId" type="hidden" value="">
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">No</button>
        <button id="courseDeleteConfirmatinBtn" type="button" class="btn btn-danger btn-sm">Yes</button>
      </div>
    </div>
  </div>
</div>



<!-----Edit Course Modal----->

<div class="modal fade" id="editCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Course Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseEditNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseEditDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseEditFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEditEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseEditClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseEditLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseEditImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image Link">
       		</div>

       		<input id="editCourseIdvalue" type="hidden" value="">
       	</div>

       	<div class="row">

        <!---edit services modal error and spinner--->

		     <div class="editCourse-spinner text-center mt-2">
				<div class="spinner-border text-danger" style="width: 3rem; height: 3rem;" role="status"></div>
			</div>
			<div class="editCourse-error text-center mt-2 d-none">
				<h4 class="text-danger">Something Went Wrong!</h4>
			</div>

       	</div>


       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseEditConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>



@endsection





@section('script')

<script type="text/javascript">
	
getCoursesData();


//admin panel courses section javascript


/*......get courses data.......*/
function getCoursesData() {

    axios.get('/getCoursesData').then(function(response) {

            if (response.status == 200) {


                $('#CourseDataTable').DataTable().destroy();
                $('.coursesTable').empty();
                $('.course-spninner').addClass('d-none');
                let coursesData = response.data;



                $.each(coursesData, function(i, item) {

                    $('<tr>').html('<th class="th-sm">' + coursesData[i].course_name + '</th><th class="th-sm">' + coursesData[i].course_fee + '</th><th class="th-sm">' + coursesData[i].course_totalenroll + '</th><th class="th-sm">' + coursesData[i].course_totalclass + '</th><th class="th-sm"><a class="courseViewDetailsBtn" data-id=' + coursesData[i].id + ' ><i class="fas fa-eye"></i></a></th><th class="th-sm"><a class="courseEditBtn" data-id=' + coursesData[i].id + ' ><i class="fas fa-edit"></i></a></th><th class="th-sm"><a class="courseDeleteBtn" data-id=' + coursesData[i].id + ' ><i class="fas fa-trash-alt"></i></a></th>').appendTo('.coursesTable');


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
            } else {

                $('.course-spninner').addClass('d-none');
                $('.course_error-container').removeClass('d-none');
            }
        })

        .catch(function(error) {

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



</script>

@endsection