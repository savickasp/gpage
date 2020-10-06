<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UnitValue;
use App\Http\Controllers\Controller;
use App\Forms\Validation\UnitValue as UVV;
use App\Traits\Sidebar\Catalog as CatalogRoutes;

class UnitValueController extends Controller
{
    use CatalogRoutes;


    public function index()
    {
        $unitvalues = DB::table('unit_values')->paginate(20);

        return view('admin.unitvalue.index', ['sidebar' => $this->getSidebar(), 'unitvalues' => $unitvalues]);
    }

    public function create()
    {
        return view('admin.unitvalue.create', ['sidebar' => $this->getSidebar()]);
    }

    public function store(Request $request, UVV $validator)
    {
        $data = $validator->extendFieldRule('name', '|unique:unit_values')
            ->addMessage('name.unique', 'Toks mato vienetas jau egzistuoja')
            ->validateForm($request->toArray());

        $id = DB::table('unit_values')->insertGetId($data);

        return redirect()->route('admin.unitvalue.index');
    }

    public function edit(UnitValue $unitvalue)
    {
        return view('admin.unitvalue.edit', ['sidebar' => $this->getSidebar(), 'unitvalue' => $unitvalue]);
    }

    public function update(Request $request, UnitValue $unitvalue, UVV $validator)
    {
        $data = $validator->validateForm($request->toArray());

        if (count(DB::table('unit_values')->where('name', '=', $data['name'])->get()->all())) {
            return redirect()->back()->withErrors(['name' => 'Toks mato vienetas jau egzistuoja']);
        } else {
            $unitvalue->name = $data['name'];
            $unitvalue->save();
            return redirect()->route('admin.unitvalue.index', $unitvalue->id);
        }
    }

    public function delete(UnitValue $unitvalue)
    {
        return view('admin.unitvalue.delete', ['sidebar' => $this->getSidebar(), 'unitvalue' => $unitvalue]);
    }

    public function destroy(Request $request, UnitValue $unitvalue, UVV $validator)
    {
        $data = $validator->validateForm($request->toArray());
        if ($unitvalue->name === $data['name']) {
            $unitvalue->delete();
            return redirect()->route('admin.unitvalue.index');
        } else {
            return redirect()->back()->withErrors(['name' => 'Blogai ivestas mato vieneto pavadinimas pavadinimas']);
        }
    }

    public function getAllUnitValues()
    {
        return UnitValue::get()->all();
    }
}
