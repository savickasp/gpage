@extends('layouts.admin')

@section('script')
    <script src="{{ asset('tinymce/tinymce.min.js') }}" rel="stylesheet"></script>
    <script>
        tinymce.init({
            selector:'#manufacturer-description',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            height: 500,
            width: 2000
        });
    </script>
@endsection

@section('content')
    <form action="{{ route('admin.modification.update', ['product' => $product, 'modification' => $modification]) }}" method="post">

        @csrf
        @method('patch')

        <div class="form-group d-flex flex-row">
            <label for="name" class="col-3">Modifikacijos pavadinimas</label>
            <input name="name" type="text" class="form-control col-9" value="{{ old('name') ?? ($modification->name ?? null) }}">
        </div>
        @error('name')
        <div class="alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group d-flex flex-row">
            <label for="price" class="col-3">Kaina</label>
            <input name="price" type="number" class="form-control col-9" value="{{ old('price') ?? ($modification->price ?? null) }}">
        </div>
        @error('slug')
        <div class="alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
@endsection
