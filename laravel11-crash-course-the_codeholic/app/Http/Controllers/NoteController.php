<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::query()->orderBy('created_at','desc')->paginate();
        // dd($notes);
        return view('note.index',['notes'=>$notes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('note.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
           'note'=>['required','string']
        ]);
        $data['user_id']=1;

        $note=Note::create($data);

        return to_route('note.show', $note->id)->with('mess ', 'Note created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
      
        return view('note.show',['note'=>$note]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return view('note.edit',['note'=>$note]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
       $data=$request->validate([
           'note'=>['required','string']
        ]);
        
        $note->update($data);

        return to_route('note.show', $note->id)->with('message', 'Note updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return to_route('note.index')->with('message', 'Note deleted successfully');
    }
}
