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
}
