@extends('welcome')
@section('title','SELLS-ERP:Transfer Account')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endpush
@section('content')
<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Account Transfer</h3>
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
              <form role="form" action="{{route('admin.transfer.transfer-from')}}" method="post">
              	{{@csrf_field()}}
                <!-- text input -->
                  <div class="form-group">
                <label>From</label>
                <select class="form-control select2" name="frombank" id="frombank" style="width: 100%;">
                  <option>Select an Account</option>
        @foreach($bank as $frombank)
                 <option value="{{$frombank->ac_name}}">{{$frombank->ac_name}}</option>
        @endforeach
                </select>

              </div>

               <div class="form-group">
                <label>From</label>
                <select class="form-control select2" name="tobank" style="width: 100%;">
                  <option>Select an Account</option>
        @foreach($bank as $tobank)
                 <option value="{{$tobank->ac_name}}">{{$tobank->ac_name}}</option>
        @endforeach
                </select>

              </div>
                <div class="form-group">
                  <label>Date</label>
                  <input type="text" name="ac_date" class="form-control pull-right" id="datepicker">
                  
                </div>

                <!-- textarea -->
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description" rows="3" placeholder="Enter description"></textarea>
                </div>
                 <div class="form-group" style="border-bottom: 5px">
                  <label>Amount</label>
                  <input type="text" name="ac_amount" class="form-control pull-right">
                  
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