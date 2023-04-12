@extends('site.layout.layout',['page_title' => 'All Incidents'])
@section('header')
    @include('site.partials.header')
@endsection
@section('main')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center mt-5">
                    <h1>All Incidents Log</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if(count($allIncidents) > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Session</th>
                            <th scope="col">Track</th>
                            <th scope="col">Raised By</th>
                            <th scope="col">Penalty Applied</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allIncidents as $allIncident)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$allIncident->session->server_name}}</td>
                                <td>{{$allIncident->track_name}}</td>
                                <td>{{$allIncident->raisedBy()->name ?? 'NO NAME FOUND'}}</td>
                                <td>{{(isset($allIncident->penalty)?'Yes':'No')}}</td>
                                <td>
                                    <div class="d-grid gap-2 d-md-block">
                                        <a href="{{route('steward.incident', $allIncident->id)}}"
                                           class="btn btn-info btn-sm">View Incident</a>
                                        <a href="{{route('steward.incident.penalty', $allIncident->id)}}"
                                           class="btn btn-primary btn-sm">Apply Penalty</a>
                                        <a href="{{route('steward.incident.delete',$allIncident->id)}}"
                                           class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center mt-5">
                        <h5>No Reports Logged yet <a href="{{route('steward.form')}}" class="btn btn-info btn-sm">Raise A Incident Log</a></h5>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
