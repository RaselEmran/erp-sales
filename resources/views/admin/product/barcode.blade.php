@extends('welcome')
@section('title','SELLS-ERP:Create Category')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/bower_components/select2/dist/css/select2.min.css')}}">
@endpush
@section('content')
<div class="box box-warning">
  <table class="table">
    <tbody>
     
      @for ($i = 0; $i <5 ; $i++)

     
    <tr>
      <td>
        <p>Product Name:{{$p_code->name}}</p>
        <img src='https://barcode.tec-it.com/barcode.ashx?data={{$p_code->code}}' alt='Barcode Generator TEC-IT'/ width="100px">
      </td>
      <td>
        <p>Product Name:{{$p_code->name}}</p>
        <img src='https://barcode.tec-it.com/barcode.ashx?data={{$p_code->code}}' alt='Barcode Generator TEC-IT'/ width="100px">
      </td>
      <td>
        <p>Product Name:{{$p_code->name}}</p>
        <img src='https://barcode.tec-it.com/barcode.ashx?data={{$p_code->code}}' alt='Barcode Generator TEC-IT'/ width="100px">
      </td>
      <td>
        <p>Product Name:{{$p_code->name}}</p>
        <img src='https://barcode.tec-it.com/barcode.ashx?data={{$p_code->code}}' alt='Barcode Generator TEC-IT'/ width="100px">
      </td>
    </tr>
         
       @endfor 
  
    </tbody>
  </table>

          
             
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
  $('.select2').select2()
</script>
@endpush