@extends('Layout.app')

@section('content')



<div class="container">
<div class="row">
<div class="col-md-12 p-5">

	<button id="addNewTestimonialBTn" class="btn btn-danger mb-4 m-0 btn-md">Add New</button>

<table id="TestimonialDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>

	  <th class="th-sm">Name</th>
	  <th class="th-sm">Description</th>
	  <th class="th-sm">Image Link</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody class="testimonialsTable">

	
	
	
  </tbody>
</table>
	
	<!----testmonials loading spinner and error section---->

	<div class="testimonial-spninner text-center mt-5">
		<div class="spinner-border text-danger" style="width: 3rem; height: 3rem;" role="status"></div>
	</div>
	<div class="testimonial_error-container text-center mt-2 d-none">
		<h4 class="text-danger">Something Went Wrong!</h4>
	</div>


</div>
</div>
</div>



<!-----Add New Project Modal----->

<div class="modal fade" id="addTestimonialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Testimonial</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
          <input id="TestimonialNameId" type="text" id="" class="form-control mb-3" placeholder="Testimonial Name">
          <input id="TestimonialDesId" type="text" id="" class="form-control mb-3" placeholder="Testimonial Description">
     			<input id="TestimonialImageId" type="text" id="" class="form-control mb-3" placeholder="Testimonial Image Link">
       		</div>
       		<div class="col-md-6">

       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="TestimonialAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>



<!-----Project Delete Confirmation Modal--------->

<!-- Delete Modal -->
<div class="modal fade" id="ProjectDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p>Are you want to delete?</p>
        <input id="projectDeleteId" type="hidden" value="">
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">No</button>
        <button id="projectDeleteConfirmatinBtn" type="button" class="btn btn-danger btn-sm">Yes</button>
      </div>
    </div>
  </div>
</div>



<!-----Edit Project Modal----->

<div class="modal fade" id="editProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Project Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">

       		<div class="col-md-6">
          <input id="ProjectEditNameId" type="text" id="" class="form-control mb-3" placeholder="Project Name">
          <input id="ProjectEditDesId" type="text" id="" class="form-control mb-3" placeholder="Project Description">
    		 	<input id="ProjectEditLinkId" type="text" id="" class="form-control mb-3" placeholder="Project Link">
     			<input id="ProjectEditImgId" type="text" id="" class="form-control mb-3" placeholder="Project Image Link">
       		</div>
       		<div class="col-md-6">

       		</div>


       		<input id="editProjectIdvalue" type="hidden" value="">
       	</div>

       	<div class="row">

        <!---edit projects modal error and spinner--->

		     <div class="editProject-spinner text-center mt-2">
				<div class="spinner-border text-danger" style="width: 3rem; height: 3rem;" role="status"></div>
			</div>
			<div class="editProject-error text-center mt-2 d-none">
				<h4 class="text-danger">Something Went Wrong!</h4>
			</div>

       	</div>


       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="ProjectEditConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>



@endsection





@section('script')

<script type="text/javascript">
	
getProjectData();



//admin panel projects section javascript


/*......get projects data.......*/
function getProjectData() {

    axios.get('/getProjectsData').then(function(response) {

            if (response.status == 200) {


                $('#ProjectDataTable').DataTable().destroy();
                $('.projectsTable').empty();
                $('.project-spninner').addClass('d-none');
                let projectsData = response.data;



                $.each(projectsData, function(i, item) {

                    $('<tr>').html('<th class="th-sm">' + projectsData[i].project_name + '</th><th class="th-sm">' + projectsData[i].project_desc + '</th><th class="th-sm">' + projectsData[i].project_link + '</th><th class="th-sm">' + projectsData[i].project_img + '</th><th class="th-sm"><a class="projectEditBtn" data-id=' + projectsData[i].id + ' ><i class="fas fa-edit"></i></a></th><th class="th-sm"><a class="projectDeleteBtn" data-id=' + projectsData[i].id + ' ><i class="fas fa-trash-alt"></i></a></th>').appendTo('.projectsTable');


                    /*.......Project Delete Button On Click Event..........*/

                    $('.projectDeleteBtn').click(function() {
                        let projectId = $(this).data('id');

                        $('#projectDeleteId').val(projectId);

                        $('#ProjectDeleteModal').modal('show');
                    });


                    /*.......Project Edit Button On Click Event..........*/

                    $('.projectEditBtn').click(function() {
                        let editProjectID = $(this).data('id');

                        $('#editProjectIdvalue').val(editProjectID);
                        singleProjectsData(editProjectID);
                        $('#editProjectModal').modal('show');
                    });


                    /*...building data table....*/
                    $('#ProjectDataTable').DataTable();
                    $('.dataTables_length').addClass('bs-select');


                })
            } else {

                $('.project-spninner').addClass('d-none');
                $('.project_error-container').removeClass('d-none');
            }
        })

        .catch(function(error) {

            $('.project-spninner').addClass('d-none');
            $('.project_error-container').removeClass('d-none');

        })
}


