<?php

namespace App\Policies;

use App\Enums\StatusVerifikasi;
use App\Models\MutasiPenduduk;
use App\Models\User;
use App\Policies\Concerns\ChecksWilayahAuthorization;

class MutasiPendudukPolicy
{
    use ChecksWilayahAuthorization;

    public function viewAny(User $user): bool
    {
        if (! $user->status_aktif) {
            return false;
        }

        return $user->isOperator() || $user->isPimpinan() || $user->isKetuaRtRw() || $user->isKaderKesehatan();
    }

    public function view(User $user, MutasiPenduduk $mutasi): bool
    {
        return $this->viewAny($user) && $this->withinUserWilayah($user, $mutasi->wilayah_id);
    }

    public function create(User $user): bool
    {
        if (! $user->status_aktif) {
            return false;
        }

        return $user->isOperator() || $user->isKetuaRtRw() || $user->isKaderKesehatan();
    }

    public function update(User $user, MutasiPenduduk $mutasi): bool
    {
        if (! $user->status_aktif || ! $this->withinUserWilayah($user, $mutasi->wilayah_id)) {
            return false;
        }

        if ($user->isOperator()) {
            return true;
        }

        return $user->isPetugasLapangan()
            && $mutasi->diajukan_oleh === $user->id
            && in_array($mutasi->status_verifikasi, [StatusVerifikasi::Draf, StatusVerifikasi::Diajukan], true);
    }

    public function verify(User $user, MutasiPenduduk $mutasi): bool
    {
        return $user->status_aktif
            && $user->isOperator()
            && $this->withinUserWilayah($user, $mutasi->wilayah_id);
    }

    public function delete(User $user, MutasiPenduduk $mutasi): bool
    {
        return $user->isSuperAdmin();
    }
}
