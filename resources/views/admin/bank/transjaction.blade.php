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
              <h3 class="box-title"> Account Credit Transjaction</h3>

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
                </tr>
                </tfoot>
              </table>
            </div>
            <!--  -->
   <div class="box-header">
              <h3 class="box-title">Account Debit Transjaction</h3>

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

<
</script>
@endpush