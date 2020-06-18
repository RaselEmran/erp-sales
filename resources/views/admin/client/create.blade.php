@extends('welcome')
@section('title','SELLS-ERP:Create Client')
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
</div>
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
</script>
@endpush