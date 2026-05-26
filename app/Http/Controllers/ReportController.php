<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(Request $request)
{
    $query = Report::query();

    if($request->species_name)
    {
        $query->where('species_name',
            'LIKE',
            '%' . $request->species_name . '%');
    }

    if($request->location)
    {
        $query->where('location',
            'LIKE',
            '%' . $request->location . '%');
    }

    if($request->status)
    {
        $query->where('status',
            $request->status);
    }

    $reports = $query->latest()->get();

    return view('reports.index',
        compact('reports'));
}

    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
    'species_name' => 'required|min:3',
    'location' => 'required',
    'status' => 'required',
    'description' => 'required|min:10',
     'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
    ]);
      $imagePath = null;

    if($request->hasFile('image'))
    {
        $imagePath = $request->file('image')
                             ->store('reports', 'public');
    }
        Report::create([
            'species_name' => $request->species_name,
            'location' => $request->location,
            'status' => $request->status,
            'description' => $request->description,
            'image' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return redirect('/reports');
    }
    public function edit($id)
{
    $report = Report::findOrFail($id);

    if(
        Auth::id() != $report->user_id &&
        Auth::user()->role != 'admin'
    )
    {
        abort(403);
    }

    return view('reports.edit', compact('report'));
}

    public function update(Request $request, $id)
    {
   
    $request->validate([
    'species_name' => 'required|min:3',
    'location' => 'required',
    'status' => 'required',
    'description' => 'required|min:10',
    'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
    ]);
    $report = Report::findOrFail($id);
    if(
    Auth::id() != $report->user_id &&
    Auth::user()->role != 'admin'
)
{
    abort(403);
}
    $imagePath = $report->image;

    if($request->hasFile('image'))
    {
        $imagePath = $request->file('image')
                             ->store('reports', 'public');
    }

    $report->update([
        'species_name' => $request->species_name,
        'location' => $request->location,
        'status' => $request->status,
        'description' => $request->description,
        'image' => $imagePath
    ]);

    return redirect('/reports');
    }

    public function destroy($id)
    {
    $report = Report::findOrFail($id);
    if(
    Auth::id() != $report->user_id &&
    Auth::user()->role != 'admin'
)
{
    abort(403);
}

    $report->delete();

    return redirect('/reports');
    }
}