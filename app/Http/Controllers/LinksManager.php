<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;

class LinksManager extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = Link::all();
        return view('admin.links.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.links.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(['enabled' => $request->input('enabled', true)]);
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'path' => 'required|string',
            'link' => 'required|url',
            'fa_icon' => 'required|string',
            'enabled' => 'boolean',
            'color' => 'required|string',
        ]);

        $link = Link::create($validatedData);
        return redirect()->route('links.index')->with('success', 'Link created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Link $link)
    {
        return view('admin.links.show', compact('link'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        return view('admin.links.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Link $link)
    {
        $request->merge(['enabled' => $request->input('enabled', true)]);
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'path' => 'required|string',
            'link' => 'required|url',
            'fa_icon' => 'required|string',
            'enabled' => 'boolean',
            'color' => 'required|string',
        ]);

        $link->update($validatedData);
        return redirect()->route('links.index')->with('success', 'Link updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        $link->delete();
        return redirect()->route('links.index')->with('success', 'Link deleted successfully.');
    }
}
