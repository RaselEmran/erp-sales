@extends('welcome')
@section('title','SELLS-ERP:Expense Report')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
 <link href="{{asset('backend/dist/css/datatable.css')}}" rel="stylesheet">
@endpush
@section('content')
   <div class="box">
           <div class="box-header">
              <h3 class="box-title">Expense Report</h3>

            </div>
       <div class="row">
         <div class="col-md-3" style="background: #555555;padding: 18px; margin-left: 25px;color: #fff;font-size: 22px">
          <p>Total Pay Amount</p>
          @if (isset($expense))
            {{$expense->sum('amount')}}
          @endif

         </div>

    <div class="col-md-3" style="background: #555555;padding: 18px; margin-left: 25px;color: #fff;font-size: 22px">
          <p>Total Paid Amount</p>
          @if (isset($expense))
            {{$expense->sum('paid')}}
          @endif
         </div>
       </div>
            <div style="display: block;width: 50%;margin: auto;">
              <div class="row" style="margin-top: 30px">
                <div class="col-md-6">
                <div class="form-group" style="float: right;">

                <div class="input-group">
                  <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                    <span>
                      <i class="fa fa-calendar"></i>Select Date to Date
                    </span>
                    <i class="fa fa-caret-down"></i>
                  </button>

                </div>
                </div>
              </div>
                <div class="col-md-6" style="float: left;">
                <form action="{{ route('admin.report.rng-expensereport') }}" method="post">
            {{@csrf_field()}}
                <input type="hidden" name="start" id="strat" value="{{date('m/d/Y')}}">
                <input type="hidden" name="end" id="end" value="{{date('m/d/Y')}}">
                <button type="submit" class="btn btn-success">Genarate</button>
              
              </form>
                </div>
              </div>

            </div>

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Serial</th>
                  <th>Expense To</th>
                  <th>Vouchar Name</th>
                  <th>Date</th>
                  <th>Amount</th>
                  <th>Paid</th>
                </tr>
                </thead>
                <tbody>
@if (isset($expense))
@foreach($expense as $key=> $allexpense)
<tr>
  <td>{{$key+1}}</td>
  <td>{{$allexpense->expense_to}}</td>
  <td>{{$allexpense->vouchar_no }}</td>
  <td>{{$allexpense->date}}</td>
  <td>{{$allexpense->amount}}</td>
  <td>{{$allexpense->paid}}</td>

</tr>
@endforeach
 @endif

                </tbody>
                <tfoot>
                <tr>
               <th>Serial</th>
                  <th>Client Name</th>
                  <th>date</th>
                  <th>Net Total</th>
                  <th>Paid Amt</th>
                  <th>Due Amt</th>
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