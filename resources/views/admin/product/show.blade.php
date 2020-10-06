@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-column">
        <div class="d-flex flex-row flex-wrap">
            <div class="row-60percent p-1">
                <table class="table table-hover">
                    <tbody>

                    <tr>
                        <th>Pavadinimas</th>
                        <td>{{ $product->name }}</td>
                    </tr>

                    <tr>
                        <th>Url pavadinimas</th>
                        <td>{{ $product->slug }}</td>
                    </tr>

                    <tr>
                        <th>Gamintojas</th>
                        <td>{{ $product->manufacturer->name ?? null }}</td>
                    </tr>

                    <tr>
                        <th>Produktų linija</th>
                        <td>{{ $product->productline->name ?? null }}</td>
                    </tr>

                    <tr>
                        <th>Aprasymas</th>
                        <td>{!!  $product->description !!}</td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="d-inline-block row-40percent p-1">
                <span>Logotipas</span>
            </div>
        </div>
        <div>

            <span class="font-size-1rem"><b>Veiksmai:</b></span>

            <a href="{{ route('admin.modification.create', $product->id) }}" class="btn btn-outline-primary m-2">Nauja modifikacija</a>
            <a href="{{ route('admin.product.delete', $product->id) }}" class="btn btn-outline-danger m-2">Ištrinti</a>

        </div>
        <div>
            <span class="mr-auto ml-auto font-size-1-8rem"><b>Modifikacijos</b></span>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Pavadinimas</th>
                    <th>Kaina</th>
                    <th>Mato vienetas</th>
                    <th>Statusas</th>
                    <th>Veiksmas</th>
                </tr>
                </thead>

                <tbody>
                @foreach($product->modifications as $modification)
                    <tr>
                        <td>{{ $modification->name }}</td>

                        <td>{{ $modification->price ?? null }}</td>

                        <td>{{ $modification->unitvalue->name ?? null }}</td>

                        <td>{{ $modification->status ?? null }}</td>

                        <td>

                            <a href="{{ route('admin.modification.edit', ['product' => $product, 'modification' => $modification]) }}"
                               class="btn btn-outline-primary">Redaguoti</a>

                            <a href="{{ route('admin.modification.show', ['product' => $product, 'modification' => $modification]) }}"
                               class="btn btn-outline-primary">Atidaryti</a>

                            <a href="{{ route('admin.modification.delete', ['product' => $product, 'modification' => $modification]) }}"
                               class="btn btn-outline-danger">istrinti</a>

                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
