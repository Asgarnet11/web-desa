<?php

namespace App\Policies;

use App\Models\Demografi;
use App\Models\User;
use App\Policies\Concerns\ChecksWilayahAuthorization;

class DemografiPolicy
{
    use ChecksWilayahAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->status_aktif;
    }

    public function view(User $user, Demografi $demografi): bool
    {
        return $user->status_aktif && $this->withinUserWilayah($user, $demografi->wilayah_id);
    }

    public function create(User $user): bool
    {
        return $user->status_aktif && ($user->isOperator() || $user->isAdminWilayah());
    }

    public function update(User $user, Demografi $demografi): bool
    {
        if (! $user->status_aktif || $user->isPimpinan() || $user->isPetugasLapangan()) {
            return false;
        }

        return ($user->isOperator() || $user->isAdminWilayah()) && $this->withinUserWilayah($user, $demografi->wilayah_id);
    }

    public function delete(User $user, Demografi $demografi): bool
    {
        return $user->isSuperAdmin();
    }
}
