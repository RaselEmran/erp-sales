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
<h3> Update Receipt</h3>
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
            <div class="box-body" style="width: 60%;margin: auto;" id="form_body">
              <form role="form" action="{{route('admin.account.upreceipt',$payment->id)}}" method="post">
              	{{@csrf_field()}}
                <!-- text input -->
                <div class="row">
                	<div class="col-md-6">
                     	<div class="form-group">
	                  	 <label>Date</label>
	                  	 <input type="text" name="ac_date" class="form-control pull-right" id="datepicker" value="{{$payment->ac_date}}">
	                  
                	   </div>
                	</div>
                	<div class="col-md-6">
                     <div class="form-group">
                     <label>Description</label>
                      <textarea class="form-control" name="description" rows="3" placeholder="Enter description">
                        {{$payment->description}}
                      </textarea>
                    </div>
                	</div>
                	<div class="col-md-6">
                       <div class="form-group">
		                  <label>Root Account*</label>
		               <input type="text" name="root_acc" readonly class="form-control pull-right" value="{{$payment->root_acc}}">
                 
                       </div>
                	</div>
                	<div class="col-md-6">
                    @if($payment->root_acc =='customer')
                      <div class="form-group" style="border-bottom: 5px;" id="customer">
                       <label>Customer Name</label>
                       <input type="text" name="customer" class="form-control pull-right" value="{{$payment->customer}}">
                  
                     </div>
                      @elseif($payment->root_acc =='supplier')
                         <div class="form-group"  id="supplier">
                           <label>Supplier</label>
                           <?php 
                          $supplier =DB::table('suppliers')->get();
                            ?>
                           <select class="form-control select2" name="supplier" style="width: 100%;">

                            @foreach($supplier as $supp)
                            <option {{$payment->supplier == $supp->name ? 'selected' : ''}} value="{{$supp->name}}">{{$supp->name}}</option>

                            @endforeach
                          </select>

                         </div>
                         @elseif($payment->root_acc =='office')

                           <div class="form-group"  id="office">
                           <label>Office</label>
                           <select class="form-control select2" name="office"  style="width: 100%;">
                            <option {{$payment->office == 'office' ? 'selected' : ''}}  value="office">Office</option>
		                    <option  {{$payment->office == 'office_expense' ? 'selected' : ''}}  value="office_expense">Office Expense</option>
		                    <option {{$payment->office == 'convince_bill' ? 'selected' : ''}}  value="convince_bill">Convince Bill</option>
		                    <option {{$payment->office == 'stationary' ? 'selected' : ''}}  value="stationary">Stationary</option>

                          </select>

                         </div>
                         @elseif($payment->root_acc =='loan')
                           <div class="form-group"  id="loanname">
                           <label>Loan Name</label>
                            <input type="text" name="loan_name" class="form-control pull-right" value="{{$payment->loan_name}}">

                         </div>
                         @endif
                	</div>
                </div>
          
              <div class="row">
              	<div class="col-md-6">
              	  <div class="form-group">
                   <label>Payment Mode</label>
                    <input type="text" name="mode" readonly class="form-control pull-right" value="{{$payment->mode}}">

              </div>
              	</div>
              	<div class="col-md-6"></div>
              	<div class="col-md-6">
              	 <div class="form-group">
                    <label>Payment Amount</label>
                    <input type="text" name="amount" class="form-control" value="{{$payment->amount}}">

                 </div>
              	</div>
              </div>
          @if($payment->mode=='check')
            <div class="row" id="check" >
            	<div class="col-md-6">
            		 <div class="form-group">
                    <label>Cheque/Pay Order No *</label>
                    <input type="text" name="check_num" class="form-control" value="{{$payment->check_num}}">

                 </div>
            	</div>
            	<div class="col-m-6"></div>

            		<div class="col-md-6">
            		 <div class="form-group">
                    <label>Date *</label>
                    <input type="text" name="check_date" class="form-control" id="datepicker1" value="{{$payment->check_date}}">

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
                      <option  {{$payment->bank_name == $allbank->b_name ? 'selected' : ''}}  value="{{$allbank->b_name}}">{{$allbank->b_name}}</option>

                      @endforeach
  
                   </select>

                 </div>
            	</div>
            </div>
            @endif


                <button type="button" id="close" class="btn btn-danger pull-left">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
        </div>
      </div>
   @endsection
@push('js')
<script src="{{asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
 <script src="{{asset('backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
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
  

@endpush