<?php

namespace App\Http\Controllers;

use App\Services\PersonaService;
use Illuminate\Http\JsonResponse;

class PersonaController extends Controller
{
    public function show(string $key, PersonaService $personas): JsonResponse
    {
        $persona = $personas->getActive($key);
        if (!$persona) {
            return response()->json(['message' => 'Persona not found'], 404);
        }
        return response()->json($persona);
    }
}

