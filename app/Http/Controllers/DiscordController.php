<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class DiscordController extends Controller
{
    /**
     * Redirect the user to the Discord authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('discord')->redirect();
    }

    /**
     * Obtain the user information from Discord.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $discordUser = Socialite::driver('discord')->user();

        $user = User::where('discord_id', $discordUser->id)->first();

        if ($user) {
            $user->update([
                'discord_username' => $discordUser->nickname,
                'discord_displayname' => $discordUser->name,
                'discord_avatar_url' => $discordUser->avatar,
            ]);

            Auth::guard('web')->login($user);

            return redirect('/user/profile');
        } else {
            $user = Auth::user();

            if ($user) {
                $user->update([
                    'discord_id' => $discordUser->id,
                    'discord_username' => $discordUser->name,
                    'discord_displayname' => $discordUser->name,
                    'discord_avatar_url' => $discordUser->avatar,
                ]);

                return redirect('/user/profile')->with('success', 'Discord account linked successfully.');
            } else {
                session([
                    'discord_id' => $discordUser->id,
                    'discord_username' => $discordUser->nickname,
                    'discord_displayname' => $discordUser->name,
                    'discord_avatar_url' => $discordUser->avatar,
                    'discord_email' => $discordUser->email,
                ]);

                return redirect()->route('login')->with('info', 'Please log in to link your Discord account.');
            }
        }
    }
}
