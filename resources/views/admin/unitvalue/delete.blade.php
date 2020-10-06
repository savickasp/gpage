@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-row flex-wrap">
        <div class="row-60percent p-1">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <th>Pavadinimas</th>
                    <td>{{ $unitvalue->name }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="d-inline-block row-40percent p-4">
            <form action="{{ route('admin.unitvalue.destroy', $unitvalue->id) }}" method="post">

                @csrf
                @method('delete')

                <div class="form-group">
                    <label for="name">ivesti mato vieneto pavadinima</label>
                    <input name="name" type="text" class="form-control" value="{{ old('name') }}">
                </div>
                @error('name')
                <div>{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>
    </div>
@endsection
