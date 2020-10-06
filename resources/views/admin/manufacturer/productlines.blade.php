@extends('layouts.admin')

@section('content')
    <div class="w-100">
        <manufacturer-hasmany-product-lines :manufacturer='@json($manufacturer)'></manufacturer-hasmany-product-lines>
    </div>
@endsection
