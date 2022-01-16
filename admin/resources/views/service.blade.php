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
</script>

@endsection