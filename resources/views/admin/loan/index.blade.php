@extends('welcome')
@section('title','SELLS-ERP:Supplier Report')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/bower_components/select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endpush
@section('content')
   <div class="box">
           <div class="box-header">
              <h3 class="box-title">Supplier Report</h3>
               <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-loan">
                Add Loan
              </button></p>
            </div>

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Serial</th>
                  <th>Lonee</th>
                  <th>Amount</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

<?php 
$al =DB::table('loans')->distinct()->get(['loanee']);

foreach ($al as $key => $value) {
$supp =$value->loanee;
$ll =DB::table('loanees')->where('id',$supp)->first();
$bb =DB::table('loans')->where('loanee', $supp)->sum('paid');
?>
<tr>
  <td>
    <?php echo $key+1 ?>
  </td>
  <td>
   <?php echo $ll->name ?>
  </td>
  <td>
    <?php echo $bb; ?>
  </td>
  <td>
    <a href="{{route('admin.loan.singledetails',$supp)}}" class="btn btn-warning">Details</a>
  </td>
</tr>



<?php

}
?>

                </tbody>
                <tfoot>
                <tr>
                <th>Serial</th>
                  <th>Supplier Name</th>
                  <th>Amount</th>
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
                <h4 class="modal-title">Add Loan</h4>
              </div>
              <div class="modal-body">
              <div class="box-body">

              <form role="form" action="{{route('admin.loan.store')}}" method="post" enctype="multipart/form-data">
                {{@csrf_field()}}
                <!-- text input -->
                <div class="form-group">
                  <label>Date</label>
                  <input type="text" name="date" id="datepicker" class="form-control" placeholder="Enter date" required>
                </div>
                <div class="form-group">
                  <label>Lonee</label>
                <select class="form-control select2" name="loanee" style="width: 100%;">
                  <?php 
         $lonne =DB::table('loanees')->get();
                   ?>
                  <option>Select Lonee</option>
                   @foreach($lonne as $loan)
                  <option value="{{$loan->id}}">{{$loan->name}}</option>
                   @endforeach
                </select>
                </div>
                <div class="form-group">
                  <label>Lender</label>
                  <?php 
          $londer =DB::table('lenders')->get();
                   ?>
                <select class="form-control select2" name="lendar" style="width: 100%;">
                  <option>Select Lender</option>
                   @foreach($londer as $lender)
                  <option value="{{$lender->id}}">{{$lender->name}}</option>
                   @endforeach
                </select>
                </div>

                  <div class="form-group">
                  <label>Amount</label>
                  <input type="text" name="amount" class="form-control" placeholder="Enter Amount" required>
                </div>

                  <div class="form-group">
                  <label>Paid</label>
                  <input type="text" name="paid" class="form-control" placeholder="Enter Paid Amount" required>
                </div>
                <!-- textarea -->
                <div class="form-group">
                  <label>Note</label>
                   <textarea name="note" class="form-control"> </textarea>
                        
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

   </div>
@endsection
@push('js')
<script src="{{asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
 <script src="{{asset('backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
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
@endpush