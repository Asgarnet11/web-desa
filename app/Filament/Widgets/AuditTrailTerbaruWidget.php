<?php

namespace App\Filament\Widgets;

use App\Models\LogAktivitas;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class AuditTrailTerbaruWidget extends BaseWidget
{
    protected static bool $isLazy = false;

    protected static ?int $sort = 5;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Audit Trail & Rekaman Log Aktivitas Sistem (Keamanan & Integritas Data)';

    public static function canView(): bool
    {
        return Auth::user()?->isSuperAdmin() ?? false;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                LogAktivitas::query()->with('user')->latest('id')->limit(8)
            )
            ->columns([
                TextColumn::make('created_at')
                    ->label('Waktu Transaksi')
                    ->dateTime('d M Y, H:i:s')
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Aparatur / Pengguna')
                    ->default('Sistem / Otomatis')
                    ->weight('bold')
                    ->searchable(),
                TextColumn::make('aksi')
                    ->label('Aksi')
                    ->badge()
                    ->color(fn (string $state): string => match (strtolower($state)) {
                        'tambah', 'create' => 'success',
                        'ubah', 'update' => 'warning',
                        'hapus', 'delete' => 'danger',
                        default => 'info',
                    }),
                TextColumn::make('entitas')
                    ->label('Modul / Entitas')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->fontFamily('mono')
                    ->default('127.0.0.1'),
            ])
            ->paginated(false);
    }
}
