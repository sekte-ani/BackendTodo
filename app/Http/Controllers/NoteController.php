<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Resources\NoteResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Resources\NoteDetailResource;
use Illuminate\Support\Facades\Redirect;

class NoteController extends Controller
{
    public function index()
    {
        $note = Note::all();
        return NoteResource::collection($note);
    }

    public function show($id)
    {
        $note = Note::with('kategori:id,jenis_kategori')->findOrFail($id);
        return new NoteDetailResource($note);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'kategori_id' => 'required'
        ]);

        $request['user_id'] = Auth::user()->id;
        $note = Note::create($request->all());
        return new NoteDetailResource($note->loadMissing('kategori:id,jenis_kategori'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'kategori_id' => 'required'
        ]);

        $note = Note::findOrFail($id);
        $note->update($request->all());
        return new NoteDetailResource($note->loadMissing('kategori:id,jenis_kategori'));
    }

    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();

        return new NoteDetailResource($note->loadMissing('kategori:id,jenis_kategori'));
    }
}
