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
    'latitude' => 'nullable|numeric',
    'longitude' => 'nullable|numeric',
    'status' => 'required',
    'description' => 'required|min:10',
     'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
    ]);

    $reportData = [
        'species_name' => $request->species_name,
        'location' => $request->location,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'status' => $request->status,
        'description' => $request->description,
        'user_id' => Auth::id(),
    ];

    if($request->hasFile('image'))
    {
        $file = $request->file('image');
        $reportData['image'] = $file->getClientOriginalName();
        $reportData['image_mime'] = $file->getMimeType();
    }

    $report = Report::create($reportData);

    // Insert binary data separately for PostgreSQL compatibility
    if($request->hasFile('image'))
    {
        $imageData = file_get_contents($request->file('image')->getRealPath());
        \Illuminate\Support\Facades\DB::table('reports')
            ->where('id', $report->id)
            ->update(['image_data' => $imageData]);
    }

        return redirect(url('/reports'));
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
    'latitude' => 'nullable|numeric',
    'longitude' => 'nullable|numeric',
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
    $updateData = [
        'species_name' => $request->species_name,
        'location' => $request->location,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'status' => $request->status,
        'description' => $request->description,
    ];

    if($request->hasFile('image'))
    {
        $file = $request->file('image');
        $updateData['image'] = $file->getClientOriginalName();
        $updateData['image_mime'] = $file->getMimeType();
    }

    $report->update($updateData);

    // Insert binary data separately for PostgreSQL compatibility
    if($request->hasFile('image'))
    {
        $imageData = file_get_contents($request->file('image')->getRealPath());
        \Illuminate\Support\Facades\DB::table('reports')
            ->where('id', $report->id)
            ->update(['image_data' => $imageData]);
    }

    return redirect(url('/reports'));
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

    return redirect(url('/reports'));
    }
}