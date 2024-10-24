<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use App\Models\Stat;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class SyncReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Switch to Redis database 12
        Redis::select(12);

        // Get all keys from Redis database 12
        $keys = Redis::keys('*');

        // Loop through keys and process each one
        foreach ($keys as $key) {
            // Retrieve the Redis value (JSON format)
            $value = Redis::get($key);
            $campaignId = Campaign::where('code', $key)->value('id');
            $data = json_decode($value, true); // Convert JSON to array

            foreach ($data['funnels'] as $funnelData) {
                $funnelId = $funnelData['funnel_id'];
                $date = $funnelData['date'];
                foreach ($funnelData['offers'] as $offerData) {
                    $offerId = $offerData['offer_id'];
                    $imps = $offerData['imps'];
                    $clicks = $offerData['clicks'];
                    Stat::updateOrCreate(
                        [
                            'campaign_id' => $campaignId,
                            'funnel_id' => $funnelId,
                            'offer_id' => $offerId,
                            'date' => $date, // You can track the stats by date
                        ],
                        [
                            'impressions' => $imps,
                            'clicks' => $clicks,
                        ]
                    );
                }
            }
        }
        $this->info('Synchronization complete.');
    }

}
