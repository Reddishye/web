<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    protected $signature = 'user:add';
    protected $description = 'Create a new user based on input.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->ask('What is the user\'s name?');
        $email = $this->ask('What is the user\'s email?');
        while (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error("The email format is invalid.");
            $email = $this->ask('What is the user\'s email?');
        }
        $password = $this->secret('What is the user\'s password?');

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info("Successfully created user: {$user->name}");
    }
    
}