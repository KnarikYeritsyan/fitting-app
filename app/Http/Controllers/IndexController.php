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
}
