@php use Illuminate\Support\Facades\Session; @endphp
@extends('site.layout.layout',['page_title' => 'View An Incident'])
@section('header')
    @include('site.partials.header')
@endsection
@section('main')
    <div class="container">
        <div class="text-center mt-5">
            <h1>Incident Report(s)</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{$message}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        Incident #{{$incident_report->id}}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Session Name: {{$incident_report->session->server_name}}</h5>
                        <p class="card-text">Track Name: <strong>{{$incident_report->track_name}}</strong></p>
                        <p class="card-text">Video Link: <a href="{{$incident_report->video_link}}" target="_blank">Click
                                here</a></p>
                        <p class="card-text">Reporting Driver: <strong>{{$incident_report->raisedBy()->name ?? NULL}}
                                (#{{$incident_report->your_race_number}})</strong></p>
                        <p class="card-text">Offending Driver: <strong>{{$incident_report->offendingDriver()->name ?? NULL}}
                                (#{{$incident_report->offending_car_race_number}})</strong></p>

                        <hr>
                        <p class="card-text">Comments: {{$incident_report->comments}}</p>
                        <a href="{{route('steward.incident.penalty', $incident_report->id)}}" class="btn btn-primary">Give
                            Penalty</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
