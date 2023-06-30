<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Dtos\VideoPreview;

class VideoController extends Controller
{
    public function get(Video $video){
        return $video;
    }

    public function index(){
        $videos = Video::orderBy('created_at', 'desc')->get()
        ->mapInto(VideoPreview::class);

        return $videos;

    }
}
