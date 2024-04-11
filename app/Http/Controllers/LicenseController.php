<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LicenseController extends Controller
{
    public function index()
    {
        if (has_permission('admin')) {
            $licenses = License::all();
        } else {
            $licenses = Auth::user()->licenses;
        }

        return view('licenses.index', compact('licenses'));
    }

    public function create()
    {
        if (!has_permission('admin')) {
            abort(403, 'Unauthorized');
        }

        return view('licenses.create');
    }

    public function store(Request $request)
    {
        if (!has_permission('admin')) {
            abort(403, 'Unauthorized');
        }

        $validatedData = $request->validate([
            'project' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'locked' => 'boolean',
        ]);

        $license = new License();
        $license->license = $this->generateLicenseKey();
        $license->project = $validatedData['project'];
        $license->user_id = $validatedData['user_id'];
        $license->locked = $validatedData['locked'] ?? false;
        $license->save();

        return redirect()->route('licenses.show', $license)->with('success', 'License created successfully');
    }

    public function show(License $license)
    {
        if (!has_permission('admin') && $license->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('licenses.show', compact('license'));
    }

    public function edit(License $license)
    {
        if (!has_permission('admin')) {
            abort(403, 'Unauthorized');
        }

        return view('licenses.edit', compact('license'));
    }

    public function update(Request $request, License $license)
    {
        if (!has_permission('admin') && $license->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if ($request->has('regenerate')) {
            $license->license = $this->generateLicenseKey();
            $license->save();

            return redirect()->route('licenses.index')->with('success', 'License regenerated successfully');
        }

        if ($request->has('lock')) {
            $license->locked = true;
            $license->save();

            return redirect()->route('licenses.index')->with('success', 'License locked successfully');
        }

        if ($request->has('unlock')) {
            $license->locked = false;
            $license->save();

            return redirect()->route('licenses.index')->with('success', 'License unlocked successfully');
        }

        $validatedData = $request->validate([
            'project' => 'required|string',
            'locked' => 'boolean',
        ]);

        $license->update($validatedData);

        return redirect()->route('licenses.show', $license)->with('success', 'License updated successfully');
    }

    public function destroy(License $license)
    {
        if (!has_permission('admin')) {
            abort(403, 'Unauthorized');
        }

        $license->delete();

        return redirect()->route('licenses.index')->with('success', 'License deleted successfully');
    }

    public function regenerate(License $license)
    {
        if (!has_permission('admin') && $license->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $license->license = $this->generateLicenseKey();
        $license->save();

        return redirect()->route('licenses.index')->with('success', 'License regenerated successfully');
    }

    public function lock(License $license)
    {
        if (!has_permission('admin') && $license->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $license->locked = true;
        $license->save();

        return redirect()->route('licenses.index')->with('success', 'License locked successfully');
    }

    public function unlock(License $license)
    {
        if (!has_permission('admin') && $license->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $license->locked = false;
        $license->save();

        return redirect()->route('licenses.index')->with('success', 'License unlocked successfully');
    }

    private function generateLicenseKey()
    {
        $prefix = 'RHUB-';
        $parts = [];

        for ($i = 0; $i < 4; $i++) {
            $parts[] = strtoupper(substr(md5(uniqid()), 0, 4));
        }

        return $prefix . implode('-', $parts);
    }
}
