<?php

namespace App\Policies\Concerns;

use App\Models\User;
use App\Models\Wilayah;

trait ChecksWilayahAuthorization
{
    public function before(User $user, string $ability): ?bool
    {
        if ($user->isSuperAdmin() && $ability !== 'tamperLog') {
            return true;
        }

        return null;
    }

    protected function withinUserWilayah(User $user, ?int $targetWilayahId): bool
    {
        if (! $user->status_aktif) {
            return false;
        }

        if ($user->isSuperAdmin()) {
            return true;
        }

        if (! $user->wilayah_id || ! $targetWilayahId) {
            return false;
        }

        $wilayah = Wilayah::find($user->wilayah_id);

        if (! $wilayah) {
            return $user->wilayah_id === $targetWilayahId;
        }

        return in_array($targetWilayahId, $wilayah->getDescendantIds(true), true);
    }
}
