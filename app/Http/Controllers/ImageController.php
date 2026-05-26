<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    /**
     * Serve a report's image from the database.
     */
    public function show($id): Response
    {
        $report = Report::findOrFail($id);

        if (!$report->image_data || !$report->image_mime) {
            abort(404);
        }

        $imageData = $report->image_data;

        // PostgreSQL returns bytea as a stream resource
        if (is_resource($imageData)) {
            $imageData = stream_get_contents($imageData);
        }

        return response($imageData, 200, [
            'Content-Type' => $report->image_mime,
            'Content-Length' => strlen($imageData),
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}
