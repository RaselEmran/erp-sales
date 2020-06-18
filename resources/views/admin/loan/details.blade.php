@extends('welcome')
@section('title','SELLS-ERP:Details Loan Report')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endpush
@section('content')
   <div class="box">
           <div class="box-header">
              <h3 class="box-title">Loan Details Report</h3>
            
            </div>
<div style="background: #777777;color: #fff;font-size: 22px;text-align: center;padding-bottom: 5px">
  Loanee Name:
  <?php 
$supp =DB::table('loanees')->where('id',$id)->first();
echo $supp->name;
   ?>
</div>
       <div class="row">
         <div class="col-md-3" style="background: #555555;padding: 18px; margin-left: 25px;color: #fff;font-size: 22px">
          <p>Total Pay Amount</p>
           <?php 
$exp =DB::table('loans')->where('loanee',$id)->sum('amount');
echo $exp;
            ?>
         </div>

    <div class="col-md-3" style="background: #555555;padding: 18px; margin-left: 25px;color: #fff;font-size: 22px">
          <p>Total Paid Amount</p>
           <?php 
$exp =DB::table('loans')->where('loanee',$id)->sum('paid');
echo $exp;
            ?>
         </div>
       </div>

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Serial</th>
                  <th>date</th>
                  <th>Pay Amt</th>
                  <th>Paid Amt</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

@foreach($single as $key=> $details)
<tr>
  <td>{{$key+1}}</td>
  <td>
      {{$details->date}}
  </td>


<td>
    {{$details->amount}}
</td>


<td>
    {{$details->paid}}
</td>
<td>
	<a href="{{route('admin.loan.edit',$details->id)}}" class="btn btn-info">Edit</a>
</td>

</tr>
@endforeach

                </tbody>
                <tfoot>
                <tr>
                <th>Serial</th>
                  <th>date</th>
                  <th>Pay Amt</th>
                  <th>Paid Amt</th>
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