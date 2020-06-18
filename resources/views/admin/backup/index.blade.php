@extends('welcome')
@section('title','SELLS-ERP:Bank')
@push('css')

@endpush
@section('content')
<div class="box">
<div class="row" style="max-width: 80%;margin: auto;">
<div class="well well-sm"><a href="{{ route('admin.product.backup') }}" class="btn btn-primary btn-block">Product Backup</a></div>

<div class="well well-lg"><a href="{{ route('admin.category.backup') }}" class="btn btn-primary btn-block">Category Backup</a></div>

<div class="well well-lg"><a href="{{ route('admin.supplier.backup') }}" class="btn btn-primary btn-block">Supplier Backup</a></div>

<div class="well well-lg"><a href="{{ route('admin.client.backup') }}" class="btn btn-primary btn-block">Client Backup</a></div>

<div class="well well-lg"><a href="" class="btn btn-primary btn-block">Expence Backup</a></div>

<div class="well well-lg"><a href="" class="btn btn-primary btn-block">Loan Backup</a></div>

<div class="well well-lg"><a href="" class="btn btn-primary btn-block">Bank Backup</a></div>

<div class="well well-lg"><a href="" class="btn btn-primary btn-block">Account Backup</a></div>
</div>
</div>
@endsection
@push('js')

@endpush