@extends('welcome')
@section('title','SELLS-ERP:Sells Report')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
 <link href="{{asset('backend/dist/css/datatable.css')}}" rel="stylesheet">
@endpush
@section('content')
   <div class="box">
           <div class="box-header">
              <h3 class="box-title">Stock Report</h3>
            
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                      <th>ID</th>
                      <th>Item Id</th>
                      <th> Item Name</th>
                      <th>Available Stock</th>
                      <th>Today Add</th>
                      <th>Date and Time</th>
                    </tr>
                </thead>
                <tbody>
@foreach ($product as $key=> $element)
  <tr>
    <td>
      {{$key+1}}
    </td>
    <td>
      {{$element->code}}
    </td>
    <td>
      {{$element->name}}
    </td>
    <td>
      {{$element->stock}}
    </td>
    @php
       $date =date('m/d/Y');
       $pid =$element->id;
       $stock= DB::table('product_stocks')->where('product_id',$pid)->where('date',$date)->sum('item_stock');

    @endphp
    <td>
    @if ($stock)
      {{$stock}}
      @else
     @php
       echo '<span class="label label-info">No Stock Addedd Today</span>';
     @endphp
    @endif
    </td>
    <td>
      {{$element->created_at}}
    </td>
  </tr>
@endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Item Id</th>
                  <th> Item Name</th>
                  <th>Available Stock</th>
                  <th>Today Add</th>
                  <th>Date and Time</th>
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

      $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        $("#strat").val(start.format('MM/DD/Y')); 
        $("#end").val(end.format('MM/DD/Y')); 


      }
    )
</script>
@endpush