/*......add Projects data........*/


$('#addNewProjectBTn').click(function() {

    let projectname = $('#ProjectNameId').val("");
    let projectdesc = $('#ProjectDesId').val("");
    let projectlink = $('#ProjectLinkId').val("");
    let projectimg = $('#ProjectImageId').val("");


    $('#addProjectModal').modal('show');



});



$('#ProjectAddConfirmBtn').click(function() {

    $(this).html("<div class='spinner-border spinner-border-sm' role='status'>");


    let projectname = $('#ProjectNameId').val();
    let projectdesc = $('#ProjectDesId').val();
    let projectlink = $('#ProjectLinkId').val();
    let projectimg = $('#ProjectImageId').val();
    addProjectsData(projectname, projectdesc, projectlink, projectimg);


});


function addProjectsData(projectname, projectdesc, projectlink, projectimg) {



    axios.post('/addProjects', {
            projectname: projectname,
            projectdesc: projectdesc,
            projectlink: projectlink,
            projectimg: projectimg,

        })
        .then(function(response) {



            if (response.status == 200) {

                if (response.data == 1) {

                    $('#addProjectModal').modal('hide');
                    getProjectData();
                    toastr.success('Project Item Added Successfully');

                    $('#ProjectAddConfirmBtn').html("Save");

                } else {
                    $('#addProjectModal').modal('hide');
                    toastr.error('Data Save Failed');
                }

            } else {

                $('#addProjectModal').modal('hide');
                toastr.error('Data Save Failed');

            }


        })
        .catch(function(error) {
            toastr.error('Something Went Wrong!');
        })
}




/*.........Course Delete Data.......*/

$('#projectDeleteConfirmatinBtn').click(function() {

    $('#ProjectDeleteModal').modal('hide');

    deleteProjectData();

    function deleteProjectData() {


        let inputID = $('#projectDeleteId').val();

        axios.post('/deleteProjectsData', {
                id: inputID,
            })
            .then(function(response) {

                if (response.data == 1) {

                    toastr.success('Data Deleted Successfully');
                    getProjectData();
                } else {
                    toastr.error('Data Delete Failed');
                }

            })
            .catch(function(error) {
                toastr.error('Something Went Wrong!');
            });
    }

});



/*......Get Single Project Data For Update Form..........*/

function singleProjectsData(projectId) {

    axios.post('/singleProjectsData', {
        id: projectId,
    }).then(function(response) {

        let jsonData = response.data;

        if (response.status == 200) {


            $('.editProject-spinner').addClass('d-none');
            $('.editProject-error').addClass('d-none');

            $('#ProjectEditNameId').val(jsonData[0].project_name);
            $('#ProjectEditDesId').val(jsonData[0].project_desc);
            $('#ProjectEditLinkId').val(jsonData[0].project_link);
            $('#ProjectEditImgId').val(jsonData[0].project_img);
        } else {

            $('.editProject-spinner').addClass('d-none');
            $('.editProject-error').removeClass('d-none');

        }

    }).catch(function(error) {

        $('.editProject-spinner').addClass('d-none');
        $('.editProject-error').removeClass('d-none');
    })


}



/*........admin panel update services data.......*/

$('#ProjectEditConfirmBtn').click(function() {

    $(this).html("<div class='spinner-border spinner-border-sm' role='status'>");

    let projectEditId = $('#editProjectIdvalue').val();
    let ProjectEditNameId = $('#ProjectEditNameId').val();
    let ProjectEditDesId = $('#ProjectEditDesId').val();
    let ProjectEditLinkId = $('#ProjectEditLinkId').val();
    let ProjectEditImgId = $('#ProjectEditImgId').val();

    updateProjectsData(projectEditId, ProjectEditNameId, ProjectEditDesId, ProjectEditLinkId, ProjectEditImgId);


});


function updateProjectsData(projectEditId, ProjectEditNameId, ProjectEditDesId, ProjectEditLinkId, ProjectEditImgId) {



    axios.post('/updateProjectsData', {
            projectEditId: projectEditId,
            ProjectEditNameId: ProjectEditNameId,
            ProjectEditDesId: ProjectEditDesId,
            ProjectEditLinkId: ProjectEditLinkId,
            ProjectEditImgId: ProjectEditImgId,
        })
        .then(function(response) {



            if (response.status == 200) {

                if (response.data == 1) {

                    $('#editProjectModal').modal('hide');
                    getProjectData();
                    toastr.success('Data Updated Successfully');
                    $('#ProjectEditConfirmBtn').html("Save");

                } else {
                    $('#editProjectModal').modal('hide');
                    toastr.error('Data Update Failed');
                }

            } else {

                $('#editProjectModal').modal('hide');
                toastr.error('Data Update Failed');

            }


        })
        .catch(function(error) {
            toastr.error('Something Went Wrong!');
        })
}





</script>

@endsection