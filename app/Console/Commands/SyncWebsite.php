<?php

namespace App\Console\Commands;

use App\Models\Website;
use Illuminate\Console\Command;

class SyncWebsite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-website';

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
        $client = new \GuzzleHttp\Client();
        $page = 1;
        $hasMoreData = true;
        while ($hasMoreData) {
            $response = $client->get("https://ssp.alphabetexchange.com/api/domain/all?page={$page}");

            $statusCode = $response->getStatusCode();
            if ($statusCode == 200) {
                $data = json_decode($response->getBody()->getContents(), true);

                if ($data['success'] && count($data['data']) > 0) {
                    // Duyệt qua từng website trong kết quả
                    foreach ($data['data'] as $websiteData) {
                        Website::updateOrCreate(
                            ['url' => $websiteData['url']], //
                            ['status' => 'active'] //
                        );
                        $this->info("Website {$websiteData['url']} synchronized successfully.");
                    }

                    $this->info("Page {$page} synchronized successfully.");

                    $page++;
                } else {
                    $hasMoreData = false;
                    $this->info("No more data to sync.");
                }
            } else {
                $this->error("Error fetching page {$page}: " . $response->getReasonPhrase());
                break;
            }
        }
    }
}
