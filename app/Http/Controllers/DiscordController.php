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
        try {
            $discordUser = Socialite::driver('discord')->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Failed to authenticate with Discord.');
        }

        // Buscar usuario por discord_id o email
        $user = User::where('discord_id', $discordUser->id)->orWhere('email', $discordUser->email)->first();

        if ($user) {
            // Si el usuario existe, actualizar la información y loguear
            $user->update([
                'discord_username' => $discordUser->nickname,
                'discord_displayname' => $discordUser->name,
                'discord_avatar_url' => $discordUser->avatar,
                'discord_token' => $discordUser->token,
                'discord_refresh_token' => $discordUser->refreshToken,
            ]);

            Auth::login($user);

            return redirect('/dashboard');
        } else {
            // Si el usuario no existe, crear uno nuevo
            $user = User::create([
                'name' => $discordUser->name,
                'email' => $discordUser->email,
                'discord_id' => $discordUser->id,
                'discord_username' => $discordUser->nickname,
                'discord_displayname' => $discordUser->name,
                'discord_avatar_url' => $discordUser->avatar,
                'discord_token' => $discordUser->token,
                'discord_refresh_token' => $discordUser->refreshToken,
                'password' => bcrypt(str_random(16)), // Generar una contraseña aleatoria
            ]);

            Auth::login($user);

            return redirect('/dashboard');
        }
    }
}
