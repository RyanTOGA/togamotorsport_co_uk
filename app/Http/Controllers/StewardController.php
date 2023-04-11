<?php

namespace App\Http\Controllers;

use App\Http\Requests\StewardFormRequest;
use App\Models\RaceSession;
use Illuminate\Http\Request;

class StewardController extends Controller
{
    public function index()
    {
        $sessions = RaceSession::query()->where('session_type','R')->groupBy(['server_name'])->get();
        $pluck = $sessions->pluck('track_name');
        return view('site.steward.form', ['sessions' => $sessions,'pluck' => $pluck]);
    }

    public function store(StewardFormRequest $request)
    {
        $raceSessionCheck = RaceSession::query()->where('id',$request->race_session)->where('track_name', $request->track_name)->first();
        if($raceSessionCheck == null){
            return redirect()->back()->withErrors(['track_missmatch' => 'The race session and track combination does not match please try again!']);
        }

        dd($request->all());
    }
}
