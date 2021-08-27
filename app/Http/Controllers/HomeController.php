<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if(empty($user))
        {
            $media = Media::where('type','3')->get();
        }
        else
        {
            $media = Media::get();
        }
        return view('welcome')->with(['media'=>$media]);
    }
}
