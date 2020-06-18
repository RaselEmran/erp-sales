@extends('welcome')
@section('title','SELLS-ERP:Product')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
 <link rel="stylesheet" href="{{asset('backend/bower_components/select2/dist/css/select2.min.css')}}">
@endpush
@section('content')
   <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Product</h3>
              <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-product">
                Add Product
              </button></p>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Serial</th>
                  <th>Name</th>
                  <th>Cost</th>
                  <th>Price</th>
                  <th>Stock</th>

                  <th>Image</th>
                  <th>QR/Code</th>
                  <th>Bar/Code</th>
                  <th>Code</th>
                  <th>Action</th>

                </tr>
                </thead>
                <tbody>
   @foreach($product as $key=> $v_pro)

<tr>
  <td>{{$key+1}}</td>
  <td>{{$v_pro->name}}</td>
  <td>{{$v_pro->cost}}</td>
  <td>{{$v_pro->price}}</td>
  <td>{{$v_pro->stock}}</td>

  <td><img src="{{asset($v_pro->image)}}" alt="" style="width: 90px"></td>
  <td> <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='Name:{{$v_pro->name }}Price:{{$v_pro->price}}'" title="{{$v_pro->name}}" width="80px"></td>
    <td>   <img src='https://barcode.tec-it.com/barcode.ashx?data={{$v_pro->code}}' alt='Barcode Generator TEC-IT'/ width="80px"></td>
  <td>{{$v_pro->code}}</td>

</td>

  <td>
    <a href="" class="btn btn-info edit-product"  data-toggle="modal" data-target="#modal-editproduct" product_id="{{$v_pro->id}}">Edit</a>
    <a href="" class="btn btn-success stock-product"  data-toggle="modal" data-target="#modal-stockproduct" product_id="{{$v_pro->id}}">Stock</a>
    <a href="{{ route('admin.product.barcode',$v_pro->id) }}" class="btn btn-primary">Barcode</a>
         <button class="btn btn-danger" onclick="deleteTag(<?php echo $v_pro->id ?>)"><i class="material-icons">delete</i></button>
        <form id="delete-form-{{$v_pro->id}}" action="{{route('admin.product.delete',$v_pro->id)}}" method="post" style="display: none"> {{csrf_field()}}</form>

  </td>
