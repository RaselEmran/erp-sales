@extends('welcome')
@section('title','SELLS-ERP:Pos')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
 <link rel="stylesheet" href="{{asset('backend/bower_components/select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endpush
@section('content')
 <section class="content">
 	<?php 
$customer =DB::table('clients')->get();
 	 ?>

  <div class="box box-default">
        @if(session('msg'))
                  <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      <b> Success - </b> {{session('msg')}}</span>
                  </div>
                  @endif
          <div class="box-body">
    <form action="{{route('admin.pos.update',$pos->id)}}" method="post">
    	    {{@csrf_field()}}
    	    <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Customer</label>
                <select class="form-control select2" name="customer_name" style="width: 100%;">
                 
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
                  <input type="text" name="pos_date" class="form-control pull-right" id="datepicker" value="{{$pos->pos_date}}">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form-group -->
            </div>
            <div class="col-md-6">
                <div style="display: inline-block; margin-top: 22px;">
                 	 <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-category">
                     New Customer
                    </button>
                 </div>

                 <table class="table">
                 	<tbody>
                 		<tr>
                 			<td>
                 				Sub Total
                 			</td>
                 			<td>
                 				<input type="text" class="form-control" name="sub_total" id="sub_total" readonly value="{{$pos->sub_total}}">
                 			</td>
                 		</tr>

                 		<tr>
                 			<td>
                 				Discount
                 			</td>
                 			<td>
                 				<input type="text" class="form-control" name="discount" id="discount" value="{{$pos->discount}}">
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
                 				<input type="hidden" class="form-control" name="net_total" id="net_total" value="{{$pos->net_total}}">
                 			</td>
                 		</tr>

                 		<tr>
                 			<td>
                 				Paid
                 			</td>
                 			<td>
                 				<input type="text" class="form-control" name="paid" id="paid" value="{{$pos->paid}}" readonly>
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
                 				<input type="text" class="form-control" name="due" id="due" value="{{$pos->due}}" readonly>
                 			</td>
                 		</tr>
                 		<tr>
                 			<td>Status</td>
                 			<td>
                 <div class="form-group">

                <select class="form-control select2" name="status" style="width: 100%;">
                  <option {{$pos->status =='Order' ? 'selected' : ''}} value="Order">Order</option>
                  <option {{$pos->status =='Delivered' ? 'selected' : ''}} value="Delivered">Delivered</option>
                </select>

              </div>
                 			</td>
                 		</tr>
                 		<tr>

                 			<td><input type="submit" name="submit" value="Submit" class="btn btn-info">
                       <input type="reset" name="reset" value="Reset" class="btn btn-danger">
                 			</td>
                 			

                 		</tr>
                 	</tbody>
                 </table>
            </div>
            <!-- /.col -->
            <!-- /.col -->
          </div>

          <div class="row">
          	<?php 
