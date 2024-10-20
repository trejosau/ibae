<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlataformaController extends Controller
{
    public function index()
    {
        return view('plataforma.index');
    }
}
