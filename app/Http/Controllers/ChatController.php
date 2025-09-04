<?php

namespace App\Http\Controllers;

use App\Services\PersonaService;
use Illuminate\View\View;

class ChatController extends Controller
{
    public function index(PersonaService $personas): View
    {
        $persona = $personas->getActive('why');

        return view('chat.index', [
            'persona' => $persona,
        ]);
    }
}