<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Manufacturer;
use App\Http\Controllers\Controller;
use App\Forms\Validation\Manufacturer as MV;
use App\Traits\Sidebar\Catalog as CatalogRoutes;

class ManufacturerController extends Controller
{
    use CatalogRoutes;


    public function index()
    {
        $manufacturers = Manufacturer::paginate(20);

        return view('admin.manufacturer.index', ['sidebar' => $this->getSidebar(), 'manufacturers' => $manufacturers]);
    }

    public function create()
    {
        return view('admin.manufacturer.create', ['sidebar' => $this->getSidebar()]);
    }

    public function store(Request $request, MV $validator)
    {
        $data = $validator->extendFieldRule('slug', '|unique:manufacturers')
            ->addMessage('slug.unique', 'Url turi buti unikalus')
            ->validateForm($request->toArray());

        $id = DB::table('manufacturers')->insertGetId($data);

        return redirect()->route('admin.manufacturer.show', ['manufacturer' => $id]);
    }

    public function show(Manufacturer $manufacturer)
    {
        return view('admin.manufacturer.show', ['sidebar' => $this->getSidebar(), 'manufacturer' => $manufacturer]);
    }

    public function edit(Manufacturer $manufacturer)
    {
        return view('admin.manufacturer.edit', ['sidebar' => $this->getSidebar(), 'manufacturer' => $manufacturer]);
    }

    public function update(Request $request, Manufacturer $manufacturer, MV $validator)
    {
        $data = $validator->validateForm($request->toArray());

        DB::table('manufacturers')->update($data);

        return redirect()->route('admin.manufacturer.show', $manufacturer->id);
    }

    public function delete(Manufacturer $manufacturer)
    {
        return view('admin.manufacturer.delete', ['sidebar' => $this->getSidebar(), 'manufacturer' => $manufacturer]);
    }

    public function destroy(Request $request, Manufacturer $manufacturer)
    {
        $data = $request->validate(['name' => 'string']);

        if ($manufacturer->name === $data['name']) {
            $manufacturer->delete();
            return redirect()->route('admin.manufacturer.index');
        } else {
            return redirect()->back()->withErrors(['name' => 'Blogai ivestas gamintojo pavadinimas']);
        }
    }

    public function productlines(Manufacturer $manufacturer)
    {
        return view('admin.manufacturer.productlines',
            ['sidebar' => $this->getSidebar(), 'manufacturer' => $manufacturer]);
    }


    public function products(Manufacturer $manufacturer)
    {
        return view('admin.manufacturer.products', ['sidebar' => $this->getSidebar(), 'manufacturer' => $manufacturer]);
    }

    public function getFilteredProductLines(Request $request, Manufacturer $manufacturer)
    {
        $data = $request->validate(['search' => 'nullable|string', 'id' => 'nullable|numeric']);
        if (isset($data['id'])) {
            $productLines = ProductLine::where('manufacturer_id', '=', $data['id'])->get()->all();
        } elseif (isset($data['search'])) {
            $productLines = ProductLine::where('name', 'regexp', $data['search'])->get()->all();
        } else {
            $productLines = ProductLine::get()->all();
        }
        foreach ($productLines as $key => $productLine) {
            $productLines[$key]['manufacturer'] = $productLine->manufacturer()->first();
        }
        return $productLines;
    }

    public function associateProductLine(Request $request, Manufacturer $manufacturer)
    {
        $productLineId = $request->validate(['productLine' => 'numeric|required'])['productLine'];
        $productline = ProductLine::where('id', $productLineId)->first();
        $productline->manufacturer()->associate($manufacturer)->save();
        return ['associated' => true];
    }

    public function disassociateProductLine(Request $request, Manufacturer $manufacturer)
    {
        $productLineId = $request->validate(['productLine' => 'numeric|required'])['productLine'];

        if ($productLine = $manufacturer->productlines()->where('id', '=', $productLineId)->first()) {
            $productLine->manufacturer()->dissociate($manufacturer)->save();
            return ['disassociated' => true];
        } else {
            return ['disassociated' => false];
        }
    }

    public function getFilteredProducts(Request $request)
    {
        $data = $request->validate(['search' => 'nullable|string', 'id' => 'nullable|numeric']);
        if (isset($data['id'])) {
            $products = Product::where('manufacturer_id', '=', $data['id'])->get()->all();
        } elseif (isset($data['search'])) {
            $products = Product::where('name', 'regexp', $data['search'])->get()->all();
        } else {
            $products = Product::get()->all();
        }
        foreach ($products as $key => $product) {
            $products[$key]['manufacturer'] = $product->manufacturer()->first();
        }
        return $products;
    }

    public function associateProduct(Request $request, Manufacturer $manufacturer)
    {
        $productId = $request->validate(['product' => 'numeric|required'])['product'];
        $product = Product::where('id', $productId)->first();
        $product->manufacturer()->associate($manufacturer)->save();
        return ['associated' => true];
    }

    public function disassociateProduct(Request $request, Manufacturer $manufacturer)
    {
        $productId = $request->validate(['product' => 'numeric|required'])['product'];

        if ($product = $manufacturer->products()->where('id', '=', $productId)->first()) {
            $product->manufacturer()->dissociate($manufacturer)->save();
            return ['disassociated' => true];
        } else {
            return ['disassociated' => false];
        }
    }
}
