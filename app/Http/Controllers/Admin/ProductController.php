<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Forms\Validation\Product as PV;
use App\Traits\Sidebar\Catalog as CatalogRoutes;

class ProductController extends Controller
{
    use CatalogRoutes;


    public function index()
    {
        $products = DB::table('products')->paginate(20);

        return view('admin.product.index', ['sidebar' => $this->getSidebar(), 'products' => $products]);
    }

    public function create()
    {
        return view('admin.product.create', ['sidebar' => $this->getSidebar()]);
    }

    public function store(Request $request, PV $validator)
    {
        $data = $validator->extendFieldRule('slug', '|unique:products')
            ->addMessage('slug.unique', 'Url turi buti unikalus')
            ->validateForm($request->toArray());

        $id = DB::table('products')->insertGetId($data);

        return redirect()->route('admin.product.show', ['product' => $id]);
    }

    public function show(Product $product)
    {
        return view('admin.product.show', ['sidebar' => $this->getSidebar(), 'product' => $product]);
    }

    public function edit(Product $product)
    {
        return view('admin.product.edit', ['sidebar' => $this->getSidebar(), 'product' => $product]);
    }

    public function update(Request $request, Product $product, PV $validator)
    {
        $data = $validator->validateForm($request->toArray());

        DB::table('products')->update($data);

        return redirect()->route('admin.product.show', $product->id);
    }

    public function delete(Product $product)
    {
        return view('admin.product.delete', ['sidebar' => $this->getSidebar(), 'product' => $product]);
    }

    public function destroy(Request $request, Product $product)
    {
        $data = $request->validate(['name' => 'string']);

        if ($product->name === $data['name']) {
            $product->delete();
            return redirect()->route('admin.product.index');
        } else {
            return redirect()->back()->withErrors(['name' => 'Blogai ivestas produkto pavadinimas']);
        }
    }

    public function modifications(Product $product)
    {
        return view('admin.product.modifications', ['sidebar' => $this->getSidebar(), 'product' => $product]);
    }
}
