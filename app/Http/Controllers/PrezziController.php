<?php

namespace App\Http\Controllers;

class PrezziController extends Controller
{
    public function index()
    {
        return view('pages.prezzi', ['prezzi' => config('corvalys.prezzi')]);
    }
}
