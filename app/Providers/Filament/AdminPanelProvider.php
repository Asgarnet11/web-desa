<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Login;
use App\Filament\Pages\Dashboard;
use App\Filament\Widgets\AuditTrailTerbaruWidget;
use App\Filament\Widgets\FasilitasKategoriChartWidget;
use App\Filament\Widgets\PengaduanTerbaruWidget;
use App\Filament\Widgets\QuickActionsWidget;
use App\Filament\Widgets\RoleHeaderWidget;
use App\Filament\Widgets\StatistikRingkasanWidget;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
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
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->defaultThemeMode(ThemeMode::Light)
            ->login(Login::class)
            ->brandName('Kelurahan Konda')
            ->brandLogo(fn () => view('filament.components.brand-logo'))
            ->brandLogoHeight('2.25rem')
            ->colors([
                'primary' => '#1B4332',
                'success' => '#166534',
                'warning' => '#B45309',
                'info' => '#0369A1',
                'danger' => '#B91C1C',
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
