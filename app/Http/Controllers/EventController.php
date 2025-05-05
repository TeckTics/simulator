<?php

namespace App\Http\Controllers;

use App\Models\Event;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    //
    public function index()
    {
        // abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $eventCount = Event::count();
        $events = Event::all();
        $eventsSolo = Event::query()
            ->where('type_event', 'solo')
            ->count();
        $eventsMulti = Event::query()
            ->where('type_event', 'multi')
            ->count();
        $dateNow = new DateTimeImmutable();
        $dateNow = date_format($dateNow, 'Y-m-d H:i:s');
        $eventsNow = Event::query()
            ->whereDate('date_fin', '<=', $dateNow)
            ->count();
        $eventNow =
            //  Event::query()
            //     ->where('date_fin', '>=', $dateNow)
            //     ->where('published', '1')
            //     ->get();
            DB::select("SELECT events.*, COUNT( event_users.user_id) AS count_user
FROM events, event_users WHERE events.id = event_users.event_id AND events.published  = 1 AND  events.date_fin  >= '" . $dateNow . "' AND events.deleted_at is null GROUP BY events.id ");
        $eventsNoPublished = Event::query()
            ->where('published', 0)
            ->count();
        $eventsPublished = Event::query()
            ->where('published', 1)
            ->count();
        return view('admin.evenement.index', compact('eventCount', 'dateNow',  'eventNow', 'events', 'eventsSolo', 'eventsMulti', 'eventsNow', 'eventsPublished', 'eventsNoPublished'));
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
        Event::create($data);
        return redirect('/admin/dashboard/evenements')->with('status', 'Evénement ajouté!', 'color', 'success');
    }
    public function update(Request $request)
    {
        $data = $request->all();
        Event::find($request->id)->update($data);
        return redirect('/admin/dashboard/evenement/' . $request->id)->with('status', 'Evénement modifié!',  'color', 'success');
    }

    public function delete($id)
    {
        Event::destroy($id);
        return redirect('/admin/dashboard/evenements')->with('status', 'Evénement supprimé!',  'color', 'danger');
    }

    public function show($id)
    {
        $event = Event::find($id);
        $participants = DB::select("SELECT users.pseudo, users.profile, users.experience, users.id FROM events, users, event_users WHERE events.id = " . $id . " AND event_users.event_id = events.id AND event_users.user_id = users.id;");
        return view('admin.evenement.details', compact('event', 'participants'));
    }
}
