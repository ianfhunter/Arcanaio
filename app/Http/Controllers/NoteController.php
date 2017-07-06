<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Note;

class NoteController extends Controller
{

    public function note(Request $request, $type, $id){

	    $type = ucfirst($type);
	    $event_name = 'App\Events\\'.$type.'NoteCreated';

	    $this->validate($request, [
	        'body' => 'required',
	    ]);

	    $note = new Note;
	    $note->user_id = \Auth::id();
	    $note->body = $request->input('body');
	    $note->noteable_id = $id;
	    $note->noteable_type = 'App\\'.$type;
	    $note->save();
        
        return back();
    }

    public function delete($id){
    	$note = Note::findOrFail($id);
    	$this->authorize('delete', $note);
    	$note->delete();
    	return back();
    }
}
