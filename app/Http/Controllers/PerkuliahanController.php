<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerkuliahanController extends Controller
{
    public function index()
    {
        return view('perkuliahan'); // Pastikan ada file resources/views/dashboard.blade.php
    }
}