<?php

namespace App\Http\Controllers\Admin;

use App\Models\Modification;
use App\Models\UnitValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Forms\Validation\Modification as MV;
use App\Traits\Sidebar\Catalog as CatalogRoutes;

class ModificationController extends Controller
{
    use CatalogRoutes;

    public function create(Product $product)
    {
        return view('admin.modification.create', ['sidebar' => $this->getSidebar(), 'product' => $product]);
    }

    public function store(Request $request, Product $product, MV $validator)
    {
        $data = $validator->validateForm($request->toArray());
        $data['product_id'] = $product->id;

        $id = DB::table('modifications')->insertGetId($data);

        return redirect()->route('admin.modification.show', ['product' => $product->id, 'modification' => $id]);
    }

    public function show(Product $product, Modification $modification)
    {
        $modification->unitvalue;

        return view('admin.modification.show', ['sidebar' => $this->getSidebar(), 'product' => $product, 'modification' => $modification]);
    }

    public function edit(Product $product,Modification $modification)
    {
        return view('admin.modification.edit', ['sidebar' => $this->getSidebar(), 'product' => $product, 'modification' => $modification]);
    }

    public function update(Request $request, Modification $modification, MV $validator)
    {
        $data = $validator->validateForm($request->toArray());

        DB::table('modifications')->update($data);

        return redirect()->route('admin.modification.show', $modification->id);
    }

    public function delete(Modification $modification)
    {
        return view('admin.modification.delete', ['sidebar' => $this->getSidebar(), 'modification' => $modification]);
    }

    public function destroy(Request $request, Modification $modification)
    {
        $data = $request->validate(['name' => 'string']);

        if ($modification->name === $data['name']) {
            $modification->delete();
            return redirect()->route('admin.modification.index');
        } else {
            return redirect()->back()->withErrors(['name' => 'Blogai ivestas produkto pavadinimas']);
        }
    }

    public function associateUnitValue(Modification $modification, UnitValue $unitvalue)
    {
        $modification->unitvalue()->associate($unitvalue)->save();
        return $modification;
    }

    public function disassociateUnitValue(Modification $modification, UnitValue $unitvalue)
    {
        $modification->unitvalue()->dissociate($unitvalue)->save();
        return $modification;
    }
}
