@extends('welcome')
@section('title','SELLS-ERP:Supplier Report')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
   <link href="{{asset('backend/dist/css/datatable.css')}}" rel="stylesheet">
@endpush
@section('content')
   <div class="box">
           <div class="box-header">
              <h3 class="box-title">Supplier Report</h3>
            
            </div>



            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Serial</th>
                  <th>Supplier Name</th>
                  <th>Amount</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

   <?php 
$al =DB::table('purchases')->distinct()->get(['supplier_name']);

foreach ($al as $key => $value) {
$supp =$value->supplier_name;
$ll =DB::table('suppliers')->where('id',$supp)->first();
 $bb =DB::table('purchases')->where('supplier_name', $supp)->sum('total');
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
    <a href="{{route('admin.report.singlesuppdetails',$supp)}}" class="btn btn-warning">Details</a>
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