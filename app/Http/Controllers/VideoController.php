<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function get(Video $video){
        return $video;
    }

    public function index(){
        return Video::orderBy('created_at', 'desc')->get();
    }
}
