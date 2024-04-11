<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ViewUsersCommand extends Command
{
    protected $signature = 'user:all';

    protected $description = 'Display a list of users and their permissions';

    public function handle()
    {
        $headers = ['ID', 'Name', 'Email', 'Permissions'];

        $users = User::all(['id', 'name', 'email', 'permissions'])->map(function ($user) {
            return [
                $user->id,
                $user->name,
                $user->email,
                is_array($user->permissions) ? implode(', ', $user->permissions) : $user->permissions,
            ];
        })->toArray();

        $this->table($headers, $users);
    }
}
