<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        return view('media/form');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'type' => 'required|numeric',
        ]);
            $media = new Media;
            $media->title = $request['title'];
            $media->type = $request['type'];
            if($request->file())
             {
                $fileName = time().'_'.$request->file->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
                $media->file_path = '/storage/uploads/'. $fileName;
            }
            $media->save();
        return redirect()->route('home');
    }
}
