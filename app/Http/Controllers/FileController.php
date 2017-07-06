<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;
use App\File;

class FileController extends Controller
{
	public function upload(Request $request, $type, $id)
	{
		$model = '\App\\'.ucfirst($type);
		$object = $model::find($id);
		$this->authorize('update', $object);

		$this->validate($request, [
	        'file' => 'required|file|mimetypes:image/jpeg,image/gif,image/png,application/pdf|max:5000',
	    ]);		    

	    $name = $request->file->getClientOriginalName();
	    $mime = $request->file->getMimeType();
	    $full_path = $type.'/'.$id.'/'.$name;

	    $upload = \Storage::disk('s3')->getDriver()->put($full_path, file_get_contents($request->file), [
	                   'visibility' => 'public',
	                   'ContentType' => $mime
	               ]);  

	    if($upload){
	    	$file = new File();
	    	$file->path = $full_path;
	    	$file->name = $name;
	    	$file->fileable_id = $id;
	    	$file->fileable_type = 'App\\'.ucfirst($type);
	    	$file->user_id = Auth::id();
	    	$file->save();

	    	$request->session()->flash('status', 'Your file was uploaded!');
	    }else{
	    	$request->session()->flash('error', 'There was a problem uploading your file!');
	    }    	

		return back();

	}

	public function delete(Request $request, $id)
	{
		$file = File::find($id);
		$this->authorize('delete', $file);
		
		$file->delete();

		$request->session()->flash('status', 'Successfully deleted the file!');

		return back();
	}
}
