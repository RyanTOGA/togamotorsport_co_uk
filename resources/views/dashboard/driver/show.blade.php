@extends('dashboard.layout.layout')
@section('header')
    @include('dashboard.partials.header')
@endsection
@section('main')
    <!-- Page content-->
    <div class="container">
        <div class="text-center mt-5">
            <h1>Toga Motorsport Drivers</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Driver Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($drivers as $driver)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$driver->name}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$drivers->links()}}
            </div>
        </div>
    </div>
@endsection
