@extends('layouts.admin')

@section('content')
    <table class="table">
        <tbody>
        <tr>
            <td>Susietas produktų modifikacijų kiekis</td>
            <td>{{ count($unitvalue->modifications ?? []) }}</td>
        </tr>
        </tbody>
    </table>

    <form action="{{ route('admin.unitvalue.update', $unitvalue->id) }}" method="post">

        @csrf
        @method('patch')

        <div class="form-group d-flex flex-row">
            <label for="name" class="col-3">Mato vieneto pavadinimas</label>
            <input name="name" type="text" class="form-control col-9" value="{{ old('name') ?? ($unitvalue->name ?? null) }}">
        </div>
        @error('name')
        <div class="alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
@endsection
