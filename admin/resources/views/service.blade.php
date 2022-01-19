@extends('Layout.app')

@section('content')



<div class="container">
<div class="row">
<div class="col-md-12 p-5">

	<button id="addBtn" class="btn btn-danger mb-4 m-0 btn-md">Add New</button>

<table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Image</th>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Description</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>

  </thead>
  <tbody class="serviceTable">
  


	
	
	
  </tbody>
</table>

	<div class="spinner-container text-center mt-5">
		<div class="spinner-border text-danger" style="width: 3rem; height: 3rem;" role="status"></div>
	</div>
	<div class="error-container text-center mt-2 d-none">
		<h4 class="text-danger">Something Went Wrong!</h4>
	</div>
	


</div>
</div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p>Are you want to delete?</p>
        <input id="serviceId" type="hidden" value="">
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">No</button>
        <button id="confirmationBtn" type="button" class="btn btn-danger btn-sm">Yes</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade mt-4" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

    	<div class="modal-header">
        <h5 class="modal-title">Edit Service Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        

        <div class="form-group">
        	<label for="serviceName">Service Name</label>
        	<input class="form-control" id="serviceName" type="text">
        </div>

        <div class="form-group">
        	<label for="serviceDesc">Service Description</label>
        <input class="form-control" id="serviceDesc" type="text">
        </div>

        <div class="form-group">
        	<label for="imageUrl">Service Image Url</label>
        <input class="form-control" id="imageUrl" type="text">
        </div>

        <!---edit services modal error and spinner--->

						     <div class="edit-spinner text-center mt-2">
								<div class="spinner-border text-danger" style="width: 3rem; height: 3rem;" role="status"></div>
							</div>
							<div class="edit-error text-center mt-2 d-none">
								<h4 class="text-danger">Something Went Wrong!</h4>
							</div>

        <input id="editServiceID" type="hidden" value="">

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancel</button>
        <button id="saveBtn" type="button" class="btn btn-danger btn-sm">Save</button>
      </div>
    </div>
  </div>
</div>



<!-- Add Item Modal -->
<div class="modal fade mt-4" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

    	<div class="modal-header">
        <h5 class="modal-title">Add Service Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        

        <div class="form-group">
        	<label for="addName">Service Name</label>
        	<input class="form-control" id="addName" type="text" required>
        </div>

        <div class="form-group">
        	<label for="addDesc">Service Description</label>
        <input class="form-control" id="addDesc" type="text" required>
        </div>

        <div class="form-group">
        	<label for="addImg">Service Image Url</label>
        <input class="form-control" id="addImg" type="text" required>
        </div>




        
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancel</button>
        <button id="addDataBtn" type="button" class="btn btn-danger btn-sm">Save</button>
      </div>
    </div>
  </div>
</div>




@endsection

@section('script')

<script type="text/javascript">
	
	getServicesData();


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


</script>

@endsection