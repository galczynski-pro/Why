<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PersonaService;

class HomeController extends Controller
{
    public function index(PersonaService $personas)
    {
        $persona = $personas->getActive('why');
        return view('welcome', [
            'persona' => $persona,
        ]);
    }
}
