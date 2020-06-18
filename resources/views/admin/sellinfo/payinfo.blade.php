@extends('welcome')
@section('title','SELLS-ERP:Sell')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endpush
@section('content')
   <div class="box">
            <div class="box-header">
              <h3 class="box-title">Paid Sell Information</h3>
            </div>
            <!-- /.box-header -->
               @if(session('sms'))
                  <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Success - </b> {{session('sms')}}</span>
                  </div>
                  @endif
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
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Serial</th>
                  <th>Customer Name</th>
                  <th>Date</th>
                  <th>Sub Total</th>
                  <th>Discount</th>
                  <th>Net Total</th>
                  <th>Due</th>
                  <th>Paid</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
   @foreach($pos as $key=> $sell)

<tr>
  <td>{{$key+1}}</td>
  <td>{{$sell->cus_name}}</td>
  <td>{{$sell->pos_date}}</td>
  <td>{{$sell->sub_total}}</td>
  <td>{{$sell->discount}}</td>
  <td>{{$sell->net_total}}</td>
  <td>{{$sell->due}}</td>

  <td>{{$sell->paid}}</td>


  <td>
    <a href="{{route('admin.sellinfo.invoice',$sell->id)}}" class="btn btn-success">Invoice</a>
     
  </td>
</tr>


   @endforeach
                </tbody>
                <tfoot>
                <tr>
                 <th>Serial</th>
                  <th>Customer Name</th>
                  <th>Date</th>
                  <th>Sub Total</th>
                  <th>Discount</th>
                  <th>Net Total</th>
                  <th>Due</th>
                  <th>Paid</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
   
          <!-- /.modal-dialog -->
   </div>
@endsection
@push('js')
<script src="{{asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.js"></script>
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