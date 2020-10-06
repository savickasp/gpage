@extends('layouts.admin')

@section('content')
    <div class="w-100">
        <product-line-hasmany-products :productline='@json($productLine)'></product-line-hasmany-products>
    </div>
@endsection
