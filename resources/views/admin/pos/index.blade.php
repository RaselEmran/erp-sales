@extends('welcome')
@section('title','SELLS-ERP:Sell')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endpush
@section('content')
   <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Sell</h3>
              <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-category">
                Add Sell
              </button></p>
            </div>
            <!-- /.box-header -->
               @if(session('sms'))
                  <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Success - </b> {{session('sms')}}</span>
                  </div>
                  @endif
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
                  <th>Customer Name</th>
                  <th>Date</th>
                  <th>Sub Total</th>
                  <th>Discount</th>
                  <th>Net Total</th>
                  <th>Paid</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
   @foreach($pos as $key=> $sell)

<tr>
  <td>{{$key+1}}</td>
  <td>{{$sell->cus_name}}</td>
  <td>{{$sell->pos_date}}</td>
  <td>{{$sell->sub_total}}</td>
  <td>{{$sell->discount}}</td>
  <td>{{$sell->net_total}}</td>
  <td>{{$sell->paid}}</td>


  <td>
    <a href="{{route('admin.pos.edit',$sell->id)}}" class="btn btn-info edit-client">Edit</a>
    <a href="{{route('admin.pos.invoice',$sell->id)}}" class="btn btn-success">Invoice</a>
        <button class="btn btn-danger" onclick="deleteTag(<?php echo $sell->id ?>)"><i class="material-icons">delete</i></button>
        <form id="delete-form-{{$sell->id}}" action="{{route('admin.pos.delete',$sell->id)}}" method="post" style="display: none"> {{csrf_field()}}</form>
  </td>
</tr>


   @endforeach
                </tbody>
                <tfoot>
                <tr>
                 <th>Serial</th>
                  <th>Customer Name</th>
                  <th>Date</th>
                  <th>Sub Total</th>
                  <th>Discount</th>
                  <th>Net Total</th>
                  <th>Paid</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
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
  $(".edit-client").click(function(){

    var client_id =$(this).attr('client_id');


    $.ajax({

              type: 'POST',
              url: "{{URL::to('/admin/client/edit')}}",
              data : {client_id:client_id},
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