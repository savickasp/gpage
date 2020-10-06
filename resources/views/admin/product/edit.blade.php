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
    <form action="{{ route('admin.product.update', $product->id) }}" method="post">

        @csrf
        @method('patch')

        <div class="form-group d-flex flex-row">
            <label for="name" class="col-3">Produkto pavadinimas</label>
            <input name="name" type="text" class="form-control col-9" value="{{ old('name') ?? ($product->name ?? null) }}">
        </div>
        @error('name')
        <div class="alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group d-flex flex-row">
            <label for="slug" class="col-3">Url pavadinimas</label>
            <input name="slug" type="text" class="form-control col-9" value="{{ old('slug') ?? ($product->slug ?? null) }}">
        </div>
        @error('slug')
        <div class="alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group d-flex flex-row">
            <label for="description" class="col-3">Aprasymas </label>
            <textarea name="description" id="manufacturer-description" class="col-9">{{ old('description') ?? ($product->description ?? null) }}</textarea>
        </div>
        @error('description')
        <div class="alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
@endsection
