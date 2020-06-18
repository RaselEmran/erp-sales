@extends('welcome')
@section('title','SELLS-ERP:Expense')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endpush
@section('content')
   <div class="box">
           <div class="box-header">
              <h3 class="box-title">All Expense</h3>
              <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-expense">
                Add Expense
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

       <div class="row">
         <div class="col-md-3" style="background: #555555;padding: 18px; margin: 25px;color: #fff;font-size: 22px">
          <p>Total Amount</p>
           <?php 
$exp =DB::table('expenses')->sum('amount');
echo $exp;
            ?>
         </div>
         <div class="col-md-3"  style="background: #555555;padding: 18px;margin: 25px;color: #fff;font-size: 22px">
           <p>Total Paid Amount</p>
           <?php 
   $paid =DB::table('expenses')->sum('paid');
   echo $paid;
            ?>
         </div>

        <div class="col-md-3"  style="background: #555555;padding: 18px;margin: 25px;color: #fff;font-size: 22px">
           <p>Total Pay</p>
           <?php 
   $count =DB::table('expenses')->count();
   echo $count;
            ?>
         </div>
       </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Serial</th>
                  <th>Date</th>
                  <th>Vouchar No</th>
                  <th>Purpose</th>
                  <th>Expense To</th>
                  <th> Amount</th>
                  <th>Paid</th>
                  <th>Note</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
   @foreach($expense as $key=> $sell)

<tr>
  <td>{{$key+1}}</td>
  <td>{{$sell->date}}</td>
  <td>{{$sell->vouchar_no}}</td>
  <td>{{$sell->purpose}}</td>
  <td>{{$sell->expense_to}}</td>
  <td>{{$sell->amount}}</td>
  <td>{{$sell->paid}}</td>
  <td>{{$sell->note}}</td>


  <td>
      <a href="" class="btn btn-info edit-expense"  data-toggle="modal" data-target="#modal-editexpense" expense_id="{{$sell->id}}">Edit</a>
        <button class="btn btn-danger" onclick="deleteTag(<?php echo $sell->id ?>)"><i class="material-icons">delete</i></button>
        <form id="delete-form-{{$sell->id}}" action="{{route('admin.expense.delete',$sell->id)}}" method="post" style="display: none"> {{csrf_field()}}</form>
  </td>
</tr>


   @endforeach
                </tbody>
                <tfoot>
                <tr>
                <th>Serial</th>
                  <th>Date</th>
                  <th>Vouchar No</th>
                  <th>Purpose</th>
                  <th>Expense To</th>
                  <th> Amount</th>
                  <th>Paid</th>
                  <th>Note</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <div class="modal fade bd-example-modal-lg" id="modal-expense">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Expense</h4>
              </div>
              <div class="modal-body">
              <div class="box-body">

              <form role="form" action="{{route('admin.expense.store')}}" method="post" >
                {{@csrf_field()}}

                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                      <label>Expense Purpose</label>
                      <input type="text" name="purpose" class="form-control" placeholder="Enter Expense purpose" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                       <div class="form-group">
                      <label>Expense To</label>
                      <input type="text" name="expense_to" class="form-control" placeholder="Enter Expense_to" required>
                     </div>
              
                  </div>

                  <div class="col-md-6">
                       <div class="form-group">
                      <label>date</label>
                      <input type="text" name="date" id="datepicker" class="form-control" placeholder="Date" required>
                     </div>
              
                  </div>


                     <div class="col-md-6">
                      <div class="form-group">
                      <label>vouchar_no</label>
                      <input type="text" name="vouchar_no" class="form-control" placeholder="Enter vouchar_no" required>
                     </div>
                  </div>

                     <div class="col-md-6">
                       <div class="form-group">
                      <label>amount</label>
                      <input type="text" name="amount" class="form-control" placeholder="Enter amount" required>
                     </div>
              
                  </div>

                    <div class="col-md-6">
                       <div class="form-group">
                      <label>paid</label>
                      <input type="text" name="paid" class="form-control" placeholder="Enter paid Amount" required>
                     </div>
              
                  </div>

                  <div class="col-md-12">
                        <div class="form-group">
                      <label>Note</label>
                       <textarea name="note" class="form-control" required> </textarea>
                            
                    </div>
                  </div>
           
                </div>
                <!-- text input -->
            
          

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

          <!-- Edit........... -->
                  <div class="modal fade bd-example-modal-lg" id="modal-editexpense">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Expense</h4>
              </div>
              <div class="modal-body">
              <div class="box-body">

              <form role="form" action="{{route('admin.expense.update')}}" method="post" >
                {{@csrf_field()}}

                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                      <label>Expense Purpose</label>
                      <input type="hidden" name="id" id="id">
                      <input type="text" name="purpose" id="purpose" class="form-control" placeholder="Enter Expense purpose" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                       <div class="form-group">
                      <label>Expense To</label>
                      <input type="text" name="expense_to" id="expense_to" class="form-control" placeholder="Enter Expense_to" required>
                     </div>
              
                  </div>

                  <div class="col-md-6">
                       <div class="form-group">
                      <label>date</label>
                      <input type="text" name="date" id="datepicker" class="form-control date" placeholder="Date" required>
                     </div>
              
                  </div>


                     <div class="col-md-6">
                      <div class="form-group">
                      <label>vouchar_no</label>
                      <input type="text" name="vouchar_no" id="vouchar_no" class="form-control" placeholder="Enter vouchar_no" required>
                     </div>
                  </div>

                     <div class="col-md-6">
                       <div class="form-group">
                      <label>amount</label>
                      <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter amount" required>
                     </div>
              
                  </div>

                    <div class="col-md-6">
                       <div class="form-group">
                      <label>paid</label>
                      <input type="text" name="paid" id="paid" class="form-control" placeholder="Enter paid Amount" required>
                     </div>
              
                  </div>

                  <div class="col-md-12">
                        <div class="form-group">
                      <label>Note</label>
                       <textarea name="note" id="note" class="form-control" required> </textarea>
                            
                    </div>
                  </div>
           
                </div>
                <!-- text input -->
            
          

            </div>
              </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Edit changes</button>
              </div>
            </form>
          </div>
            <!-- /.modal-content -->
          </div>
        </div>
      </div>
    </div>    
   </div>
@endsection
@push('js')
<script src="{{asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.js"></script>
<script src="{{asset('backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
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
     $('#datepicker').datepicker({
      autoclose: true,
      todayHighlight: true
    })
</script>
<script>
  $(".edit-expense").click(function(){

    var expense_id =$(this).attr('expense_id');

    
              $.ajax({

              type: 'POST',
              url: "{{URL::to('/admin/expense/edit')}}",
              data : {expense_id:expense_id},
              dateType: 'json',
              success: function(data){
               $("#purpose").val(data.purpose);
               $("#expense_to").val(data.expense_to);
               $(".date").val(data.date);
               $("#amount").val(data.amount);
               $("#paid").val(data.paid);
               $("#vouchar_no").val(data.vouchar_no);
               $("#note").val(data.note);
               $("#id").val(data.id);



                  
               }
              
            });
  });
</script>
@endpush