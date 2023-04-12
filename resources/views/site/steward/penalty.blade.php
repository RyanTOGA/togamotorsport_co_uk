@extends('site.layout.layout',['page_title' => 'Apply Penalty'])
@section('header')
    @include('site.partials.header')
@endsection
@section('main')
    <div class="container">
        <div class="text-center mt-5">
            <h1>Apply Penalty</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="alert alert-dark" role="alert">
                    {{$incident_report->session->server_name}} - {{$incident_report->track_name}}
                </div>
                <form method="post" action="{{route('steward.incident.penalty.store',$incident_report->id)}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="raceSession">Car Number</label>
                                <input type="text" class="form-control" disabled
                                       value="{{$incident_report->offending_car_race_number}}" name="offending_car_race_number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="raceSession">Turn Number</label>
                                <input type="text" class="form-control" disabled
                                       value="{{$incident_report->turn_number}}" name="turn_number">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="raceSession">Time Penalty (in seconds)</label>
                                <input type="number" class="form-control"
                                       value="{{old('time_penalty')}}" name="time_penalty" placeholder="eg: 5">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="PenaltyComments">Penalty Comments</label>
                                <textarea class="form-control" id="PenaltyComments" rows="3" name="penalty_comments">{{old('penalty_comments')}}</textarea>
                            </div>
                        </div>
                        <input type="hidden" name="incident_report_id" value="{{$incident_report->id}}">
                        <div class="col-md-12">
                            <div class="d-grid gap-2 d-md-block">
                                <input type="submit" value="Apply Penalty" class="btn btn-info mt-4" name="apply_penalty">
                                <input type="submit" value="Apply Warning" class="btn btn-warning mt-4" name="apply_warning">
                                <input type="submit" value="No Further Action" class="btn btn-success mt-4" name="no_further_access">
                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
@endsection
