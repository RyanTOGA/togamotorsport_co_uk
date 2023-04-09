<?php

namespace App\Http\Controllers;

use App\Models\SliderImage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $images = SliderImage::all();
        return view('site.home',['images' => $images]);
    }
}
