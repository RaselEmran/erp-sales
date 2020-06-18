@extends('welcome')
@section('title','SELLS-ERP:Create Expense')
@push('css')

@endpush
@section('content')
<div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Expense</h3>
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
              <form role="form" action="{{route('admin.expense.store')}}" method="post">
              	{{@csrf_field()}}
                          <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                      <label>Expense Purpose</label>
                      <input type="text" name="purpose" class="form-control" placeholder="Enter Expense purpose" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                       <div class="form-group">
                      <label>Expense To</label>
                      <input type="text" name="expense_to" class="form-control" placeholder="Enter Expense_to" required>
                     </div>
              
                  </div>

                  <div class="col-md-6">
                       <div class="form-group">
                      <label>date</label>
                      <input type="text" name="date" id="datepicker" class="form-control" placeholder="Date" required>
                     </div>
              
                  </div>


                     <div class="col-md-6">
                      <div class="form-group">
                      <label>vouchar_no</label>
                      <input type="text" name="vouchar_no" class="form-control" placeholder="Enter vouchar_no" required>
                     </div>
                  </div>

                     <div class="col-md-6">
                       <div class="form-group">
                      <label>amount</label>
                      <input type="text" name="amount" class="form-control" placeholder="Enter amount" required>
                     </div>
              
                  </div>

                    <div class="col-md-6">
                       <div class="form-group">
                      <label>paid</label>
                      <input type="text" name="paid" class="form-control" placeholder="Enter paid Amount" required>
                     </div>
              
                  </div>

                  <div class="col-md-12">
                        <div class="form-group">
                      <label>Note</label>
                       <textarea name="note" class="form-control" required> </textarea>
                            
                    </div>
                  </div>
           
                </div>
                <button type="reset" class="btn btn-danger pull-left" data-dismiss="modal">Reset</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
        </div>
    </div>

@endsection
@push('js')

@endpush