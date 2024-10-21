<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

    public static function listCountries(Request $request)
    {
        // Get the search term and the current page (from select2)
        $search = $request->input('search', '');
        $limit = $request->input('limit', 10); // Default limit to 10 if not provided
        $page = $request->input('page', 1); // Default to page 1 if not provided
        $offset = ($page - 1) * $limit;

        // Query countries with optional search term
        $query = Country::select('id', 'name')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            });

        // Get the total count for pagination
        $totalCount = $query->count();

        // Fetch the countries for the current page with the specified limit
        $countries = $query->offset($offset)->limit($limit)->get();

        // Return the results in the format required by select2 with pagination info
        return response()->json([
            'items' => $countries,  // The items for the current page
            'total_count' => $totalCount,  // The total number of results for pagination
        ]);
    }

}
