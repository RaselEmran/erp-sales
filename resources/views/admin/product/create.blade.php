@extends('welcome')
@section('title','SELLS-ERP:Create Category')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/select2/dist/css/select2.min.css')}}">
@endpush
@section('content')
<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">General Elements</h3>
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
             <div class="modal-footer">
                <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          

            </div>
          
             
        </div>
    </div>

@endsection
@push('js')
<script src="{{asset('backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
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
  $('.select2').select2()
</script>
@endpush