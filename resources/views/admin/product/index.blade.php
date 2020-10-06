@extends('layouts.admin')

@section('content')
    <div>
        <a href="{{ route('admin.product.create') }}" class="btn btn-outline-primary m-2">Naujas</a>
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
            @foreach($products as $product)
                <tr>

                    <td><a href="{{ route('admin.product.show', $product->id) }}">{{ $product->name }}</a></td>

                    <td>{{ $product->slug }}</td>

                    <td>
                        <a href="{{ route('admin.product.show', $product->id) }}" class="btn btn-outline-primary">Peržiūrėti</a>
                        <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-outline-primary">Redaguoti</a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