$product =DB::table('products')->where('status',1)->get();
          	 ?>
          	<div class="col-md-6">
          <div class="form-group">
                <label>Product</label>
                <select  class="form-control select2" id="product" style="width: 100%;">
                  <option>Select Product</option>
        @foreach($product as $pro)
                 <option value="{{$pro->id}}">{{$pro->name}}</option>
        @endforeach
                </select>

              </div>
              <table class="table">
              	<thead>
              		<th>Item Name</th>
              		<th>Item qty</th>
              		<th>Price</th>
              		<th>Amount</th>
              		<th>Action</th>
              	</thead>
              	<tbody id="item" style="background: #097095; color: #f00;border: 1px solid black; padding: 7px">
              		@foreach($details as $item)
                    <tr>
                    	<td><input type="text" name="product_name[]" value="{{$item->product_name}}" readonly/><input type="hidden" name="pid[]" value="{{$item->product_id}}" readonly"/><input type="hidden" name="code[]" value="{{$item->code}}" readonly/></</td>
                    	<td><input type="text" name="price[]" class="price" id="price" value="{{$item->price}}" readonly/></td>
                    	<td><input type="text" name="qty[]" class="qty" id="qty" value="{{$item->qty}}"/><input type="hidden" name="h_qty[]" class="h_qty" id="h_qty" value="{{$item->qty}}"/></td>
                    	'<td><span class="amt" >{{$item->qty*$item->price}}</span></td>'
                    	<td><button type="button" name="remove" class="btn btn-danger btn-sm remmove"><span class="glyphicon glyphicon-minus"></span></button></td>
                    </tr>
              		@endforeach
              	</tbody>
              </table>
          	</div>
          </div>
    </form>
          <!-- /.row -->
        </div>
    </div>

    <!-- Modal view -->
            <div class="modal fade" id="modal-category">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Client</h4>
              </div>
              <div class="modal-body">
              <div class="box-body">

              <form role="form" action="{{route('admin.client.store')}}" method="post" enctype="multipart/form-data">
                {{@csrf_field()}}
                <!-- text input -->
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter Client name" required>
                </div>
                  <div class="form-group">
                  <label>Email</label>
                  <input type="text" name="email" class="form-control" placeholder="Enter Client Email" required>
                </div>
                  <div class="form-group">
                  <label>Phone</label>
                  <input type="text" name="phone" class="form-control" placeholder="Enter Client Phone" required>
                </div>
                <!-- textarea -->
                <div class="form-group">
                  <label>Address</label>
                   <textarea name="address" class="form-control"> </textarea>
                        
                </div>
                <div class="row">
                	<div class="col-md-6">
                		 <div class="form-group">
		                  <label>Image</label>
		                  <input type="file" name="image" accept="image/*" onchange="preview_image(event)">
		                 </div>
                	</div>
                	<div class="col-md-6">
                		<img id="output_image"/ style="width: 90px;height: 90px">
                	</div>
                </div>

            </div>
              </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>
            <!-- /.modal-content -->
          </div>
        </div>
      </div>
    </div>

</section>
@endsection
@push('js')
<script src="{{asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.js"></script>
 <script src="{{asset('backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

 <script>
 	 $('#datepicker').datepicker({
      autoclose: true,
      todayHighlight: true
     // format: 'dd/mm/yyyy',
    //startDate: '-3d'
    })
 </script>
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
  $('.select2').select2()
</script>
<script>
	function preview_image(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>


<script>
  $("#product").change(function(){

  	var product =$(this).val();

  	    $.ajax({

              type: 'POST',
              url: "{{URL::to('/admin/pos/append')}}",
              data : {product:product},
              dateType: 'text',
              success: function(data){
                 
                  $("#item").append(data);
                  calculate(0,0);	
               }
              
            });
  });
$("#item").on('click','.remmove',function(){
 $(this).closest('tr').remove();
 calculate(0,0);
       
})
$("#item").delegate(".qty","keyup",function(){
	var qty =$(this);
	var tr =$(this).parent().parent();

	tr.find(".amt").html(qty.val() * tr.find(".price").val());
	calculate(0,0);		
		
	
})

$("#item").delegate(".qty","keyup",function(){
 var net_total= $("#net_total").val();
 var paid= $("#paid").val();
 var due =net_total-paid;
 $("#due").val(due);
  
})
$("#discount").blur(function(event) {
   var net_total= $("#net_total").val();
    var paid= $("#paid").val();
  var due =net_total-paid;
 $("#due").val(due);
});
function calculate(dis,paid)
{
  var sub_total =0;
  var net_total =0;
  var discount =dis;
  var paid_amt =paid;
  var due =0;
  $(".amt").each(function(){
    sub_total =sub_total + ($(this).text() * 1);
  })
 net_total =sub_total;
 net_total = net_total -discount;
 due =net_total - paid_amt;
  $("#sub_total").val(sub_total);
  $("#discount").val(discount);
  $("#net").text(net_total);
  $("#net_total").val(net_total);
  $("#due").val(due);
}
$("#discount").keyup(function(){
  var discount  =$(this).val();
  calculate(discount,paid);
})
$("#paid").keyup(function(){
  var paid =$(this).val();
  var discount =$("#discount").val();
  calculate(discount,paid);
})

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