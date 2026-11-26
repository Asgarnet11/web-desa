<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wilayah;
use App\Policies\Concerns\ChecksWilayahAuthorization;

class WilayahPolicy
{
    use ChecksWilayahAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->status_aktif && ! $user->isPetugasLapangan();
    }

    public function view(User $user, Wilayah $wilayah): bool
    {
        return $this->viewAny($user);
    }

    public function create(User $user): bool
    {
        return $user->status_aktif && $user->isAdminWilayah();
    }

    public function update(User $user, Wilayah $wilayah): bool
    {
        return $user->status_aktif && $user->isAdminWilayah() && $this->withinUserWilayah($user, $wilayah->id);
    }

    public function delete(User $user, Wilayah $wilayah): bool
    {
        return $user->isSuperAdmin();
    }
}
