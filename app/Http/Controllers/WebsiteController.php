<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Websites';
        $data = Website::orderBy('id', 'desc')->paginate(10);
        return view('admin.websites.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function listWebsites(Request $request)
    {
        $search = $request->input('search', '');
        $limit = $request->input('limit', 10); // Default limit to 10 if not provided
        $page = $request->input('page', 1); // Default to page 1 if not provided
        $offset = ($page - 1) * $limit;

        // Query websites with optional search term
        $query = Website::select('id', 'url')
            ->where('status', 'active')
            ->when($search, function ($query, $search) {
                return $query->where('url', 'like', "%{$search}%");
            });

        // Get the total count for pagination
        $totalCount = $query->count();

        // Fetch the websites for the current page with the specified limit
        $websites = $query->offset($offset)->limit($limit)->get();

        // Format the results for Select2 (Select2 expects `id` and `text`)
        $formattedResults = $websites->map(function ($website) {
            return [
                'id' => $website->id,
                'text' => $website->url
            ];
        });

        return response()->json([
            'results' => $formattedResults, // Renamed 'items' to 'results' to match Select2's expectations
            'total_count' => $totalCount,  // Total number of results for pagination
        ]);
    }


}
