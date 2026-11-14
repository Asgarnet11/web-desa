<?php

namespace App\Queries;

use App\Enums\StatusVerifikasi;
use App\Models\Fasilitas;
use Illuminate\Database\Eloquent\Builder;

class FasilitasQuery
{
    protected Builder $query;

    public function __construct()
    {
        $this->query = Fasilitas::query()->with('kategori');
    }

    public static function make(): self
    {
        return new self;
    }

    public function onlyPublik(): self
    {
        $this->query->where('is_publik', true)
            ->where('status_verifikasi', StatusVerifikasi::Terverifikasi);

        return $this;
    }

    public function inWilayah(int $wilayahId): self
    {
        $this->query->where('wilayah_id', $wilayahId);

        return $this;
    }

    public function inKategori(?int $kategoriId): self
    {
        if ($kategoriId) {
            $this->query->where('kategori_id', $kategoriId);
        }

        return $this;
    }

    public function search(?string $keyword): self
    {
        if ($keyword) {
            $this->query->where(function (Builder $q) use ($keyword) {
                $q->where('nama', 'like', "%{$keyword}%")
                    ->orWhere('alamat', 'like', "%{$keyword}%")
                    ->orWhere('keterangan', 'like', "%{$keyword}%");
            });
        }

        return $this;
    }

    public function getBuilder(): Builder
    {
        return $this->query;
    }
}
