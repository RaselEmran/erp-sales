@extends('welcome')
@section('title','SELLS-ERP:Bank')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endpush
@section('content')
        @if(session('msg'))
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Success - </b> {{session('msg')}}</span>
                  </div>
         @endif

         @if(session('emsg'))
                  <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Success - </b> {{session('emsg')}}</span>
                  </div>
         @endif
  <div class="box-body">
<form action=""  name="frmUser" method="post">
	{{@csrf_field()}}
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example1">
		<div class="alert alert-success">
			<h2 style="text-align:center; font-family:cursive;">Backup Or Destroy Category</h2>
		</div>
		<thead>
<button type="button" class="btn btn-info" onClick="setUpdateAction();"><i class="fa fa-fw fa-undo" style="margin-right: 5px"></i></button><button type="button" class="btn btn-danger" onClick="setDeleteAction();"><i class="fa fa-fw fa-trash"></i></button>
			<tr>
				  <th style="text-align:center; font-family:cursive; font-size:18px; color:blue;">Serial</th>
                  <th style="text-align:center; font-family:cursive; font-size:18px; color:blue;">Name</th>
                  <th style="text-align:center; font-family:cursive; font-size:18px; color:blue;">Description</th>
				  <th style="text-align:center; font-family:cursive; font-size:18px; color:blue;">Action</th>
			</tr>
		</thead>
		<tbody>
       @foreach ($category as $key=> $element)
    
			<tr>
				<td style="text-align:center; font-family:cursive; font-size:18px;">{{$key+1}}</td>
				<td style="text-align:center; font-family:cursive; font-size:18px;">{{$element->name}}</td>
				<td style="text-align:center; font-family:cursive; font-size:18px;">{{$element->description}}</td>
				<td style="text-align:center; font-family:cursive; font-size:18px;">
					<input name="selector[]" type="checkbox" value="{{$element->id}}">
				</td>
			</tr>	
       @endforeach	
			 
		</tbody>
	</table>
</form>
</div>
@endsection
@push('js')
<script src="{{asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.js"></script>
<script>
  $(function () {
    $('#example1').DataTable({
    	'lengthChange': false,
    	'info'        : false,
    })
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })

function setUpdateAction() {
document.frmUser.action = "{{ route('admin.backup.resetcategory') }}";
document.frmUser.submit();
}
function setDeleteAction() {

Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {

  if (result.value) {
  	  event.preventDefault();
  	document.frmUser.action = "{{ route('admin.backup.destroycategory') }}";
    document.frmUser.submit();
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
})



}
</script>

@endpush