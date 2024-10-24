<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Offers';
        $data = Offer::orDerBy('id', 'desc')->paginate(20);
        return view('admin.offers.index', compact('title','data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Offer';
        return view('admin.offers.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'direct_link' => 'required',
            'status' => 'required',
        ]);
        Offer::create($request->all());
        Toastr::success('Offer created successfully');
        return redirect()->route('admin.offers.index');
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
        $model = Offer::findOrFail($id);
        $title = 'Edit Offer';
        return view('admin.offers.edit', compact('title', 'model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'direct_link' => 'required',
            'status' => 'required',
        ]);
        $model = Offer::findOrFail($id);
        $model->update($request->all());
        Toastr::success('Offer updated successfully');
        return redirect()->route('admin.offers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Offer::findOrFail($id);
        $model->delete();
        Toastr::success('Offer deleted successfully');
        return redirect()->route('admin.offers.index');
    }
    public function listOffers(Request $request)
    {
        $search = $request->input('search');
        $limit = $request->input('limit', 10); // Mặc định là 10 bản ghi nếu không có limit

        $offers = Offer::query()
            ->where('status', 'active')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->limit($limit) // Giới hạn số bản ghi trả về
            ->get();

        return response()->json($offers);
    }
}
