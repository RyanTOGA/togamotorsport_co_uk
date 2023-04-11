<?php

namespace App\Http\Controllers;

use App\Models\RaceDrivers;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = RaceDrivers::query()->groupBy('name')->orderBy('name','ASC')->paginate(15);
        return view('dashboard.driver.show', ['drivers' => $drivers]);
    }
}
