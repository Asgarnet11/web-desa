<?php

namespace App\Models\Concerns;

use App\Models\Wilayah;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait HasWilayahScope
{
    /**
     * Scope a query to only include records in the user's assigned wilayah and recursive descendants.
     */
    public function scopeForCurrentUserWilayah(Builder $query): Builder
    {
        $user = Auth::user();

        if (! $user) {
            return $query;
        }

        if ($user->isSuperAdmin()) {
            return $query;
        }

        if (! $user->wilayah_id) {
            return $query;
        }

        $wilayah = Wilayah::find($user->wilayah_id);

        if (! $wilayah) {
            return $query->where($this->getTable().'.wilayah_id', $user->wilayah_id);
        }

        return $query->whereIn($this->getTable().'.wilayah_id', $wilayah->getDescendantIds(true));
    }
}
