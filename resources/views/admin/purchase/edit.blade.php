@extends('welcome')
@section('title','SELLS-ERP:Sell')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/select2/dist/css/select2.min.css')}}">

@endpush
@section('content')
 <section class="content">
  <?php 
$suppliers =DB::table('suppliers')->get();
   ?>
  <div class="box box-default">
          <div class="box-body">
    <form action="{{route('admin.purchase.update',$purchases->id)}}" method="post">
          {{@csrf_field()}}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Supplier</label>
                <select class="form-control select2" name="supplier_name" style="width: 100%;">
                  <option>Select Supplier</option>
        @foreach($suppliers as $supp)
                 <option {{$supplier->id == $supp->id ? 'selected' : ''}} value="{{$supp->id}}">{{$supp->name}}</option>
        @endforeach
                </select>

              </div>
         

               <div class="form-group">
                <label>Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="supp_date" value="{{$purchases->supp_date}}" class="form-control pull-right" id="datepicker">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form-group -->
            </div>
            <div class="col-md-6">
              <p style="margin-top: 25px"> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-product">
                Add New Product
              </button></p>
            </div>
          </div>

     <div class="row clearfix">
    <div class="col-md-12">
      <table class="table table-bordered table-hover" id="tab_logic">
        <thead>
          <tr>
            <th class="text-center"> Product </th>
            <th class="text-center"> Qty </th>
            <th class="text-center"> Price </th>
            <th class="text-center"> Total </th>
            <th>Action</th>
          </tr>
        </thead>
        <?php 
$products =DB::table('products')
         ->orderby('id' , 'desc')
         ->get();
 ?>
        <tbody id="item">
@foreach($details as $detail)

   <tr>
     <td>
       <select name="product_id[]" class="form-control select2 pid" style="width:100%" >
       @foreach($products as $product)
 <option {{$detail->product_id == $product->id ? 'selected' : ''}} value="{{$product->id}}">{{$product->name}}</option>
       @endforeach
       </select>
       <input type="hidden"  name="product_name[]" value="{{$detail->product_name}}" required class="form-control name" />
     </td>
     <td>
       <input type="text" name="qty[]" value="{{$detail->qty}}" required class="form-control qty" />
     </td>
     <td>
       <input type="text"  name="price[]" value="{{$detail->price}}" required class="form-control price" />
     </td>
     <td>
       <span class="amt">{{$detail->qty*$detail->price}}</span>
     </td>
     <td><button class="btn btn-danger" id="delete">-</button></td>
   </tr>

@endforeach
        </tbody>
      </table>
      <table class="table ">
        <tbody style="float: right;">
          <tr>
            <td></td>
            <td></td>
            <td>Total</td>
            <td>
              <input type="text" class="form-control" value="{{$purchases->total}}" name="total" id="total" readonly>
            </td>
          </tr>
            <tr>
            <td></td>
            <td></td>
            <td>Status</td>
            <td>
           <select class="form-control select2" name="status" style="width: 100%;">
             <option value="Order">Order</option>
             <option value="Received">Received</option>
           </select>
            </td>
          </tr>
            <tr>
            <td></td>
            <td></td>
            <td>
          <input type="reset" class="btn btn-danger" value="Reset">
          <input type="submit" class="btn btn-primary" value="Edit">
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

    <div class="row clearfix">
    <div class="col-md-12">
      <button type="button" id="add_row" class="btn btn-info pull-left">Add New</button>
    </div>
   </div>
    </form>
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
                      <label>Product Code</label>
                      <input type="text" name="code" class="form-control" placeholder="Enter Product Code" required>
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
                     </div>
              </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>
</section>
@endsection
@push('js')
<script src="{{asset('backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
 <script src="{{asset('backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
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
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
   $('#datepicker').datepicker({
      autoclose: true,
      todayHighlight: true
    })
 </script>

<?php 
$product =DB::table('products')
         ->orderby('id' , 'desc')
         ->get();
 ?>
<script>
  // add();
  $("#add_row").click(function(){
  add();

  });
  function add(){
     var html = '';
     html += '<tr id="dell">';
     html += '<td><select name="product_id[]" class="form-control select2 pid" style="width:100%" ><option>select Product</option>'+'<?php 
   
   foreach ($product as $key => $value) {
    echo '<option value="'.$value->id.'">'.$value->name.'</optrion>';
 
     }
    ?>'+ '</select><input type="hidden"  name="product_name[]" required class="form-control name" /></td>';
     html += '<td><input type="text"  name="qty[]" required class="form-control qty" /></td>';
     html += '<td><input type="text"  name="price[]" required class="form-control price" /></td>';
     html+='<td><span class="amt">00</span></td>';
     html += '<td><button class="btn btn-danger" id="delete">-</button></td></tr>';
     $("#item").append(html);
     $("#item").find('select').select2();
}

  $("#item").on('click','#delete',function(){
  $(this).closest('tr').remove();
   total();       
   })
  $("#item").delegate(".price","keyup",function(){
  //  var qty =$(this);
   var tr =$(this).parent().parent();
   var price =tr.find(".price").val();
   var qty =tr.find(".qty").val();
   tr.find(".amt").text(price*qty);
    total();
  });

  function total()
  {
    var sub_total =0;
    $(".amt").each(function(){
    sub_total =sub_total + ($(this).text() * 1);
  })
    $("#total").val(sub_total);
    
  }

  $("#item").delegate(".pid","change",function(){
    var pid =$(this).val();
 
    var tr =$(this).parent().parent();
   

        $.ajax({

              type: 'POST',
              url: "{{URL::to('/admin/purchase/product')}}",
              data : {pid:pid},
              dateType: 'json',
              success: function(data){
                 tr.find(".name").val(data.name);

               }
              
            });
  });
</script>

<script>
    $('.select2').select2()
</script>
@endpush