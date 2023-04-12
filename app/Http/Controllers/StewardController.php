<?php

namespace App\Http\Controllers;

use App\Http\Requests\StewardFormRequest;
use App\Models\IncidentReports;
use App\Models\Penalty;
use App\Models\RaceSession;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StewardController extends Controller
{
    /**
     * Show Incident Form
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $sessions = RaceSession::query()->where('session_type', 'R')->groupBy(['server_name'])->get();
        $pluck = $sessions->pluck('track_name');
        return view('site.steward.form', ['sessions' => $sessions, 'pluck' => $pluck]);
    }

    /**
     * Store Incident Form
     * @param StewardFormRequest $request
     * @return RedirectResponse|void
     */
    public function store(StewardFormRequest $request)
    {
        $raceSessionCheck = RaceSession::query()->where('id', $request->session_id)->where('track_name', $request->track_name)->first();
        if ($raceSessionCheck == null) {
            return redirect()->back()->withErrors(['track_missmatch' => 'The race session and track combination does not match please try again!']);
        }

        //Save Data into DB
        IncidentReports::query()->create($request->except('_token'));
    }

    /**
     * Show Incident Form
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function report(Request $request): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $incident_report_id = $request->segment(3);
        $incident_report = IncidentReports::query()->find($incident_report_id);

        return view('site.steward.report', ['incident_report' => $incident_report]);
    }

    /**
     * Load Penalty Form
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function penalty(Request $request): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $incident_report_id = $request->segment(3);
        $incident_report = IncidentReports::query()->find($incident_report_id);

        return view('site.steward.penalty', ['incident_report' => $incident_report]);
    }

    /**
     * Apply A Penalty
     * @param Request $request
     * @return void
     */
    public function apply(Request $request): void
    {
        if (isset($request->apply_penalty)) {
            $request->validate([
                'time_penalty' => 'required|integer',
                'penalty_comments' => 'required'
            ]);
        }

        if (isset($request->apply_warning) || isset($request->no_further_access)) {
            $request->validate([
                'penalty_comments' => 'required'
            ]);
        }

        //Store in the DB
        Penalty::query()->create([
            'incident_report_id' => $request->incident_report_id,
            'time_penalty' => $request->time_penalty,
            'penalty_comments' => $request->penalty_comments,
            'is_penalty' => (isset($request->apply_penalty)) ? 1 : 0,
            'is_warning' => (isset($request->apply_warning)) ? 1 : 0,
            'is_no_action' => (isset($request->no_further_access)) ? 1 : 0,
        ]);
    }

    public function incidents()
    {
        $allIncidents = IncidentReports::all();

        return view('site.steward.incidents', ['allIncidents' => $allIncidents]);
    }
}
