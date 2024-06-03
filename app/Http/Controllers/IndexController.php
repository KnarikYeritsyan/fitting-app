<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    function homePage()
    {
//        return view('welcome',compact('categories'));
        return view('welcome');
    }

    function papers()
    {
//        return view('welcome',compact('categories'));
        return view('papers');
    }

    function examples()
    {
//        return view('welcome',compact('categories'));
        return view('examples');
    }

    function cd_examples()
    {
//        return view('welcome',compact('categories'));
        return view('cd-examples');
    }

    function cd_fitting()
    {
        return view('cd-fitting');
    }

    function cal_fitting()
    {
//        return view('welcome',compact('categories'));
        return view('cal-fitting');
    }

    function cal_examples()
    {
//        return view('welcome',compact('categories'));
        return view('cal-examples');
    }

    public function cal_download($dir,$file){
        return response()->download(storage_path('cal-examples/'.$dir.'/'.$file));
    }

    public function cd_download($method,$dir,$file){
        return response()->download(storage_path('cd-examples/'.$method.'/'.$dir.'/'.$file));
    }
}
