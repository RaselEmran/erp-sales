@extends('welcome')
@section('title','SELLS-ERP:Create Category')
@push('css')
  <link rel="stylesheet" href="{{asset('backend/bower_components/select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endpush
@section('content')
 <section class="content">
 	<?php 
$customer =DB::table('clients')->get();
 	 ?>
  <div class="box box-default">
          <div class="box-body">
                @if(session('msg'))
                  <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Success - </b> {{session('msg')}}</span>
                  </div>
                  @endif

           <form action="{{route('admin.sellinfo.update',$pos->id)}}" method="post">
    	    {{@csrf_field()}}  
    	     	    <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Customer</label>
                <select class="form-control select2" name="customer_name" style="width: 100%;" >
                  <option>Select Customer</option>
        @foreach($customer as $cust)
                 <option {{$custom->id == $cust->id ? 'selected' : ''}} value="{{$cust->id}}">{{$cust->name}}</option>
        @endforeach
                </select>

              </div>
         

               <div class="form-group">
                <label>Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="pos_date" class="form-control pull-right" id="datepicker" value="{{$pos->pos_date}}" readonly>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form-group -->
            </div>

            <div class="col-md-6">

             </div>
             <div class="row">
             	<div class="col-md-12">
             		<table class ="table">
             		  	<thead>
              		<th>Item Name</th>
              		<th>Item Price</th>
              		<th>Qty</th>
              		<th>Amount</th>
              	       </thead>

              	  <tbody  style="background: #097095; color: #f00;border: 1px solid black; padding: 7px">
              		    @foreach($details as $item)
                    <tr>
                      <td><input type="text" name="product_name[]" value="{{$item->product_name}}" readonly/><input type="hidden" name="pid[]" value="{{$item->product_id}}" readonly"/><input type="hidden" name="code[]" value="{{$item->code}}" readonly/></</td>
                      <td><input type="text" name="price[]" class="price" id="price" value="{{$item->price}}" readonly/></td>
                      <td><input type="text" name="qty[]" class="qty" id="qty" value="{{$item->qty}}" readonly/><input type="hidden" name="h_qty[]" class="h_qty" id="h_qty" value="{{$item->qty}}"/></td>
                      '<td><span class="amt" >{{$item->qty*$item->price}}</span></td>'
                    </tr>
                  @endforeach
                 	</tbody>
             		</table>
             	</div>

             	<div class="col-md-6"></div>
             	<div class="col-md-6">
             		   <table class="table">
                 	<tbody>
                 		<tr>
                 			<td>
                 				Sub Total
                 			</td>
                 			<td>
                 				<input type="text" class="form-control" name="sub_total" id="sub_total" readonly required="" value="{{$pos->sub_total}}" readonly>
                 			</td>
                 		</tr>

                 		<tr>
                 			<td>
                 				Discount
                 			</td>
                 			<td>
                 				<input type="text" class="form-control" name="discount" id="discount" value="{{$pos->discount}}" readonly>
                 			</td>
                 		</tr>

                 		<tr>
                 			<td>
                 				Net Total
                 			</td>
                 			<td>
                 				<div style="background: #097095;color: #fff;height: 80px;font-size: 25px" id="net">
                 					{{$pos->net_total}}
                 				</div>
                 				<input type="hidden" class="form-control" name="net_total" id="net_total" value="{{$pos->net_total}}" readonly>
                 			</td>
                 		</tr>

                 		<tr>
                 			<td>
                 				Paid
                 			</td>
                 			<td>
                 				<input type="text" class="form-control" name="paid" id="paid" value="{{$pos->paid}}"  readonly>
                 			</td>
                 		</tr>

                    <tr>
                     <td><span style="font-weight: bold;">New Pay</span></td>

                     <td>
                     <input type="text" name="new_pay" id="new_pay" class="form-control form-control-sm must" required >
                    </td>
                   </tr>
                 			<tr>
                 			<td>
                 				Due
                 			</td>
                 			<td>
                 				<input type="text" class="form-control" name="due" id="due" readonly value="{{$pos->due}}">
                 			</td>
                 		</tr>
                 		<tr>
                 			<td>Status</td>
                 			<td>
                 <div class="form-group">

                <select class="form-control select2" name="status" style="width: 100%;">
                  <option>Select Status</option>
                  <option {{$pos->status =='Order' ? 'selected' : ''}} value="Order">Order</option>
                  <option {{$pos->status =='Delivered' ? 'selected' : ''}} value="Delivered">Delivered</option>
                </select>

              </div>
                 			</td>
                 		</tr>
                 		<tr>

                 			<td><input type="submit" name="submit" value="Pay Amt" class="btn btn-info">
                               <input type="reset" name="reset" value="Reset" class="btn btn-danger">
                 			</td>
                 			

                 		</tr>
                 	</tbody>
                 </table>
             	</div>
             </div>
        </div>
     </form>     
</div>
</div>


</section>                  
@endsection
@push('js')
<script src="{{asset('backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.js"></script>
 <script src="{{asset('backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

 <script>
 $('#datepicker').datepicker({
      autoclose: true,
      todayHighlight: true
    })
 //....
   $('.select2').select2()
 </script>

 <script>
  
 $("#new_pay").keyup(function(){
    var net_total =parseInt($("#net_total").val());
    var paid_amt =parseInt($("#paid").val());
    var new_pay =parseInt($("#new_pay").val());
    if (!paid_amt) {
      paid_amt=0;
    }

    var a=paid_amt+new_pay;
    var b=net_total-a;
    $("#due").val(b);
   });
</script>
@endpush