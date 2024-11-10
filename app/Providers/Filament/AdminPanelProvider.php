<?php

namespace App\Providers\Filament;

use App\Filament\Auth\CustomLogin;
use App\Filament\Widgets\ChatWidget;
use App\Filament\Widgets\PenggunaWidget;
use CharrafiMed\GlobalSearchModal\GlobalSearchModalPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Filament\Navigation\MenuItem;
use Filament\Support\Enums\MaxWidth;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Filament\Pages\CustomDashboardAdmin;
use App\Filament\Widgets\SewaTerbaru;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {

        // Define widgets array
        $widgets = [
            PenggunaWidget::class,
        ];

        // Conditionally add LatestSewa widget based on user permissions
        if (Gate::allows('viewLatestSewa', Auth::user())) {
            $widgets[] = SewaTerbaru::class;
        }

        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(CustomLogin::class)
            ->registration()
            ->passwordReset()
            ->emailVerification()
            ->colors([
                'primary' => ('#457AF2'),
                // 'secondary' => ('#00ff00'),
            ])
            ->font('Poppins')
            ->brandName('Po Rizky Putra 168')
            ->brandLogo(asset('images/logo_rizky_putra_168.svg'))
            ->brandLogoHeight('2rem')
            ->favicon('images/logo_rizky_putra_168.svg')

            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
                // CustomDashboardAdmin::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
                // ChatWidget::class,
                PenggunaWidget::class,
                SewaTerbaru::class,

            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])

            ->plugins([
                FilamentEditProfilePlugin::make()
                    ->shouldShowAvatarForm(
                        value: true,
                        directory: 'avatars',
                        rules: 'mimes:jpeg,png|max:1024'
                    )
                    ->setIcon('heroicon-o-user'),
                GlobalSearchModalPlugin::make()
                    ->closeButton(enabled: true)
                    ->maxWidth(MaxWidth::TwoExtraLarge)
                    ->placeholder('Ketik uncuk Mencari...')
                    ->highlightQueryStyles('background-color: yellow; font-weight: bold;'),
            ])



            ->userMenuItems([
                'profile' => MenuItem::make()
                    ->label('Edit Profile')
                    ->url(fn(): string => EditProfilePage::getUrl())
                    ->icon('heroicon-m-user-circle'),
            ])
            ->databaseNotifications();
    }
}
