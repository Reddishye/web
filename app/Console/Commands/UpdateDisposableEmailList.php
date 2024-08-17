<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class UpdateDisposableEmailList extends Command
{
    protected $signature = 'update:disposable-email-list';
    protected $description = 'Update the disposable email list from GitHub';

    public function handle()
    {
        $url = 'https://raw.githubusercontent.com/disposable-email-domains/disposable-email-domains/master/disposable_email_blocklist.conf';
        $localPath = 'disposable_email_blocklist.conf';

        try {
            $response = Http::get($url);

            if ($response->successful()) {
                Storage::put($localPath, $response->body());
                $this->info('Disposable email list updated successfully.');
            } else {
                $this->error('Failed to download the list from GitHub.');
            }
        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }
}
