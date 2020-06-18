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
<div style="background: #777777;color: #fff;font-size: 22px;text-align: center;padding-bottom: 5px">
  Supplier Name:
  <?php 
$supp =DB::table('suppliers')->where('id',$id)->first();
echo $supp->name;
   ?>
</div>
       <div class="row">
         <div class="col-md-3" style="background: #555555;padding: 18px; margin-left: 25px;color: #fff;font-size: 22px">
          <p>Total Amount</p>
           <?php 
$exp =DB::table('purchases')->where('supplier_name',$id)->sum('total');
echo $exp;
            ?>
         </div>
       </div>

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Serial</th>
                  <th>Purchase Date</th>
                  <th>Amount</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>

@foreach($single as $key=> $details)
<tr>
  <td>{{$key+1}}</td>
  <td>
      {{$details->supp_date}}
  </td>


<td>
    {{$details->total}}
</td>


<td>
    {{$details->status}}
</td>

</tr>
@endforeach

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