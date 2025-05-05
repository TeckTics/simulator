<?php

namespace App\Http\Controllers;

use App\Models\Base;
use App\Models\TypeBase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    //
    public function index()
    {
        $bases = Base::all();
        $typesBase = TypeBase::all();
        $basesCount = Base::count();
        $typesBaseCount = TypeBase::count();
        return view('admin.type-base.index', compact('bases', 'typesBase', 'typesBaseCount', 'basesCount'));
    }

    public function hospitalList()
    {
        return view('admin.hopital.index');
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
        $data['admin_id'] = Auth::guard('appadmin')->user()->id;
        TypeBase::create($data);

        return redirect('/admin/dashboard/type-base')->with('status', 'Type de base ajouté!');
    }
}
