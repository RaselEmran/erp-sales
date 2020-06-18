@extends('welcome')
@section('title','SELLS-ERP:Create Category')
@push('css')

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
              <form role="form" action="{{route('admin.category.store')}}" method="post">
              	{{@csrf_field()}}
                <!-- text input -->
                <div class="form-group">
                  <label>Category</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter Category Name">
                </div>

                <!-- textarea -->
                <div class="form-group">
                  <label>Textarea</label>
                  <textarea class="form-control" name="description" rows="3" placeholder="Enter description"></textarea>
                </div>
                <button type="reset" class="btn btn-danger pull-left" data-dismiss="modal">Reset</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
        </div>
    </div>

@endsection
@push('js')

@endpush