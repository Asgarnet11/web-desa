<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;

class Login extends BaseLogin
{
    protected string $view = 'filament.pages.auth.login';

    public ?string $selectedDemoEmail = null;

    public function getHeading(): string|Htmlable
    {
        return 'Portal Aparatur Kelurahan';
    }

    public function getSubheading(): string|Htmlable|null
    {
        return 'Administrasi Pelayanan, Aspirasi & Data Spasial Konda';
    }

    public function selectRole(string $email): void
    {
        $this->selectedDemoEmail = $email;

        $this->form->fill([
            'email' => $email,
            'password' => 'password',
            'remember' => true,
        ]);
    }
}
