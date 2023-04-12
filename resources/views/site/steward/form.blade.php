@php use Illuminate\Support\Str; @endphp
@extends('site.layout.layout',['page_title' => 'Raise An Incident'])
@section('header')
    @include('site.partials.header')
@endsection
@section('main')
    <div class="container">
        <div class="text-center mt-5">
            <h1>Toga Motorsport Raise An Incident</h1>
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
                <form method="post" action="{{route('steward.form.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="raceSession">Race Session</label>
                                <select name="session_id" id="raceSession" class="form-control">
                                    <option value="0" disabled selected>Please Select</option>
                                    @foreach($sessions as $session)
                                        <option value="{{$session->id}}">{{$session->server_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="TrackName">Track Name</label>
                                <select name="track_name" id="TrackName" class="form-control">
                                    <option value="0" disabled selected>Please Select</option>
                                    @foreach($pluck as $item)
                                        <option
                                            value="{{$item}}">{{Str::upper(str_replace('_',' ',$item))}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="TurnNumber">Turn Number</label>
                                <input type="text" class="form-control" name="turn_number" id="TurnNumber"
                                       value="{{old('turn_number')}}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="YourRaceNumber">Your Race Number</label>
                                <input type="text" class="form-control" name="your_race_number" id="YourRaceNumber"
                                       value="{{old('your_race_number')}}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="OffendingCarRaceNumber">Offending Car Race Number</label>
                                <input type="text" class="form-control" name="offending_car_race_number"
                                       id="OffendingCarRaceNumber" value="{{old('offending_car_race_number')}}">
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="VideoLink">Video Link</label>
                                <input type="text" class="form-control" name="video_link" id="VideoLink"
                                       value="{{old('video_link')}}">
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="Comments">Comments</label>
                                <textarea class="form-control" id="Comments" rows="3"
                                          name="comments">{{old('comments')}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary">Report Incident</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
