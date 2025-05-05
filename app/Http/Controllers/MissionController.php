<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Personnel;
use App\Models\TypeUnite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MissionController extends Controller
{
    //
    public function index()
    {
        $missions = Mission::all();
        $typeUnites = TypeUnite::all();
        $missionCount = Mission::count();
        $personnels = Personnel::all();
        return view('admin.mission.index', compact('missions', 'missionCount', 'typeUnites', 'personnels'));
    }
    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $pathImage = 'images/' . $imageName;
            $data['image'] = $pathImage;
            // return response()->json(['message' => $data['image']], 200);
        }
        Mission::create($data);
        return redirect('/admin/dashboard/missions')->with('status', 'Mission ajoutée!', 'color', 'success');
    }
    public function update(Request $request)
    {
        $data = $request->all();
        Mission::find($request->id)->update($data);
        return redirect('/admin/dashboard/mission/' . $request->id)->with('status', 'Mission modifié!',  'color', 'success');
    }

    public function delete($id)
    {
        Mission::destroy($id);
        return redirect('/admin/dashboard/missions')->with('status', 'Mission supprimé!',  'color', 'danger');
    }

    public function show($id)
    {
        // $missions = Mission::find($id)->select('missions.*, type_unites.id as type_unites_id, type_unites.image as type_unites_image, type_unites.nom_type_unite, type_unites.description_type_unite')->join('type_unites', 'type_unites.id', '=', 'missions.type_unite_id')->get();
  
        $missions = DB::select("SELECT missions.*, type_unites.id as type_unites_id, type_unites.image as type_unites_image, type_unites.nom_type_unite, type_unites.description_type_unite FROM type_unites, missions WHERE missions.id = " . $id . " AND missions.type_unite_id = type_unites.id LIMIT 1;");
        $mission = $missions[0];
        $typeUnites = TypeUnite::all();
        return view('admin.mission.details', compact('mission', 'typeUnites'));
    }
}
