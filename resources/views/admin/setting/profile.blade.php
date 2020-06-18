@extends('welcome')
@section('title','SELLS-ERP:Payment system')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/bower_components/select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endpush
@section('content')
<div class="box box-warning">

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
            <div class="box-body" style="width: 60%;margin: auto;padding-top: 15px" id="form_body">
              <h2>User Profile Update</h2>
              <form role="form" action="{{route('admin.user.upprofile',$profile->id)}}" method="post" enctype="multipart/form-data">
              	{{@csrf_field()}}
                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                      <label>User Email</label>
                      <input type="text" name="email" class="form-control" value="{{$profile->email}}" readonly>
                     </div>

                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" name="name" class="form-control" value="{{$profile->name}}" required>
                     </div>
                     <div class="form-group">
                      <label>Image</label>
                      <input type="file" name="image" class="form-control">
                     </div>
                  </div>
                  <div class="col-md-6">
                    @if(empty($profile->image))
                   <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                   @else
                   <img src="{{asset($profile->image)}}" class="img-circle" alt="User Image" width="80px">
                    @endif
                  </div>
                </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
              </form>
              
        </div>

             <div class="box-body" style="width: 60%;margin: auto;padding-top: 15px" id="form_body">
              <h2>User Password Change</h2>
              <form role="form" action="{{route('admin.user.upppass',$profile->id)}}" method="post">
                {{@csrf_field()}}
                <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                 
                      <input type="hidden" name="email" id="email" class="form-control" value="{{$profile->email}}" readonly>
                     </div>

                    <div class="form-group">
                      <label>Old Password</label>
                      <input type="password" name="old" id="old" class="form-control" value="" required>
                      <div  id="show"></div>
                     </div>
                     <div class="form-group">
                      <label>New Password</label>
                      <input type="password" name="new" class="form-control" required>
                     </div>
                  </div>
                </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Change Password</button>
              </div>
              </form>
              
        </div>
      </div>

@endsection
@push('js')
<script src="{{asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.js"></script>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

</script>

<script>
  $("#old").blur(function(){

    var old =$(this).val();
    var email =$("#email").val();
    


              $.ajax({

              type: 'POST',
              url: "{{URL::to('/admin/user/changepassword')}}",
              data : {old:old,email:email},
              dateType: 'text',
              success: function(data){
               $("#show").html(data);

               }
              
            }); 
  });
</script>
@endpush