<?php

namespace App\Models\Concerns;

use App\Models\Wilayah;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait HasWilayahScope
{
    /**
     * Scope a query to only include records in the user's assigned wilayah (and sub-wilayah).
     */
    public function scopeForCurrentUserWilayah(Builder $query): Builder
    {
        $user = Auth::user();

        if (! $user) {
            return $query;
        }

        // Super Admin can access all wilayah
        if ($user->isSuperAdmin()) {
            return $query;
        }

        if (! $user->wilayah_id) {
            return $query;
        }

        // Include user's own wilayah and descendant wilayah IDs
        $wilayahIds = Wilayah::where('id', $user->wilayah_id)
            ->orWhere('parent_id', $user->wilayah_id)
            ->pluck('id')
            ->toArray();

        return $query->whereIn($this->getTable().'.wilayah_id', $wilayahIds);
    }
}
