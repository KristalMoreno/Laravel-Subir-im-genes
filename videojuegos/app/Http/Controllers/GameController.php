<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::all();
        return view('Games.index', compact('games'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Games.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'levels' => 'required|numeric',
            'release' => 'required|date',
            'image' => 'required|image'
        ]);
        $game = Game::create($request->all());
        if ($request->hasFile('image')) {
            // Asegurar que la carpeta "storage/app/public/img/" exista
            if (!file_exists(storage_path('app/public/img'))) {
                mkdir(storage_path('app/public/img'), 0775, true);
            }
            // Guardar la imagen en "storage/app/public/img/"
            $nombre = $game->id . '.' . $request->file('image')->getClientOriginalExtension();
            $img = $request->file('image')->storeAs('img', $nombre, 'public');
            // Guardar la ruta correctamente en la base de datos
            $game->image = 'img/' . $nombre;
            $game->save();
        }
        return redirect()->route('games.index')->with('success', 'Juego creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        return view('Games.edit',compact('game'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        $request->validate([
            'name' => 'required',
            'levels' => 'required|numeric',
            'release' => 'required|date',
            
        ]);
        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($game->image) {
                Storage::disk('public')->delete($game->image);
            }
        
            // Guardar la nueva imagen en "storage/app/public/img/"
            $nombre = $game->id . '.' . $request->file('image')->getClientOriginalExtension();
            $img = $request->file('image')->storeAs('img', $nombre, 'public');
        
            // Guardar la ruta correctamente en la base de datos
            $game->image = 'img/' . $nombre;
            $game->save();
        }        
        $game->update($request->input());
        return redirect()->route('games.index')->with('success', 'Juego actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        Storage::disk('public')->delete($game->image);
        $game->delete();
        return redirect()->route('games.index')->with('success', 'Juego Eliminado');
    }
}
