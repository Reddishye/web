<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AddPermissionCommand extends Command
{
    protected $signature = 'permission:add';

    protected $description = 'Add a permission to a user';

    public function handle()
    {
        $userId = $this->ask('Enter the user ID');
        $permission = $this->ask('Enter the permission to add');

        $user = User::find($userId);

        if (! $user) {
            $this->error('User not found!');

            return;
        }

        if (! $this->confirm('Are you sure you want to add this permission to user '.$user->name.'?')) {
            $this->info('Operation cancelled.');

            return;
        }

        $permissions = $user->permissions ?? [];
        if (! in_array($permission, $permissions)) {
            $permissions[] = $permission;
            $user->permissions = $permissions;
            $user->save();
            $this->info('Permission added successfully.');
        } else {
            $this->info('User already has this permission.');
        }
    }
}
