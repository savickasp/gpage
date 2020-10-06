@extends('layouts.admin')

@section('content')
    <div>
        <a href="{{ route('admin.productline.create') }}" class="btn btn-outline-primary m-2">Naujas</a>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>pavadinimas</th>
                <th>url pavadinimas</th>
                <th>veiksmai</th>
            </tr>
            </thead>
            <tbody>
            @foreach($productlines as $productline)
                <tr>

                    <td><a href="{{ route('admin.productline.show', $productline->id) }}">{{ $productline->name }}</a></td>

                    <td>{{ $productline->slug }}</td>

                    <td>
                        <a href="{{ route('admin.productline.show', $productline->id) }}" class="btn btn-outline-primary">Peržiūrėti</a>
                        <a href="{{ route('admin.productline.edit', $productline->id) }}" class="btn btn-outline-primary">Redaguoti</a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
