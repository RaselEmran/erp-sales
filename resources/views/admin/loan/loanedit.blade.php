@extends('welcome')
@section('title','SELLS-ERP:Update Loan')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endpush
@section('content')
<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Loan Update</h3>
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
            <div class="box-body" style="padding: 20px;width: 50%;display: block;margin: auto;">
        
              <form role="form" action="{{route('admin.loan.update',$loan->id)}}" method="post" enctype="multipart/form-data">
                {{@csrf_field()}}
                <!-- text input -->
                <div class="form-group">
                  <label>Date</label>
                  <input type="text" name="date" value="{{$loan->date}}" id="datepicker" class="form-control" placeholder="Enter date" required>
                </div>
                <div class="form-group">
                  <label>Lonee</label>
                <select class="form-control select2" name="loanee" style="width: 100%;">
                  <?php 
         $lonne =DB::table('loanees')->get();
                   ?>
                  <option>Select Lonee</option>
                   @foreach($lonne as $loans)
                  <option {{$loan->loanee == $loans->id ? 'selected' : ''}} value="{{$loans->id}}">{{$loans->name}}</option>
                   @endforeach
                </select>
                </div>
                <div class="form-group">
                  <label>Lender</label>
                  <?php 
          $londer =DB::table('lenders')->get();
                   ?>
                <select class="form-control select2" name="lendar" style="width: 100%;">
                  <option>Select Lender</option>
                   @foreach($londer as $value)
                  <option {{$loan->lendar == $value->id ? 'selected' : ''}} value="{{$value->id}}">{{$value->name}}</option>
                   @endforeach
                </select>
                </div>

                  <div class="form-group">
                  <label>Amount</label>
                  <input type="text" name="amount" value="{{$loan->amount}}" class="form-control" placeholder="Enter Amount" required>
                </div>

                  <div class="form-group">
                  <label>Paid</label>
                  <input type="text" name="paid" value="{{$loan->paid}}" class="form-control" placeholder="Enter Paid Amount" required>
                </div>
                <!-- textarea -->
                <div class="form-group">
                  <label>Note</label>
                   <textarea name="note" class="form-control">{{$loan->note}} </textarea>
                        
                </div>

       
       
                <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
         </div>
            </form>
        </div>
    </div>

@endsection
@push('js')
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
    $('.select2').select2()
 </script>
@endpush