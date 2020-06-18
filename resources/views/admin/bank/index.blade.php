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
              <h3 class="box-title">All Bank</h3>
               <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-loan">
                Add Bank
              </button></p>
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
                  <th>Bank Name</th>
                  <th>A/C Name</th>
                  <th>A/C Number</th>
                  <th>Brance</th>
                  <th>Action</th>

                </tr>
                </thead>
                <tbody>
@foreach($bank as $key=> $all)
    <tr>
      <td>{{$key+1}}</td>
      <td>{{$all->b_name}}</td>
      <td>{{$all->ac_name}}</td>
      <td>{{$all->ac_number}}</td>
      <td>{{$all->bc_name}}</td>
      <td>
       <a href="" class="btn btn-info edit-bank" data-toggle="modal" data-target="#modal-bank" bank_id="{{$all->id}}">Edit</a>
          <button class="btn btn-danger" onclick="deleteTag(<?php echo $all->id ?>)"><i class="material-icons">delete</i></button>
        <form id="delete-form-{{$all->id}}" action="{{route('admin.bank.delete',$all->id)}}" method="post" style="display: none"> {{csrf_field()}}</form>
      </td>
    </tr>

@endforeach                

            </tbody>
                <tfoot>
                <tr>
                 <th>Serial</th>
                  <th>Bank Name</th>
                  <th>A/C Name</th>
                  <th>A/C Number</th>
                  <th>Brance</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!--  -->
           <div class="modal fade" id="modal-loan">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Bank</h4>
              </div>
              <div class="modal-body">
              <div class="box-body">

              <form role="form" action="{{route('admin.bank.store')}}" method="post" enctype="multipart/form-data">
                {{@csrf_field()}}
                <!-- text input -->

                  <div class="form-group">
                  <label>Bank Name</label>
                  <input type="text" name="b_name" class="form-control" placeholder="Enter Bank Name" value="" required>
                </div>

                  <div class="form-group">
                  <label>Account Name</label>
                  <input type="text" name="ac_name" class="form-control" placeholder="Enter Account Name" required>
                </div>
                <!-- textarea -->
                  <div class="form-group">
                  <label>Account Number</label>
                  <input type="text" name="ac_number" class="form-control" placeholder="Enter Account Number" required>
                </div>

                   <div class="form-group">
                  <label>Brance Name</label>
                  <input type="text" name="bc_name" class="form-control" placeholder="Enter Brance Name" required>
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



          <!-- Edit -->

     <div class="modal fade" id="modal-bank">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Bank</h4>
              </div>
              <div class="modal-body">
              <div class="box-body">

              <form role="form" action="{{route('admin.bank.update')}}" method="post" enctype="multipart/form-data">
                {{@csrf_field()}}
                <!-- text input -->

                  <div class="form-group">
                  <label>Bank Name</label>
                  <input type="hidden" name="id" id="id">
                  <input type="text" name="b_name" id="b_name" class="form-control" placeholder="Enter Bank Name" value="" required>
                </div>

                  <div class="form-group">
                  <label>Account Name</label>
                  <input type="text" name="ac_name" id="ac_name" class="form-control" placeholder="Enter Account Name" required>
                </div>
                <!-- textarea -->
                  <div class="form-group">
                  <label>Account Number</label>
                  <input type="text" name="ac_number" id="ac_number" class="form-control" placeholder="Enter Account Number" required>
                </div>

                   <div class="form-group">
                  <label>Brance Name</label>
                  <input type="text" name="bc_name" id="bc_name" class="form-control" placeholder="Enter Brance Name" required>
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