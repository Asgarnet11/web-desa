<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Login;
use App\Filament\Widgets\AuditTrailTerbaruWidget;
use App\Filament\Widgets\FasilitasKategoriChartWidget;
use App\Filament\Widgets\PengaduanTerbaruWidget;
use App\Filament\Widgets\QuickActionsWidget;
use App\Filament\Widgets\RoleHeaderWidget;
use App\Filament\Widgets\StatistikRingkasanWidget;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Icons\Heroicon;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->brandName('Kelurahan Sukawarna')
            ->colors([
                'primary' => '#1B4332',
                'success' => '#059669',
                'warning' => '#D97706',
                'info' => '#0284C7',
                'danger' => '#DC2626',
            ])
            ->font('Plus Jakarta Sans')
            ->sidebarCollapsibleOnDesktop()
            ->collapsibleNavigationGroups()
            ->navigationGroups([
                NavigationGroup::make('Pelayanan & Aspirasi Warga'),
                NavigationGroup::make('Geospasial & Peta'),
                NavigationGroup::make('Kependudukan & Demografi'),
                NavigationGroup::make('Pemerintahan & Sistem'),
            ])
            ->navigationItems([
                NavigationItem::make('Buka Peta Spasial')
                    ->url('/peta')
                    ->icon(Heroicon::OutlinedMap)
                    ->group('Geospasial & Peta')
                    ->sort(99)
                    ->openUrlInNewTab(),
                NavigationItem::make('Lihat Website Publik')
                    ->url('/')
                    ->icon(Heroicon::OutlinedBuildingStorefront)
                    ->group('Pelayanan & Aspirasi Warga')
                    ->sort(99)
                    ->openUrlInNewTab(),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                RoleHeaderWidget::class,
                StatistikRingkasanWidget::class,
                QuickActionsWidget::class,
                FasilitasKategoriChartWidget::class,
                PengaduanTerbaruWidget::class,
                AuditTrailTerbaruWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
