<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class TinymceController extends Controller
{
    /**
     * Handle image upload from TinyMCE file browser window
     *
     * @param  Request $request
     * @return Response
     */
    public function uploadImage(Request $request)
    {
        $image = $request->file('image');

        $filename = $image->getClientOriginalName();
        $filename = str_replace(' ', '', $filename);
        $file = $image->move(public_path('images/posts'), $filename);
        ImageOptimizer::optimize($file);

        return mce_back($filename);
    }

}