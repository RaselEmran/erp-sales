@extends('welcome')
@section('title','SELLS-ERP:Bank')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/bower_components/select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endpush
@section('content')
   <div class="box">
           <div class="box-header">
              <h3 class="box-title"> Account Transfer To</h3>

            </div>
              @if(session('msg'))
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Success - </b> {{session('msg')}}</span>
                  </div>
                  @endif
                 

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Serial</th>
                  <th>A/C Name</th>
                  <th>From Account</th>
                  <th>A/C Number</th>
                  <th>Description</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Action</th>

                </tr>
                </thead>
                <tbody>
@foreach($transfer as $key=> $all)
    <tr>
      <td>{{$key+1}}</td>
      <td>{{$all->ac_name}}</td>
      <td>{{$all->transfer_form}}</td>
      <td>{{$all->ac_number}}</td>
      <td>{{$all->ac_description}}</td>
      <td>{{$all->ac_amount}}</td>
      <td>{{$all->ac_date}}</td>

      <td>
       <a href="{{route('admin.bank.edittranfer',$all->id)}}" class="btn btn-info edit-bank">Edit</a>
          <button class="btn btn-danger" onclick="deleteTag(<?php echo $all->id ?>)"><i class="material-icons">delete</i></button>
        <form id="delete-form-{{$all->id}}" action="{{route('admin.transfer.delete',$all->id)}}" method="post" style="display: none"> {{csrf_field()}}</form>
      </td>
    </tr>

@endforeach                

            </tbody>
                <tfoot>
                <tr>
                  <th>Serial</th>
                  <th>A/C Name</th>
                  <th>From Account</th>
                  <th>A/C Number</th>
                  <th>Description</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!--  -->
   <div class="box-header">
              <h3 class="box-title">Account Transfer From</h3>

            </div>
             <div class="box-body">
              <table id="transfer" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Serial</th>
                  <th>A/C Name</th>
                  <th>Transfer A/C</th>
                  <th>A/C Number</th>
                  <th>Description</th>
                  <th>Amount</th>
                  <th>Date</th>

                </tr>
                </thead>
                <tbody>
@foreach($from as $key=> $allb)
    <tr>
      <td>{{$key+1}}</td>
      <td>{{$allb->ac_name}}</td>
      <th>{{$allb->transfer_to}}</th>
      <td>{{$allb->ac_number}}</td>
      <td>{{$allb->ac_description}}</td>
      <td>{{$allb->ac_amount}}</td>
      <td>{{$allb->ac_date}}</td>

    </tr>

@endforeach                

            </tbody>
                <tfoot>
                <tr>
                   <th>Serial</th>
                  <th>A/C Name</th>
                  <th>Tranfer A/C</th>
                  <th>A/C Number</th>
                  <th>Description</th>
                  <th>Amount</th>
                  <th>Date</th>
                </tr>
                </tfoot>
              </table>
            </div>
         </div>


   </div>
@endsection
@push('js')
<script src="{{asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
 <script src="{{asset('backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
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
   $('#datepicker').datepicker({
      autoclose: true,
      todayHighlight: true
    })
   $('.select2').select2();
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

    $(function () {
    $('#transfer').DataTable()
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
  $(".edit-bank").click(function(){

    var bank_id =$(this).attr('bank_id');

    
              $.ajax({

              type: 'POST',
              url: "{{URL::to('/admin/bank/edit')}}",
              data : {bank_id:bank_id},
              dateType: 'json',
              success: function(data){
        $("#id").val(data.id);
        $("#b_name").val(data.b_name);
        $("#ac_name").val(data.ac_name);
        $("#ac_number").val(data.ac_number);
        $("#bc_name").val(data.bc_name);


                  
               }
              
            });
  });
</script>
@endpush