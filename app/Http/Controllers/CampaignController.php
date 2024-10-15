<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Funnel;
use App\Models\FunnelCountry;
use App\Models\FunnelDevice;
use App\Models\FunnelOffer;
use App\Models\FunnelSetting;
use App\Models\TimeUnit;
use Brian2694\Toastr\Facades\Toastr;
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
        $campaigns = Campaign::orderBy('created_at', 'desc')->paginate(10);


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
            'delay_unit' => 'required',
            'number_of_popups' => 'required|integer|min:1',
            'every' => 'required|integer',
            'every_unit' => 'required',
            'pop_interval' => 'required|integer|min:1',
            'interval_unit' => 'required',
            'funnels.*.offers.*.offer_id' => 'required|integer|exists:offers,id',
            'funnels.*.offers.*.ratio' => 'required|integer|min:1|max:100',
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
                'code' => Campaign::generateCode(),
                'name' => $request->input('name'),
                'status' => $request->input('status'),
                'description' => $request->input('description'),
                'delay' => $request->input('delay'),
                'delay_unit' => $request->input('delay_unit'), //
                'number_of_popups' => $request->input('number_of_popups'), //
                'every' => $request->input('every'), //
                'every_unit' => $request->input('every_unit'), //
                'pop_interval' => $request->input('pop_interval'), //
                'interval_unit' => $request->input('interval_unit'), //

            ]);
            $zoneId = $campaign->code;
            $backendUrl = env('URL_BACKEND', 'https://api-pop.diveinthebluesky.biz'); //

            $scriptContent = "
                <script src=\"{$backendUrl}/pop?zoneId={$zoneId}\"></script>
                <script src=\"{$backendUrl}/pop-under?zoneId={$zoneId}\"></script>
            ";

            $campaign->update([
                'content' => $scriptContent,
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
                            'targeting_type' => $funnelData['country_targeting_type'] ?? 'none', // Default to 'include'
                        ]);
                    }
                }

                // Step 2.4: Add Devices (if provided)
                if (isset($funnelData['devices'])) {
                    foreach ($funnelData['devices'] as $deviceId) {
                        FunnelDevice::create([
                            'funnel_id' => $funnel->id,
                            'device_id' => $deviceId,
                            'targeting_type' => $funnelData['device_targeting_type'] ?? 'none', // Default to 'include'
                        ]);
                    }
                }
            }
            // Step 3: Store the campaign in Redis
            $formattedCampaign = Campaign::with([
                'funnels',
                'funnels.offers' => function ($query) {
                    $query->with('offer:id,direct_link,name'); // Retrieve the related offer details
                },
                'funnels.countries',
                'funnels.devices',
            ])->where('code', $zoneId)->firstOrFail()->toArray();

            // Step 4: Store the campaign data into Redis permanently
            $redisKey = "{$campaign->code}";
            Redis::set($redisKey, json_encode($formattedCampaign));

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Campaign created successfully.',
                'data' => $campaign->code,
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

    //render code (number)


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = Campaign::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $model->code,
        ]);
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

            $redisKey = "{$campaign->code}";
            if(Redis::exists($redisKey)) {
                Redis::del($redisKey);
            }


            DB::commit();

            Toastr::success('Campaign deleted successfully.');
            return redirect()->route('admin.campaigns.index');

        } catch (\Exception $e) {
            DB::rollBack();

            Toastr::error($e->getMessage());

            return redirect()->back();
        }
    }

}
