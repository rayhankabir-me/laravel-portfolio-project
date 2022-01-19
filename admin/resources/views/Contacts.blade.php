@extends('Layout.app')

@section('content')



<div class="container">
<div class="row">
<div class="col-md-12 p-5">

<table id="ContactDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>

	  <th class="th-sm">Name</th>
	  <th class="th-sm">Phone</th>
	  <th class="th-sm">Email</th>
	  <th class="th-sm">Message</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody class="contactsTable">

	
	
	
  </tbody>
</table>
	
	<!----contacts loading spinner and error section---->

	<div class="contact-spninner text-center mt-5">
		<div class="spinner-border text-danger" style="width: 3rem; height: 3rem;" role="status"></div>
	</div>
	<div class="contact_error-container text-center mt-2 d-none">
		<h4 class="text-danger">Something Went Wrong!</h4>
	</div>


</div>
</div>
</div>





<!-----Contacts Delete Confirmation Modal--------->

<!-- Delete Modal -->
<div class="modal fade" id="ContactDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p>Are you want to delete?</p>
        <input id="contactDeleteId" type="hidden" value="">
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">No</button>
        <button id="contactDeleteConfirmatinBtn" type="button" class="btn btn-danger btn-sm">Yes</button>
      </div>
    </div>
  </div>
</div>



@endsection



@section('script')

<script type="text/javascript">
    
getContactData();



</script>

@endsection