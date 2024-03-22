<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Http\Request;

class UserViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Projects::all();
        return view('welcome', compact('projects'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Projects $project)
    {
        return view('welcome', compact('project'));
    }
}
