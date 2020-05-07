<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Banner;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function indexSlider()
    {
        $banners=Banner::where(['banner_status'=>1])->get();
        return view('home')->with(compact('banners'));
    }

  
}
