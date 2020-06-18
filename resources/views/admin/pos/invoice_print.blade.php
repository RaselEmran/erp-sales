@extends('welcome')
@section('title','SELLS-ERP:Product')
@push('css')
<link rel="stylesheet" href="{{asset('css/print.css')}}" media = "print">
@endpush
@section('content')
<body onload="window.print();">
 <section class="content">

   <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> ZOSH
            <small class="pull-right">Date:{{$pos->pos_date}}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-md-12 invoice-col text-center emran">
           @if($customer)
          <address>
            <strong>Customer:</strong><br>
            <span style="display: inline;"><b>Name:</b>{{$customer->name}},
            @if($customer->address)
            <b> Address:</b>{{$customer->address}},</span>
            @endif
            <b>Phone:</b> {{$customer->phone}}<br>
            <b>Order Date:</b> {{$pos->pos_date}}<br>
          </address>
          @else
         <p>No Select Customer</p>
         <b>Order Date:</b> {{$pos->pos_date}}<br>
          @endif
        </div>
        <!-- /.col -->
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
          $prevo =DB::table('due_infos')->where('invoice_id',$pos->id)->first();
        @endphp
      @if($prevo)
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
      @endif
        </div>
        <!-- /.col -->
        <div class="col-xs-6">

          <div class="table-responsive">
         <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>৳ {{$pos->sub_total}} </td>
              </tr>
              
              @if($pos->vat>0)
              <tr>
                  <th>Vat:</th>
                  <th>{{$pos->vat}} %</th>
              </tr>
               <tr>
                  <th>Vat Amt:</th>
                  <th>৳ {{$pos->vatvalue}}</th>
              </tr>
              @endif
              @if ($pos->discount>0)
                
              <tr>
                <th>Discount:</th>
                <td>৳ {{$pos->discount}}</td>
              </tr>
              @endif
              @if ($pos->percent>0)
               <tr>
                <th>Discount:</th>
                <td>{{$pos->percent}}<b>%</b></td>
              </tr>
               <tr>
                <th>Les Amount:</th>
                <td>৳ {{$pos->percent_amt}}</td>
              </tr>
              @endif
              <tr>
                <th>Net Total:</th>
                <td>৳ {{$pos->net_total}}</td>
              </tr>
              <tr>
                <th>Paid:</th>
                <td>৳ {{$pos->paid}}</td>
              </tr>
          @if($pos->due>0)
              <tr>
                <th>Due:</th>
                <td>৳ {{$pos->due}}</td>
              </tr>
          @endif

            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
           <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <address>
            <strong>52 Zahir AC Market. Shop Number:07</strong><br>
            New Elephant Road, Dhaka-1205<br>
            Cell:01683909195
          </address>
        </div>
        <!-- /.col -->
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <strong>Romana Afaz Sharok</strong><br>
            Joteshwaritala, Bogura<br>
        </div>

        <div class="col-sm-4">
               
        </div>
   
      </div>
      <div class="row">
        <div class="col-md-12">
            <center><i> ** ভ্যাট দিন, দেশ উন্নয়নে অংশ নিন ** </i></center>
        </div>
      </div>
      <!-- /.row -->

    </section>

</section>
</body>
@endsection
@push('js')
@endpush