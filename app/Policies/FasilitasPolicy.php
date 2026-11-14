<?php

namespace App\Policies;

use App\Models\Fasilitas;
use App\Models\User;

class FasilitasPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return null;
    }

    public function viewAny(User $user): bool
    {
        return $user->status_aktif;
    }

    public function view(User $user, Fasilitas $fasilitas): bool
    {
        return $user->status_aktif;
    }

    public function create(User $user): bool
    {
        return $user->isOperator() || $user->isAdminWilayah();
    }

    public function update(User $user, Fasilitas $fasilitas): bool
    {
        if (! $user->status_aktif) {
            return false;
        }

        if ($user->isPimpinan()) {
            return false; // Pimpinan is read-only
        }

        if ($user->isOperator()) {
            return $user->wilayah_id === $fasilitas->wilayah_id;
        }

        return $user->isAdminWilayah();
    }

    public function delete(User $user, Fasilitas $fasilitas): bool
    {
        return $user->isSuperAdmin() || ($user->isAdminWilayah() && $user->wilayah_id === $fasilitas->wilayah_id);
    }
}

