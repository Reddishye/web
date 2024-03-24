<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class RemovePermissionCommand extends Command
{
    protected $signature = 'permission:remove';
    protected $description = 'Remove a permission from a user';

    public function handle()
    {
        $userId = $this->ask('Enter the user ID');
        $permission = $this->ask('Enter the permission to remove');

        $user = User::find($userId);

        if (!$user) {
            $this->error('User not found!');
            return;
        }

        if (!$this->confirm('Are you sure you want to remove this permission from user ' . $user->name . '?')) {
            $this->info('Operation cancelled.');
            return;
        }

        $permissions = $user->permissions ?? [];
        if (($key = array_search($permission, $permissions)) !== false) {
            unset($permissions[$key]);
            $user->permissions = array_values($permissions);
            $user->save();
            $this->info('Permission removed successfully.');
        } else {
            $this->info('User does not have this permission.');
        }
    }
}
