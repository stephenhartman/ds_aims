<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use ImageOptimizer;

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

        $filename = bin2hex(random_bytes(12)) . "." . $image->getClientOriginalExtension();
        $filename = str_replace(' ', '', $filename);
        $file = $image->move(public_path('images/posts'), $filename);
        try
        {
            ImageOptimizer::optimize($file);
        }
        finally
        {
            return mce_back($filename);
        }

    }

}