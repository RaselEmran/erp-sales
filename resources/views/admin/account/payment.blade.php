@extends('welcome')
@section('title','SELLS-ERP:Payment system')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/bower_components/select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endpush
@section('content')
<div class="box box-warning">
            <div class="box-header with-border">
             <button id="addnew" class="btn btn-info">New Payment</button>
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
            <!-- /.box-header -->
            <div class="box-body" style="width: 60%;margin: auto; display: none" id="form_body">
              <form role="form" action="{{route('admin.account.payment')}}" method="post">
              	{{@csrf_field()}}
                <!-- text input -->
                <div class="row">
                	<div class="col-md-6">
                     	<div class="form-group">
	                  	 <label>Date</label>
	                  	 <input type="text" name="ac_date" class="form-control pull-right" id="datepicker" value="">
	                  
                	   </div>
                	</div>
                	<div class="col-md-6">
                     <div class="form-group">
                     <label>Description</label>
                      <textarea class="form-control" name="description" rows="3" placeholder="Enter description"></textarea>
                    </div>
                	</div>
                	<div class="col-md-6">
                       <div class="form-group">
		                  <label>Root Account*</label>
		                   <select class="form-control select2" name="root_acc" id="root_acc" style="width: 100%;">
		                    <option value="">Select Root</option>
		                    <option value="customer">Customer</option>
		                    <option value="supplier">Supplier</option>
		                    <option value="office">Office</option>
		                    <option value="loan">Loan</option>


		                   </select>
                 
                       </div>
                	</div>
                	<div class="col-md-6">
                      <div class="form-group" style="border-bottom: 5px;display: none" id="customer">
                       <label>Customer Name</label>
                       <input type="text" name="customer" class="form-control pull-right" value="">
                  
                     </div>

                         <div class="form-group" style="display: none" id="supplier">
                           <label>Supplier</label>
                           <?php 
                          $supplier =DB::table('suppliers')->get();
                            ?>
                           <select class="form-control select2" name="supplier" style="width: 100%;">
                           <option>Select an Supplier</option>
                            @foreach($supplier as $supp)
                            <option value="{{$supp->name}}">{{$supp->name}}</option>

                            @endforeach
                          </select>

                         </div>

                           <div class="form-group" style="display: none" id="office">
                           <label>Office</label>
                           <select class="form-control select2" name="office"  style="width: 100%;">
                           <option value="">Select an Office</option>
                            <option value="office">Office</option>
		                    <option value="office_expense">Office Expense</option>
		                    <option value="convince_bill">Convince Bill</option>
		                    <option value="stationary">Stationary</option>

                          </select>

                         </div>

                           <div class="form-group" style="display: none" id="loanname">
                           <label>Loan Name</label>
                            <input type="text" name="loan_name" class="form-control pull-right" value="">

                         </div>
                	</div>
                </div>
          
              <div class="row">
              	<div class="col-md-6">
              	  <div class="form-group">
                   <label>Payment Mode</label>
                    <select class="form-control select2" name="mode" id="mode" style="width: 100%;">
                      <option value="">Select an Mode</option>
                      <option value="cash">Cash</option>
                      <option value="check">Check</option>
  
                   </select>

              </div>
              	</div>
              	<div class="col-md-6"></div>
              	<div class="col-md-6">
              	 <div class="form-group">
                    <label>Payment Amount</label>
                    <input type="number" name="amount" class="form-control" value="">

                 </div>
              	</div>
              </div>
          
            <div class="row" id="check" style="display: none">
            	<div class="col-md-6">
            		 <div class="form-group">
                    <label>Cheque/Pay Order No *</label>
                    <input type="text" name="check_num" class="form-control" value="">

                 </div>
            	</div>
            	<div class="col-m-6"></div>

            		<div class="col-md-6">
            		 <div class="form-group">
                    <label>Date *</label>
                    <input type="text" name="check_date" class="form-control" id="datepicker1">

                 </div>
                 <div class="col-md-6">
                 	
                 </div>
            	</div>
            		<div class="col-md-6">
            		 <div class="form-group">
                    <label>Bank Name *</label>
                    <?php 
