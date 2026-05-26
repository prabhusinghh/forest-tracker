<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ExploreController extends Controller
{
    /**
     * Display a public gallery of wildlife reports.
     */
    public function index(Request $request)
    {
        $query = Report::query();

        // Search by species name
        if ($request->has('search') && $request->search != '') {
            $query->where('species_name', 'ILIKE', '%' . $request->search . '%');
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Fetch reports with pagination for the gallery
        $reports = $query->latest()->paginate(12)->withQueryString();

        return view('explore.index', compact('reports'));
    }

    /**
     * Display the details of a specific public report.
     */
    public function show($id)
    {
        $report = Report::findOrFail($id);

        return view('explore.show', compact('report'));
    }
}
