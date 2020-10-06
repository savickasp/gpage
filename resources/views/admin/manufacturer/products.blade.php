@extends('layouts.admin')

@section('content')
    <div class="w-100">
        <manufacturer-hasmany-products :manufacturer='@json($manufacturer)'></manufacturer-hasmany-products>
    </div>
@endsection
