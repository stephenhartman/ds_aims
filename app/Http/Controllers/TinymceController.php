<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

        $filename = 'image_'.time().'_'.$image->hashName();
        $image->move(public_path('images/posts'), $filename);

        return mce_back($filename);
    }

}