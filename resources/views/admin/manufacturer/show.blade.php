@extends('layouts.admin')

@section('content')
    <div class="d-flex flex-column">
        <div class="d-flex flex-row flex-wrap">
            <div class="row-60percent p-1">
                <table class="table table-hover">
                    <tbody>

                    <tr>
                        <th>Pavadinimas</th>
                        <td>{{ $manufacturer->name }}</td>
                    </tr>

                    <tr>
                        <th>Url pavadinimas</th>
                        <td>{{ $manufacturer->slug }}</td>
                    </tr>

                    <tr>
                        <th>Produktu liniju skaicius</th>
                        <td>{{  count($manufacturer->productline ?? []) }}</td>
                    </tr>

                    <tr>
                        <th>Produktu skaicius</th>
                        <td>{{  count($manufacturer->products ?? []) }}</td>
                    </tr>

                    <tr>
                        <th>Aprasymas</th>
                        <td>{!!  $manufacturer->description !!}</td>
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

            <a href="{{ route('admin.manufacturer.productLines', $manufacturer->id) }}" class="btn btn-outline-primary m-2">Keisti produktu linijas</a>
            <a href="{{ route('admin.manufacturer.products', $manufacturer->id) }}" class="btn btn-outline-primary m-2">Susieti produktus</a>
            <a href="{{ route('admin.manufacturer.delete', $manufacturer->id) }}" class="btn btn-outline-danger m-2">Ištrinti</a>

        </div>
        <div>
            <span class="mr-auto ml-auto font-size-1-8rem"><b>Susietos produktų linijos</b></span>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Pavadinimas</th>
                    <th>Produktai</th>
                    <th>Veiksmai</th>
                </tr>
                </thead>

                <tbody>

                @foreach($manufacturer->productlines ?? [] as $productline)
                    <tr>
                        <td>
                            <a href="{{ route('admin.productline.show', $productline) }}"
                               class="btn btn-outline-dark">{{ $productline->name }}</a>
                        </td>

                        <td>{{ count($productline->products) }}</td>

                        <td>
                            <a href="{{ route('admin.productline.show', $productline) }}"
                               class="btn btn-outline-primary">Peržiūrėti</a>
                        </td>

                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <div>
            <span class="mr-auto ml-auto font-size-1-8rem"><b>Susieti produktai</b></span>

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Pavadinimas</th>
                    <th>modifikacijos</th>
                    <th>Veiksmai</th>
                </tr>
                </thead>

                <tbody>

                @foreach($manufacturer->products ?? [] as $product)
                    <tr>
                        <td>
                            <a href="{{ route('admin.product.show', $product) }}"
                               class="btn btn-outline-dark">{{ $product->name }}</a>
                        </td>

                        <td>{{ count($product->modifications) }}</td>

                        <td>
                            <a href="{{ route('admin.product.show', $product) }}"
                               class="btn btn-outline-primary">Peržiūrėti</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection
