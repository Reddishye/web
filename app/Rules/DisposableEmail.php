<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class DisposableEmail implements Rule
{
    protected $disposableDomains;
    protected $additionalDomains = [
        'lisoren.com',
    ];
    protected $recognizedDomains = [
        'outlook.com',
        'outlook.es',
        'hotmail.com',
        'yahoo.com',
        'protonmail.com',
    ];

    public function __construct()
    {
        $this->loadDisposableDomains();
    }

    protected function loadDisposableDomains()
    {
        $localPath = 'disposable_email_blocklist.conf';

        if (Storage::exists($localPath)) {
            $this->disposableDomains = array_merge(
                file(storage_path('app/' . $localPath), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES),
                $this->additionalDomains
            );
        } else {
            $this->disposableDomains = $this->additionalDomains;
        }
    }

    public function passes($attribute, $value)
    {
        $domain = substr(strrchr($value, "@"), 1);

        // Verificar si el dominio está en la lista de dominios desechables
        if (in_array($domain, $this->disposableDomains)) {
            return false;
        }

        // Verificar si el dominio está en la lista de dominios reconocidos
        if (in_array($domain, $this->recognizedDomains)) {
            return true;
        }

        // Verificar con la API de MailCheck.ai
        $response = Http::get("https://api.mailcheck.ai/domain/{$domain}");
        if ($response->successful()) {
            $data = $response->json();
            return !$data['disposable'];
        }

        return false;
    }

    public function message()
    {
        return 'Temporally domains are blocked.';
    }
}
