<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Funnel;
use App\Models\FunnelCountry;
use App\Models\FunnelDevice;
use App\Models\FunnelOffer;
use App\Models\FunnelSetting;
use App\Models\TimeUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Campaigns';
        $campaigns = Campaign::with('funnels', 'funnels.offers', 'funnels.settings', 'funnels.countries', 'funnels.devices')->paginate(10);


        return view('admin.campaigns.index', compact('title', 'campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Campaign';
        $timeUnits = TimeUnit::all();
        return view('admin.campaigns.create', compact('title', 'timeUnits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Add validation for the funnel offers
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'delay' => 'required|integer',
            'frequency' => 'required|integer',
            'funnels.*.offers.*.offer_id' => 'required|integer|exists:offers,id', //
            'funnels.*.offers.*.ratio' => 'required|integer|min:1|max:100', //
        ], [
            'funnels.*.offers.*.offer_id.required' => 'Each funnel must have at least one offer.',
            'funnels.*.offers.*.offer_id.exists' => 'The selected offer does not exist.',
            'funnels.*.offers.*.ratio.required' => 'Each offer must have a ratio value.',
            'funnels.*.offers.*.ratio.min' => 'The ratio must be at least 1.',
            'funnels.*.offers.*.ratio.max' => 'The ratio must not exceed 100.',
        ]);

        DB::beginTransaction();
        try {
            // Step 1: Create the campaign
            $campaign = Campaign::create([
                'name' => $request->input('name'),
                'status' => $request->input('status'),
                'description' => $request->input('description'),
                'delay' => $request->input('delay'),
                'delay_unit_id' => $request->input('delay_unit_id'),
                'frequency' => $request->input('frequency'),
                'frequency_unit_id' => $request->input('frequency_unit_id'),
            ]);

            // Step 2: Create related funnels, offers, countries, devices, and settings
            foreach ($request->input('funnels', []) as $funnelIndex => $funnelData) {
                // Step 2.1: Create Funnel
                $funnel = Funnel::create([
                    'campaign_id' => $campaign->id,
                    'status' => $request->input("funnels.$funnelIndex.status", 'active'),
                ]);

                // Step 2.2: Add Offers to the Funnel
                foreach ($funnelData['offers'] as $offerIndex => $offerData) {
                    FunnelOffer::create([
                        'funnel_id' => $funnel->id,
                        'offer_id' => $offerData['offer_id'],
                        'ratio' => $offerData['ratio'],
                    ]);
                }

                // Step 2.3: Add Countries (if provided)
                if (isset($funnelData['countries'])) {
                    foreach ($funnelData['countries'] as $countryId) {
                        FunnelCountry::create([
                            'funnel_id' => $funnel->id,
                            'country_id' => $countryId,
                            'targeting_type' => $funnelData['country_targeting_type'] ?? 'include', // Default to 'include'
                        ]);
                    }
                }

                // Step 2.4: Add Devices (if provided)
                if (isset($funnelData['devices'])) {
                    foreach ($funnelData['devices'] as $deviceId) {
                        FunnelDevice::create([
                            'funnel_id' => $funnel->id,
                            'device_id' => $deviceId,
                            'targeting_type' => $funnelData['device_targeting_type'] ?? 'include', // Default to 'include'
                        ]);
                    }
                }

                FunnelSetting::create([
                    'funnel_id' => $funnel->id,
                    'delay' => $request->input("funnels.$funnelIndex.delay"),
                    'delay_unit_id' => $request->input("funnels.$funnelIndex.delay_unit_id"),
                    'frequency' => $request->input("funnels.$funnelIndex.frequency"),
                    'frequency_unit_id' => $request->input("funnels.$funnelIndex.frequency_unit_id"),
                ]);
            }
            $redisKey = "zoneId:{$campaign->id}";

            $campaignData = [
                'campaign' => $campaign->toArray(),
                'funnels' => $campaign->funnels()->with(['offers', 'settings', 'countries', 'devices'])->get()->toArray(),
            ];

            // Use Redis directly to push the campaign data
            Redis::lpush($redisKey, json_encode($campaignData));


            DB::commit();


            return response()->json([
                'success' => true,
                'message' => 'Campaign created successfully and stored in Redis permanently.',
            ]);

        } catch (\Exception $e) {
            // If an exception occurs, rollback the transaction
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
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
        DB::beginTransaction();

        try {
            $campaign = Campaign::findOrFail($id);

            $campaign->funnels()->each(function ($funnel) {
                $funnel->offers()->delete();
                $funnel->countries()->delete();
                $funnel->devices()->delete();
                $funnel->settings()->delete();

                $funnel->delete();
            });

            $campaign->delete();

            $redisKey = "zoneId:{$id}";
            if (Cache::has($redisKey)) {
                Cache::forget($redisKey);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Campaign deleted successfully',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error deleting campaign: ' . $e->getMessage(),
            ], 500);
        }
    }

}
