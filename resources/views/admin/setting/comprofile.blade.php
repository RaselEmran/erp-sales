@extends('welcome')
@section('title','SELLS-ERP:Transfer Account')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endpush
@section('content')
<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Company Profile Setting</h3>
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
            <div class="box-body" style="width: 60%;margin: auto;">
              <form role="form" action="{{route('admin.setting.company')}}" method="post" enctype="multipart/form-data">
                {{@csrf_field()}}
                <!-- text input -->
                 <div class="form-group">
                  <label> Name</label>
                  <input type="text" name="name" class="form-control pull-right" value="{{$company->name}}" required>
                  
                </div>

                  <div class="form-group">
                  <label>Address</label>
                  <input type="text" name="Addess" class="form-control pull-right" value="{{$company->Addess}}" required >
                  
                </div>

                 <div class="form-group">
                  <label>Mobile</label>
                  <input type="text" name="mobile" class="form-control pull-right" value="{{$company->mobile}}" required>
                  
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <input type="text" name="email" class="form-control pull-right" value="{{$company->email}}" required >
                  
                </div>

                <div class="form-group">
                  <label>Website</label>
                  <input type="url" name="website" class="form-control pull-right" value="{{$company->website}}" required>
                  
                </div>

               <div class="form-group">
                <label>logo</label>
               <input type="file" name="image">
               <img src="{{asset($company->image)}}" alt="" width="70px">

              </div>
                <button type="reset" class="btn btn-danger pull-left" data-dismiss="modal">Reset</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
        </div>
    </div>

@endsection
@push('js')
<script src="{{asset('backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
 <script src="{{asset('backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
  <script>
   $('#datepicker').datepicker({
      autoclose: true,
      todayHighlight: true
    })
     $('.select2').select2()
 </script>

@endpush