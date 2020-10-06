@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.unitvalue.store') }}" method="post">

        @csrf

        <div class="form-group d-flex flex-row">
            <label for="name" class="col-3">Mato vienetas pavadinimas</label>
            <input name="name" type="text" class="form-control col-9" value="{{ old('name') }}">
        </div>
        @error('name')
        <div class="alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
@endsection
