<?php

namespace App\Models;

use App\Enums\PeranUser;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'wilayah_id',
        'peran',
        'status_aktif',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'peran' => PeranUser::class,
            'status_aktif' => 'boolean',
        ];
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if (! $this->status_aktif) {
            return false;
        }

        // Public role cannot access admin panel; staff, leaders, and field officers can
        return in_array($this->peran, [
            PeranUser::SuperAdmin,
            PeranUser::AdminWilayah,
            PeranUser::Operator,
            PeranUser::Pimpinan,
            PeranUser::KetuaRtRw,
            PeranUser::KaderKesehatan,
        ], true);
    }

    public function isSuperAdmin(): bool
    {
        return $this->peran === PeranUser::SuperAdmin;
    }

    public function isAdminWilayah(): bool
    {
        return $this->peran === PeranUser::AdminWilayah;
    }

    public function isOperator(): bool
    {
        return $this->peran === PeranUser::Operator;
    }

    public function isPimpinan(): bool
    {
        return $this->peran === PeranUser::Pimpinan;
    }

    public function isKetuaRtRw(): bool
    {
        return $this->peran === PeranUser::KetuaRtRw;
    }

    public function isKaderKesehatan(): bool
    {
        return $this->peran === PeranUser::KaderKesehatan;
    }

    public function isPetugasLapangan(): bool
    {
        return $this->isKetuaRtRw() || $this->isKaderKesehatan();
    }
}