</tr>


   @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Serial</th>
                  <th>Name</th>
                  <th>Cost</th>
                  <th>Price</th>
                  <th>Image</th>
                  <th>QR/Code</th>
                  <th>Bar/Code</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
        </div>

        <!--  -->
         <div class="modal fade bd-example-modal-lg" id="modal-product">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Product</h4>
              </div>
              <div class="modal-body">
              <div class="box-body">

              <form role="form" action="{{route('admin.product.store')}}" method="post"  enctype="multipart/form-data">
                {{@csrf_field()}}

                <div class="row">
                	<div class="col-md-6">
		                  <div class="form-group">
		                  <label>Product Quantity</label>
		                  <input type="text" name="stock" class="form-control" placeholder="Enter Product Quantity" required>
		                 </div>
		              </div>
                	<div class="col-md-6">
                		   <div class="form-group">
		                  <label>Product Name</label>
		                  <input type="text" name="name" class="form-control" placeholder="Enter Product name" required>
		                 </div>
		          
                	</div>
			                  <?php 
                          $cat =DB::table('categories')->get();
			                   ?>
                	    <div class="col-md-6">
		                  <div class="form-group">
		                  <label>Category</label>
					         <select class="form-control select2" name="category" style="width: 100%;" required>
			                  <option>Select Category</option>
							@foreach($cat as $v_cat)
                            <option value="{{$v_cat->id}}">{{$v_cat->name}}</option>

							@endforeach
			           
			                </select>
		                 </div>
		              </div>
                	<div class="col-md-6">
                		   <div class="form-group">
		                  <label>cost</label>
		                  <input type="text" name="cost" class="form-control" placeholder="Enter Product Cost" required>
		                 </div>
		          
                	</div>

                	   <div class="col-md-12">
		                  <div class="form-group">
		                  <label>Price</label>
		                  <input type="text" name="price" class="form-control" placeholder="Enter Product Price" required>
		                 </div>
		              </div>

                	<div class="col-md-12">
                		    <div class="form-group">
		                  <label>Description</label>
		                   <textarea name="description" class="form-control" required> </textarea>
		                        
		                </div>
                	</div>
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
                <!-- text input -->
            
          

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

          <!-- /.modal-dialog -->

          <!-- Edit Product -->

         <div class="modal fade bd-example-modal-lg" id="modal-editproduct">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Product</h4>
              </div>
              <div class="modal-body">
              <div class="box-body">

              <form role="form" action="{{route('admin.product.update')}}" method="post"  enctype="multipart/form-data">
                {{@csrf_field()}}

                <div class="row">
                  	<div class="col-md-6">
		                  <div class="form-group">
                        <input type="hidden" name="id" id="id" class="form-control" placeholder="Enter Product Code" required style="display: none;">

		                  <label>Product Quantity</label>
		                  <input type="text" name="stock" id="stock" class="form-control" placeholder="Enter Product Code" readonly>
		                 </div>
		              </div>
                	<div class="col-md-6">
                		   <div class="form-group">
		                  <label>Product Name</label>
		                  <input type="text" name="name" id="name" class="form-control" placeholder="Enter Product name" required>
		                 </div>
		          
                	</div>
			        
                	    <div class="col-md-6">
		                  <div class="form-group" id="dropdown">
		                  <label>Category</label>
					         <select class="form-control select2" name="category" style="width: 100%;">

			           
			                </select>
		                 </div>
		              </div>
                	<div class="col-md-6">
                		   <div class="form-group">
		                  <label>cost</label>
		                  <input type="text" name="cost" id="cost" class="form-control" placeholder="Enter Product Cost" required>
		                 </div>
		          
                	</div>

                	   <div class="col-md-12">
		                  <div class="form-group">
		                  <label>Price</label>
		                  <input type="text" name="price" id="price" class="form-control" placeholder="Enter Product Price" required>
		                 </div>
		              </div>

                	<div class="col-md-12">
                		    <div class="form-group">
		                  <label>Description</label>
		                   <textarea name="description" id="description" class="form-control" required> </textarea>
		                        
		                </div>
                	</div>
                	   <div class="col-md-6">
                		   <div class="form-group">
		                  <label>Image</label>
		                  <input type="file" name="image" accept="image/*" onchange="preview_image1(event)">
		                 </div>
		          
                	</div>
                	<div class="col-md-6">
                		<img id="output_image1"/ style="width: 90px;height: 90px" src="" class="">
                	</div>
                </div>
                <!-- text input -->
            
          

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
  </div>
  {{-- stock --}}
           <div class="modal fade bd-example-modal-lg" id="modal-stockproduct">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Product</h4>
              </div>
              <div class="modal-body">
              <div class="box-body">

              <form role="form" action="{{route('admin.product.newstock')}}" method="post"  enctype="multipart/form-data">
                {{@csrf_field()}}

                <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                      <label>Product Quantity</label>
                      <input type="text" name="avial_stock" id="avial_stock" class="form-control" placeholder="Enter Product Quantity" required>
                      <input type="hidden" name="id" id="idnum">
                      <input type="hidden" name="product_code" id="product_code">

                     </div>
                  </div>
                  <div class="col-md-12">
                       <div class="form-group">
                      <label>New Quantity</label>
                      <input type="text" name="up_quantity" id="up_quantity" class="form-control" placeholder="Enter Quantity" required>
                     </div>
              
                  </div>

                    <div class="col-md-12">
                       <div class="form-group">
                      <label>Total Quantity</label>
                      <input type="text" name="total_qty" id="total_qty" class="form-control" required value="0">
                     </div>
              
                  </div>
                </div>
                <!-- text input -->
            
          

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

@endsection
@push('js')
<script src="{{asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.js"></script>
     <script>

    @if ($errors->any())
       @foreach ($errors->all() as $error)
        
         toastr.error('{{$error}}');
      @endforeach
     @endif

        @if(session('msg'))
        
                toastr.success('{{session('msg')}}');
                <?php 
                Session::put('msg',null);
                 ?>
       @endif
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
  function preview_image1(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image1');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>

<script>
  $(".edit-product").click(function(){

    var product_id =$(this).attr('product_id');
    


              $.ajax({

              type: 'POST',
              url: "{{URL::to('/admin/product/edit')}}",
              data : {product_id:product_id},
              dateType: 'json',
              success: function(data){
                $("#id").val(data.id);
                  $("#stock").val(data.stock);
                  $("#name").val(data.name)
                  $("#cost").val(data.cost);
                  $("#price").val(data.price);
                  $("#description").text(data.description);
                  $("#output_image1").attr("src",'/'+
                    data.image);
               }
              
            });

              $.ajax({

              type: 'POST',
              url: "{{URL::to('/admin/product/dropdown')}}",
              data : {product_id:product_id},
              dateType: 'text',
              success: function(data){

                  $("#dropdown").html(data);
                    $("#dropdown").find('.select2').select2();
               }
              
            });  
  });

  $(".stock-product").click(function(){
    var product_id =$(this).attr('product_id');
    
            $.ajax({

              type: 'GET',
              url: "{{URL::to('/admin/product/stock')}}",
              data : {product_id:product_id},
              dateType: 'text',
              success: function(data){
                console.log(data);
                $("#avial_stock").val(data.stock);
                $("#idnum").val(data.id);
                $("#product_code").val(data.code);

               }
              
            }); 
  });
</script>

 <script>
   $( "#up_quantity").on('keyup',function () {
var avail_qty =parseInt($("#avial_stock").val()); 
   var up_quantity =parseInt($('#up_quantity').val());
   if (isNaN(up_quantity) || up_quantity=="") {
    up_quantity=0;
   }
   var total = avail_qty + up_quantity;
   $('#total_qty').val(total);
});
 </script>
@endpush