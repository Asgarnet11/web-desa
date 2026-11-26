<?php

namespace App\Support;

use App\Enums\TipeWilayah;
use App\Models\Wilayah;
use Illuminate\Support\Facades\Auth;

class WilayahSelectHelper
{
    /**
     * Return hierarchical RT (or RW fallback) options scoped to the current user's assigned area.
     *
     * @return array<int, string>
     */
    public static function rtOptionsForCurrentUser(bool $includeRw = false): array
    {
        $allowedTypes = $includeRw
            ? [TipeWilayah::RT->value, TipeWilayah::RW->value]
            : [TipeWilayah::RT->value];

        $query = Wilayah::query()
            ->with('parent.parent')
            ->whereIn('tipe', $allowedTypes)
            ->orderBy('kode');

        $user = Auth::user();
        if ($user && ! $user->isSuperAdmin() && $user->wilayah_id) {
            $wilayah = Wilayah::find($user->wilayah_id);
            if ($wilayah) {
                $query->whereIn('id', $wilayah->getDescendantIds(true));
            }
        }

        $options = $query->get()
            ->mapWithKeys(fn (Wilayah $w) => [$w->id => $w->breadcrumb_nama])
            ->all();

        if ($options === [] && ! $includeRw) {
            return self::rtOptionsForCurrentUser(true);
        }

        return $options;
    }

    /**
     * Return Kelurahan & RW options for aggregate demography selection.
     *
     * @return array<int, string>
     */
    public static function aggregateWilayahOptionsForCurrentUser(): array
    {
        $query = Wilayah::query()
            ->with('parent.parent')
            ->whereIn('tipe', [TipeWilayah::Kelurahan->value, TipeWilayah::Desa->value, TipeWilayah::RW->value, TipeWilayah::RT->value])
            ->orderBy('kode');

        $user = Auth::user();
        if ($user && ! $user->isSuperAdmin() && $user->wilayah_id) {
            $wilayah = Wilayah::find($user->wilayah_id);
            if ($wilayah) {
                $query->whereIn('id', $wilayah->getDescendantIds(true));
            }
        }

        return $query->get()
            ->mapWithKeys(fn (Wilayah $w) => [$w->id => $w->breadcrumb_nama])
            ->all();
    }
}
