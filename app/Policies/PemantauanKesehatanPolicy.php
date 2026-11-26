<?php

namespace App\Policies;

use App\Models\PemantauanKesehatan;
use App\Models\User;
use App\Policies\Concerns\ChecksWilayahAuthorization;

class PemantauanKesehatanPolicy
{
    use ChecksWilayahAuthorization;

    public function viewAny(User $user): bool
    {
        if (! $user->status_aktif) {
            return false;
        }

        // Strict UU PDP confidential health access: only Operator & Kader Kesehatan (+ SuperAdmin via before)
        return $user->isOperator() || $user->isKaderKesehatan();
    }

    public function view(User $user, PemantauanKesehatan $pemantauan): bool
    {
        return $this->viewAny($user) && $this->withinUserWilayah($user, $pemantauan->wilayah_id);
    }

    public function create(User $user): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user, PemantauanKesehatan $pemantauan): bool
    {
        return $this->viewAny($user) && $this->withinUserWilayah($user, $pemantauan->wilayah_id);
    }

    public function delete(User $user, PemantauanKesehatan $pemantauan): bool
    {
        return $user->isSuperAdmin();
    }
}
