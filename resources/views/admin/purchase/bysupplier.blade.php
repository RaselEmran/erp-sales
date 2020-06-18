@extends('welcome')
@section('title','SELLS-ERP:By Supplier:Purchase')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
 <link rel="stylesheet" href="{{asset('backend/bower_components/select2/dist/css/select2.min.css')}}">
@endpush
@section('content')
   <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Purchase</h3>
            <?php 
$suppliers =DB::table('suppliers')->get();
   ?>   
            </div>
             <div class="row">
      <div class="col-md-8" style="margin-left: 10px">
      	       <div class="form-group">
                <label>Supplier</label>
                <select class="form-control select2" name="supplier_name" id="supplier_name" style="width: 100%;">
                  <option>Select Supplier</option>
        @foreach($suppliers as $supp)
                 <option  value="{{$supp->id}}">{{$supp->name}}</option>
        @endforeach
                </select>

              </div>
      </div>
             </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Date</th>
                  <th> Total</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody id="body">

                </tbody>
                <tfoot>
                <tr>
                 <th>Date</th>
                  <th> Total</th>
                  <th>Status</th>
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
<script src="{{asset('backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

    
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
  $("#supplier_name").change(function(){

    var supplier_name =$(this).val();


    $.ajax({

              type: 'POST',
              url: "{{URL::to('/admin/purchase/searching')}}",
              data : {supplier_name:supplier_name},
              dateType: 'text',
              success: function(data){
          console.log(data);
          
                  $('#body').html(data);
                  $('#body').find(table).dataTables();
               }
              
            });
  });
</script>
<script>
    $('.select2').select2()
</script>
@endpush