$bank=DB::table('banks')->get();
                     ?>
                      <select class="form-control select2" name="bank_name" id="mode" style="width: 100%;">
                      <option value="">Select an Mode</option>
                      @foreach($bank as $allbank)
                      <option value="{{$allbank->b_name}}">{{$allbank->b_name}}</option>

                      @endforeach
  
                   </select>

                 </div>
            	</div>
            </div>


                <button type="button" id="close" class="btn btn-danger pull-left">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
        </div>
   

                <div class="box-body" style="box-shadow: 3px 2px 2px #eee">
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                 <th>Serial</th>
                  <th>A/C Name</th>
                  <th>Payment Mode</th>
                  <th>Date</th>
                  <th>Amount</th>
                  <th>Action</th>

                </tr>
                </thead>
                <tbody>
@foreach($payment as $key=> $all)
    <tr>
      <td>{{$key+1}}</td>
      <td>{{$all->root_acc}}</td>
      <td>{{$all->mode}}</td>
      <td>{{$all->ac_date}}</td>
      <td>{{$all->amount}}</td>
  
      <td>
       <a href="{{route('admin.account.payedit',$all->id)}}" class="btn btn-info"">Edit</a>
          <button class="btn btn-danger" onclick="deleteTag(<?php echo $all->id ?>)"><i class="material-icons">delete</i></button>
        <form id="delete-form-{{$all->id}}" action="{{route('admin.account.pay_delete',$all->id)}}" method="post" style="display: none"> {{csrf_field()}}</form>
      </td>
    </tr>

@endforeach                

            </tbody>
                <tfoot>
                <tr>
                 <th>Serial</th>
                  <th>A/C Name</th>
                  <th>Payment Mode</th>
                  <th>Date</th>
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
<script src="{{asset('backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
 <script src="{{asset('backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.js"></script>
     <script>
function deleteTag(id){

  const swalWithBootstrapButtons = Swal.mixin({
  confirmButtonClass: 'btn btn-success',
  cancelButtonClass: 'btn btn-danger',
  buttonsStyling: false,
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
       swalWithBootstrapButtons.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'

    )
   event.preventDefault();
   var a= document.getElementById('delete-form-'+id).submit();
 

  } else if (
    // Read more about handling dismissals
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your Data is safe :)',
      'error'
    )
  }
})
  }
 </script>
  <script>
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
   $('#datepicker').datepicker({
      autoclose: true,
      todayHighlight: true
    })
    $('#datepicker1').datepicker({
      autoclose: true,
      todayHighlight: true
    })
     $('.select2').select2()
 </script>
  
  <script>
  	$("#root_acc").change(function(){
  		var root_acc =$(this).val();
  		console.log(root_acc);
  		if (root_acc =='customer') {
           $("#customer").show();
           $("#office").hide();
  		   $("#loanname").hide();
  		   $("#supplier").hide();

  		}
  		else if(root_acc =='supplier')
  		{
  			$("#supplier").show();
  			$("#customer").hide();
  			$("#office").hide();
  			$("#loanname").hide();
  		}

  		else if(root_acc =='office')
  		{
  			$("#office").show();
  			$("#customer").hide();
  			$("#loanname").hide();
  			$("#supplier").hide();
  		}
  		else if(root_acc =='loan')
  		{
  			$("#loanname").show();
  			$("#office").hide();
  			$("#customer").hide();

  			$("#supplier").hide();
  		}
  		else
  		{
  			$("#loanname").hide();
  			$("#office").hide();
  			$("#customer").hide();

  			$("#supplier").hide();
  		}
  	});

  	$("#mode").change(function(){
  		var mode=$("#mode").val();
  		if (mode=='check') {
           $("#check").show();
  		}
  	});

  	$("#close").click(function(){

     $("#form_body").hide(function(){
     		$("#addnew").show();
     });

  	});
  	$("#addnew").click(function(){
      $("#form_body").show(function(){
      	$("#addnew").hide();
      });
  	});
  </script>
@endpush