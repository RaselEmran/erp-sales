@extends('welcome')
@section('title','SELLS-ERP:Product')
@push('css')

@endpush
@section('content')
 <section class="content">

  <section class="invoice">
      <!-- title row -->
      <div id="div1">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i>SELLS-ERP
            <small class="pull-right">Date:{{$pos->pos_date}}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
          From
          <address>
            <strong>Customer.</strong><br>
            Name : {{$customer->name}}<br>
            Address : {{$customer->address}}<br>
            Phone: {{$customer->phone}}<br>
            Email: {{$customer->email}}
          </address>
        </div>
        <!-- /.col -->

        <!-- /.col -->
        <div class="col-sm-6 invoice-col">
          <b>Invoice #{{$pos->id}}</b><br>
          <br>
          <b>Order Date:</b> {{$pos->pos_date}}<br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Serial</th>
              <th>Name</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Total</th>
            </tr>
            </thead>
            <tbody>
           @foreach($details as $key=> $full)
             <tr>
               <td>{{$key+1}}</td>
               <td>{{$full->product_name}}</td>
               <td>{{$full->qty}}</td>
               <td>{{$full->price}}</td>
               <td>{{$full->qty*$full->price}}</td>
             </tr>
           @endforeach
         
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
           <div class="col-xs-6">
         <h5 style="background: #3C8DBC;padding: 8px;text-align:center;">Previous Pay History</h5>
        @php
          $prev =DB::table('due_infos')->where('invoice_id',$pos->id)->get();
        @endphp
        <table class="table">
          <thead>
            <tr>
              <th>Date</th>
              <th>Pay Amount</th>
              <th>Due Amount</th>

            </tr>
          </thead>
          <tbody>
          @foreach ($prev as $element)
           <tr>
             <td>{{$element->date}}</td>
             <td>{{$element->pay_amt}}</td>
             <td>{{$element->due_amt}}</td>
             

           </tr>
          @endforeach
        </tbody>
        </table>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>{{$pos->sub_total}}</td>
              </tr>
              <tr>
                <th>Discount</th>
                <td>{{$pos->discount}}</td>
              </tr>
              <tr>
                <th>Net Total:</th>
                <td>{{$pos->net_total}}</td>
              </tr>
              <tr>
                <th>Paid:</th>
                <td>{{$pos->paid}}</td>
              </tr>
              <tr>
                <th>Due:</th>
                <td>{{$pos->due}}</td>
              </tr>

            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
    </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
           <button type="button" class="btn btn-success pull-right" onclick="printContent('div1')"><i class="fa fa-print"></i> Print
          </button>
  
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>
        </div>
      </div>
    </section>
</section>
@endsection
@push('js')
 <script>
function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}
</script>
@endpush