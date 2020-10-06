@extends('layouts.admin')

@section('content')
    <div>
        <a href="{{ route('admin.unitvalue.create') }}" class="btn btn-outline-primary m-2">Naujas</a>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>pavadinimas</th>
                <th>veiksmai</th>
            </tr>
            </thead>
            <tbody>
            @foreach($unitvalues as $unitvalue)
                <tr>

                    <td>{{ $unitvalue->name }}</td>

                    <td>
                        <a href="{{ route('admin.unitvalue.edit', $unitvalue->id) }}" class="btn btn-outline-primary">Redaguoti</a>
                        <a href="{{ route('admin.unitvalue.delete', $unitvalue->id) }}" class="btn btn-outline-danger">Istrinti</a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
