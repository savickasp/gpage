@extends('layouts.admin')

@section('content')
    <div>
        <a href="{{ route('admin.manufacturer.create') }}" class="btn btn-outline-primary m-2">Naujas</a>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>pavadinimas</th>
                <th>url pavadinimas</th>
                <th>produktų linijų</th>
                <th>veiksmai</th>
            </tr>
            </thead>

            <tbody>
            @foreach($manufacturers as $manufacturer)
                <tr>
                    <td><a href="{{ route('admin.manufacturer.show', $manufacturer->id) }}">{{ $manufacturer->name }}</a></td>

                    <td>{{ $manufacturer->slug }}</td>

                    <td>{{ count($manufacturer->productlines) }}</td>

                    <td>
                        <a href="{{ route('admin.manufacturer.show', $manufacturer->id) }}" class="btn btn-outline-primary">Peržiūrėti</a>
                        <a href="{{ route('admin.manufacturer.edit', $manufacturer->id) }}" class="btn btn-outline-primary">Redaguoti</a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
