<?php

namespace App\Policies;

use App\Models\KartuKeluarga;
use App\Models\User;
use App\Policies\Concerns\ChecksWilayahAuthorization;

class KartuKeluargaPolicy
{
    use ChecksWilayahAuthorization;

    public function viewAny(User $user): bool
    {
        if (! $user->status_aktif) {
            return false;
        }

        return $user->isOperator() || $user->isPimpinan() || $user->isKetuaRtRw() || $user->isKaderKesehatan();
    }

    public function view(User $user, KartuKeluarga $kartuKeluarga): bool
    {
        return $this->viewAny($user) && $this->withinUserWilayah($user, $kartuKeluarga->wilayah_id);
    }

    public function create(User $user): bool
    {
        return $user->status_aktif && $user->isOperator();
    }

    public function update(User $user, KartuKeluarga $kartuKeluarga): bool
    {
        return $user->status_aktif && $user->isOperator() && $this->withinUserWilayah($user, $kartuKeluarga->wilayah_id);
    }

    public function delete(User $user, KartuKeluarga $kartuKeluarga): bool
    {
        return $user->isSuperAdmin();
    }
}
