<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinksViewer extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = Link::all();
        return view('links', compact('links'));
    }

/**
 * Redirect to a specific link based on the path.
 */
public function redirect($path = null)
{
    if ($path === null) {
        $links = Link::all();
        return view('links', compact('links'));
    }

    $link = Link::where('path', $path)->first();

    if ($link) {
        if ($link->link) {
            return redirect()->away($link->link);
        } else {
            return view('links', compact('links'));
        }
    }

    abort(404);
}
}
