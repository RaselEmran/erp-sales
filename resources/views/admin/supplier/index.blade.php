@extends('welcome')
@section('title','SELLS-ERP:Supplier')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endpush
@section('content')
   <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Supplier</h3>
              <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-category">
                Add Supplier
              </button></p>
            </div>
            <!-- /.box-header -->
              @if(session('msg'))
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Success - </b> {{session('msg')}}</span>
                  </div>
                  @endif
                   @if ($errors->any())
 
            @foreach ($errors->all() as $error)
               
                   <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                     <span>
                      <b> Danger - </b> {{ $error }}</span>
                  </div>
            @endforeach

       @endif
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Serial</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Image</th>
                  <th>Address</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
   @foreach($supplier as $key=> $supp)

<tr>
  <td>{{$key+1}}</td>
  <td>{{$supp->name}}</td>
  <td>{{$supp->email}}</td>
  <td>{{$supp->phone}}</td>
  <td><img src="{{asset($supp->image)}}" alt="" style="width: 90px"></td>
  <td>{{$supp->address}}</td>


  <td>
    <a href="" class="btn btn-info edit-supplier"  data-toggle="modal" data-target="#modal-editsupplier" supplier_id="{{$supp->id}}">Edit</a>
        <button class="btn btn-danger" onclick="deleteTag(<?php echo $supp->id ?>)"><i class="material-icons">delete</i></button>
        <form id="delete-form-{{$supp->id}}" action="{{route('admin.supplier.delete',$supp->id)}}" method="post" style="display: none"> {{csrf_field()}}</form>
  </td>
</tr>


   @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Serial</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Image</th>
                  <th>Address</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
   </div>
        <div class="modal fade" id="modal-category">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Supplier</h4>
              </div>
              <div class="modal-body">
              <div class="box-body">

              <form role="form" action="{{route('admin.supplier.store')}}" method="post" enctype="multipart/form-data">
                {{@csrf_field()}}
                <!-- text input -->
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter Supplier name" required>
                </div>
                  <div class="form-group">
                  <label>Email</label>
                  <input type="text" name="email" class="form-control" placeholder="Enter Supplier Email" required>
                </div>
                  <div class="form-group">
                  <label>Phone</label>
                  <input type="text" name="phone" class="form-control" placeholder="Enter Supplier Phone" required>
                </div>
                <!-- textarea -->
                <div class="form-group">
                  <label>Address</label>
                   <textarea name="address" class="form-control"> </textarea>
                        
                </div>
                <div class="row">
                	<div class="col-md-6">
                		 <div class="form-group">
		                  <label>Image</label>
		                  <input type="file" name="image" accept="image/*" onchange="preview_image(event)">
		                 </div>
                	</div>
                	<div class="col-md-6">
                		<img id="output_image"/ style="width: 90px;height: 90px">
                	</div>
                </div>

            </div>
              </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>
            <!-- /.modal-content -->
          </div>
        </div>
      </div>
    </div>

          <!-- /.modal-dialog -->
  </div>

<!-- edit code -->
        <div class="modal fade" id="modal-editsupplier">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Supplier</h4>
              </div>
              <div class="modal-body">
              <div class="box-body">


              <form role="form" action="{{route('admin.supplier.update')}}" method="post" enctype="multipart/form-data">
                {{@csrf_field()}}
                <!-- text input -->
                <div class="form-group">
                  <label>Name</label>
                  <input type="hidden" name="id" id="id" class="form-control" placeholder="Enter Supplier name" required>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Enter Supplier name" required>
                </div>
                  <div class="form-group">
                  <label>Email</label>
                  <input type="text" name="email" id="email" class="form-control" placeholder="Enter Supplier Email" required>
                </div>
                  <div class="form-group">
                  <label>Phone</label>
                  <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Supplier Phone" required>
                </div>
                <!-- textarea -->
                <div class="form-group">
                  <label>Address</label>
                   <textarea name="address" id="address" class="form-control"> </textarea>
                        
                </div>
                <div class="row">
                	<div class="col-md-6">
                		 <div class="form-group">
		                  <label>Image</label>
		                  <input type="file" name="image" accept="image/*" onchange="preview_image1(event)">
		                 </div>
                	</div>
                	<div class="col-md-6">
                		<img id="output_image1"/ style="width: 90px;height: 90px">
                	</div>
                </div>

            </div>
              </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>
            <!-- /.modal-content -->
          </div>
        </div>
      </div>
    </div>
    
          <!-- /.modal-dialog -->
   </div>
@endsection
@push('js')
<script src="{{asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.js"></script>
    <script>
function deleteTag(id){

  const swalWithBootstrapButtons = Swal.mixin({
  confirmButtonClass: 'btn btn-success',
  cancelButtonClass: 'btn btn-danger',
  buttonsStyling: false,
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
       swalWithBootstrapButtons.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'

    )
   event.preventDefault();
   var a= document.getElementById('delete-form-'+id).submit();
 

  } else if (
    // Read more about handling dismissals
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your Data is safe :)',
      'error'
    )
  }
})
         }
     </script>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

<script>
	function preview_image(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>

<script>
  function preview_image1(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image1');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>

<script>
  $(".edit-supplier").click(function(){

    var supplier_id =$(this).attr('supplier_id');


    $.ajax({

              type: 'POST',
              url: "{{URL::to('/admin/supplier/edit')}}",
              data : {supplier_id:supplier_id},
              dateType: 'json',
              success: function(data){
              	$("#id").val(data.id);
              $("#name").val(data.name);
              $("#email").val(data.email);
              $("#phone").val(data.phone);
              $("#address").text(data.address);
               $("#output_image1").attr("src",'/'+
                    data.image);
                  
               }
              
            });
  });
</script>

@endpush