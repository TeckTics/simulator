<?php

namespace App\Http\Controllers;

use App\Models\TypeUnite;
use App\Models\Unite;
use App\Models\UniteUser;
use Illuminate\Http\Request;

class UniteController extends Controller
{
    //
    public function index()
    {
        $unitesCount = Unite::count();
        $typeUnites = TypeUnite::all();
        $unites = Unite::query()->select('unites.*', 'type_unites.image as icon', 'type_unites.nom_type_unite', 'type_unites.description_type_unite')->join('type_unites', 'type_unites.id', '=', 'unites.type_unite_id')->get();
        return view("admin.unite.index", compact('typeUnites', 'unites', 'unitesCount'));
    }

    public function typeUniteView()
    {

        $typeUnites = TypeUnite::all();
        $typeUniteCount = TypeUnite::count();
        return view("admin.unite.listType", compact('typeUnites', 'typeUniteCount'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'recompense' => 'required',
        //     'description' => 'required',
        //     'date' => 'date|required',
        //     'type' => 'required',
        //     'image' => 'image'
        // ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $pathImage = 'images/' . $imageName;
            $data['image'] = $pathImage;
            // return response()->json(['message' => $data['image']], 200);
        }

        Unite::create($data);
        return redirect('/admin/dashboard/unites')->with('status', 'Evénement ajouté!', 'color', 'success');
    }

    // public function storeUniteUser(Request $request)
    // {
        // $request->validate([
        //     'name' => 'required',
        //     'recompense' => 'required',
        //     'description' => 'required',
        //     'date' => 'date|required',
        //     'type' => 'required',
        //     'image' => 'image'
        // ]);
    //     $data = $request->all();
    //     UniteUser::create($data);
    //     return redirect('/admin/dashboard/unites')->with('status', 'Evénement ajouté!', 'color', 'success');
    // }

    public function update(Request $request)
    {
        $data = $request->all();
        Unite::find($request->id)->update($data);
        return redirect('/admin/dashboard/unites')->with('status', 'Evénement modifié!',  'color', 'success');
    }

    public function delete($id)
    {
        Unite::destroy($id);
        return redirect('/admin/dashboard/unites')->with('status', 'Evénement supprimé!',  'color', 'danger');
    }

    public function updateTypeUnite(Request $request)
    {
        $data = $request->all();
        TypeUnite::find($request->id)->update($data);
        return redirect('/admin/dashboard/type-unite')->with('status', 'Evénement modifié!',  'color', 'success');
    }

    public function deleteTypeUnite($id)
    {
        TypeUnite::destroy($id);
        return redirect('/admin/dashboard/type-unite')->with('status', 'Evénement supprimé!',  'color', 'danger');
    }


    public function storeTypeUnite(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'recompense' => 'required',
        //     'description' => 'required',
        //     'date' => 'date|required',
        //     'type' => 'required',
        //     'image' => 'image'
        // ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $pathImage = 'images/' . $imageName;
            $data['image'] = $pathImage;
            // return response()->json(['message' => $data['image']], 200);
        }

        TypeUnite::create($data);
        return redirect('/admin/dashboard/type-unite')->with('status', 'Evénement ajouté!', 'color', 'success');
    }
}
