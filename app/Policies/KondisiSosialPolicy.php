<?php

namespace App\Policies;

use App\Models\KondisiSosial;
use App\Models\User;
use App\Policies\Concerns\ChecksWilayahAuthorization;

class KondisiSosialPolicy
{
    use ChecksWilayahAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->status_aktif;
    }

    public function view(User $user, KondisiSosial $kondisi): bool
    {
        return $user->status_aktif && $this->withinUserWilayah($user, $kondisi->wilayah_id);
    }

    public function create(User $user): bool
    {
        return $user->status_aktif && ($user->isOperator() || $user->isKaderKesehatan() || $user->isAdminWilayah());
    }

    public function update(User $user, KondisiSosial $kondisi): bool
    {
        return $this->create($user) && $this->withinUserWilayah($user, $kondisi->wilayah_id);
    }

    public function delete(User $user, KondisiSosial $kondisi): bool
    {
        return $user->isSuperAdmin();
    }
}
