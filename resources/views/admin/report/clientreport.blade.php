@extends('welcome')
@section('title','SELLS-ERP:Client Report')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
 <link href="{{asset('backend/dist/css/datatable.css')}}" rel="stylesheet">
@endpush
@section('content')
   <div class="box">
           <div class="box-header">
              <h3 class="box-title">Client Report</h3>
            
            </div>



            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Serial</th>
                  <th>Client Name</th>
                  <th>Paid Amt</th>
                  <th>Due Amt</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

   <?php 
$al =DB::table('pos')->distinct()->get(['customer_name']);

foreach ($al as $key => $value) {
$supp =$value->customer_name;
$ll =DB::table('clients')->where('id',$supp)->first();
 $paid =DB::table('pos')->where('customer_name', $supp)->sum('paid');
 $due =DB::table('pos')->where('customer_name', $supp)->sum('due');
?>
<tr>
  <td>
    <?php echo $key+1 ?>
  </td>
  <td>
   <?php echo $ll->name ?>
  </td>
  <td>
    <?php echo $paid; ?>
  </td>
  <td>
    <?php echo $due ?>
  </td>
  <td>
    <a href="{{route('admin.report.singleclientdetails',$supp)}}" class="btn btn-warning">Details</a>
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
                  <th>Paid Amt</th>
                  <th>Due Amt</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
          
   </div>
@endsection
@push('js')
<script src="{{asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('backend/bower_components/datatables.net/js/datatables_button.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/bower_components/datatables.net/js/datatables_flash.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/bower_components/datatables.net/js/datatables_jszip.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/bower_components/datatables.net/js/datatables_pdfmake.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="{{asset('backend/bower_components/datatables.net/js/datatables_buttons.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/bower_components/datatables.net/js/datatables_print.min.js')}}"></script>
   <script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
  $(function () {
    $('#example1').DataTable(
{
        dom: 'lBfrtip',
        buttons: [
            { extend:'copy', attr: { id: 'allan' } }, 'csv', 'excel', 'pdf', 'print'
        ]
    }
      )
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