@extends('welcome')
@section('title','SELLS-ERP:Category')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endpush
@section('content')
   <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Category</h3>
              <p> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-category">
                Add Category
              </button></p>
            </div>
            <!-- /.box-header -->
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
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Serial</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
   @foreach($category as $key=> $cat)

<tr>
  <td>{{$key+1}}</td>
  <td>{{$cat->name}}</td>
  <td>{{$cat->description}}</td>
  <td>
    <a href="" class="btn btn-info edit-category"  data-toggle="modal" data-target="#modal-editcategory" category_id="{{$cat->id}}">Edit</a>
        <button class="btn btn-danger" onclick="deleteTag(<?php echo $cat->id ?>)"><i class="material-icons">delete</i></button>
        <form id="delete-form-{{$cat->id}}" action="{{route('admin.category.delete',$cat->id)}}" method="post" style="display: none"> {{csrf_field()}}</form>
  </td>
</tr>


   @endforeach
                </tbody>
                <tfoot>
                <tr>
                 <th>Serial</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
   </div>
        <div class="modal fade" id="modal-category">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
              <div class="box-body">

              <form role="form" action="{{route('admin.category.store')}}" method="post">
                {{@csrf_field()}}
                <!-- text input -->
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter Category name" required>
                </div>
                <!-- textarea -->
                <div class="form-group">
                  <label>Description</label>
                   <textarea name="description" class="form-control"> </textarea>
                        
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

          <!-- /.modal-dialog -->
  </div>

<!-- edit code -->
        <div class="modal fade" id="modal-editcategory">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
              <div class="box-body">

              <form role="form" action="{{route('admin.category.update')}}" method="post">
                {{@csrf_field()}}
                <!-- text input -->
                 <div class="form-group">
                
                  <input type="hidden" name="id" id="id" class="form-control" placeholder="Enter Category name" required>
                </div>
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Enter Category name" required>
                </div>
                <!-- textarea -->
                <div class="form-group">
                  <label>Description</label>
                   <textarea name="description" id="description" class="form-control"> </textarea>
                        
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
    
          <!-- /.modal-dialog -->
   </div>
@endsection
@push('js')
<script src="{{asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
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
</script>

<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
<script>
  $(".edit-category").click(function(){

    var category_id =$(this).attr('category_id');
    


              $.ajax({

              type: 'POST',
              url: "{{URL::to('/admin/category/edit')}}",
              data : {category_id:category_id},
              dateType: 'json',
              success: function(data){
                $("#id").val(data.id);
              $("#name").val(data.name);
              $("#description").text(data.description);
                  
               }
              
            });
  });
</script>
@endpush