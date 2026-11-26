<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;

class Login extends BaseLogin
{
    protected string $view = 'filament.pages.auth.login';

    public function getHeading(): string|Htmlable
    {
        return 'Masuk Portal Petugas & Aparatur';
    }

    public function getSubheading(): string|Htmlable|null
    {
        return 'Sistem Informasi Pelayanan, Administrasi & Data Spasial Sukawarna';
    }

    public function selectRole(string $email): void
    {
        $this->form->fill([
            'email' => $email,
            'password' => 'password',
            'remember' => true,
        ]);
    }
}
