<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ViewPermissionsCommand extends Command
{
    protected $signature = 'permission:view';

    protected $description = 'View all permissions of a user';

    public function handle()
    {
        $userId = $this->ask('Enter the user ID');

        $user = User::find($userId);

        if (! $user) {
            $this->error('User not found!');

            return;
        }

        if (! $this->confirm('Are you sure you want to view permissions for user '.$user->name.'?')) {
            $this->info('Operation cancelled.');

            return;
        }

        $permissions = $user->permissions ?? [];
        if (empty($permissions)) {
            $this->info('User has no permissions.');
        } else {
            $this->info('User permissions: '.implode(', ', $permissions));
        }
    }
}
