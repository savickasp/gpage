@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-column">
        <div class="d-flex flex-row flex-wrap">
            <div class="row-60percent p-1">
                <modification-details :product='@json($product)' :modification='@json($modification)'></modification-details>
            </div>
            <div class="d-inline-block row-40percent p-1">
                <span>Logotipas</span>
            </div>
        </div>
    </div>
@endsection
