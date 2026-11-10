<?php

namespace App\Http\Controllers;

use App\Models\ModelShowroom;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $models = ModelShowroom::active()->ordered()->get();

        return view('home', compact('models'));
    }
}

