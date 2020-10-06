<?php

namespace App\Http\Controllers\Admin;

use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\ProductLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Forms\Validation\Productline as PLV;
use App\Traits\Sidebar\Catalog as CatalogRoutes;

class ProductLineController extends Controller
{
    use CatalogRoutes;


    public function index()
    {
        $productlines = DB::table('product_lines')->paginate(20);

        return view('admin.productline.index', ['sidebar' => $this->getSidebar(), 'productlines' => $productlines]);
    }

    public function create()
    {
        return view('admin.productline.create', ['sidebar' => $this->getSidebar()]);
    }

    public function store(Request $request, PLV $validator)
    {
        $data = $validator->extendFieldRule('slug', '|unique:product_lines')
            ->addMessage('slug.unique', 'Url turi buti unikalus')
            ->validateForm($request->toArray());

        $id = DB::table('product_lines')->insertGetId($data);

        return redirect()->route('admin.productline.show', $id);
    }

    public function show(ProductLine $productline)
    {
        return view('admin.productline.show', ['sidebar' => $this->getSidebar(), 'productline' => $productline]);
    }

    public function edit(ProductLine $productline)
    {
        return view('admin.productline.edit', ['sidebar' => $this->getSidebar(), 'productline' => $productline]);
    }

    public function update(Request $request, ProductLine $productline, PLV $validator)
    {
        $data = $validator->validateForm($request->toArray());

        DB::table('product_lines')->update($data);

        return redirect()->route('admin.productline.show', $productline->id);
    }

    public function delete(ProductLine $productline)
    {
        return view('admin.productline.delete', ['sidebar' => $this->getSidebar(), 'productline' => $productline]);
    }

    public function destroy(Request $request, ProductLine $productline)
    {
        $data = $request->validate(['name' => 'string']);

        if ($productline->name === $data['name']) {
            $productline->delete();
            return redirect()->route('admin.productline.index');
        } else {
            return redirect()->back()->withErrors(['name' => 'Blogai ivestas produkto linijos pavadinimas']);
        }
    }

    public function manufacturer()
    {

    }

    public function products(ProductLine $productline)
    {
        return view('admin.productline.products', ['sidebar' => $this->getSidebar(), 'productLine' => $productline]);
    }

    public function getFilteredProducts(Request $request)
    {
        $data = $request->validate(['search' => 'nullable|string', 'id' => 'nullable|numeric']);
        if (isset($data['id'])) {
            $products = Product::where('product_line_id', '=', $data['id'])->get()->all();
        } elseif (isset($data['search'])) {
            $products = Product::where('name', 'regexp', $data['search'])->get()->all();
        } else {
            $products = Product::get()->all();
        }
        foreach ($products as $key => $product) {
            $products[$key]['productline'] = $product->productLine()->first();
        }
        return $products;
    }

    public function associateProduct(Request $request, ProductLine $productline)
    {
        $productId = $request->validate(['product' => 'numeric|required'])['product'];
        $product = Product::where('id', $productId)->first();
        $product->productLine()->associate($productline)->save();
        return ['associated' => true];
    }

    public function disassociateProduct(Request $request, ProductLine $productline)
    {
        $productId = $request->validate(['product' => 'numeric|required'])['product'];

        if ($product = $productline->products()->where('id', '=', $productId)->first()) {
            $product->productLine()->dissociate($productline)->save();
            return ['disassociated' => true];
        } else {
            return ['disassociated' => false];
        }
    }

}
