<?php

namespace App\Http\Controllers;

use App\Models\EventConfirmation;
use Illuminate\Http\Request;

class EventConfirmationController extends Controller
{
    public function confirm($eventId)
    {
        $userId = auth()->id();

        // Verifica se o usuário já confirmou presença para evitar duplicatas
        $existingConfirmation = EventConfirmation::where('idevento', $eventId)
                                                ->where('idusuario', $userId)
                                                ->first();

        if (!$existingConfirmation) {
            $confirmation = new EventConfirmation;
            $confirmation->idevento = $eventId;
            $confirmation->idusuario = $userId;
            $confirmation->convidado = 0; // 0 significa que é um usuário cadastrado
            $confirmation->save();
        }

        return redirect()->back()->with('msg', 'Presença confirmada com sucesso!');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
