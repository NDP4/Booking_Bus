<?php

namespace App\Filament\Auth;

use Filament\Pages\Auth\Login;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class CustomLogin extends Login
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getLoginFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getRememberFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getLoginFormComponent(): Component
    {
        return TextInput::make('login')
            ->label(__('Name / Email'))
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        $login_type = filter_var($data['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        return [
            $login_type => $data['login'],
            'password' => $data['password'],
        ];
    }

    public function authenticate(): ?LoginResponse
    {
        try {
            $data = $this->form->getState();
            $credentials = $this->getCredentialsFromFormData($data);

            if (!Auth::attempt($credentials, $data['remember'] ?? false)) {
                throw new AuthenticationException();
            }

            Session::regenerate();

            if (Auth::user()->role === 'konsumen') {
                return new class extends \Filament\Http\Responses\Auth\LoginResponse {
                    public function toResponse($request): RedirectResponse|Redirector
                    {
                        return redirect('/');
                    }
                };
            }

            return app(LoginResponse::class);
        } catch (AuthenticationException $e) {
            throw $e;
        }
    }
}
