<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class Login extends Component
{
    public $nama;
    public $password;
    public $errorMessage;

    protected $rules = [
        'nama' => 'required',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        $throttleKey = $this->throttle();

        if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts = 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $this->errorMessage = 'Login Terlalu Cepat. Silahkan Coba Lagi ' . $seconds . ' Detik';
            activity()
                ->withProperties(['ip' => request()->ip()])
                ->event('login_attempt_rate_limited')
                ->log('Login rate limited for IP ' . request()->ip());
            return;
        }

        $successLogin = Auth::attempt([
            'nama' => $this->nama,
            'password' => $this->password,
        ]);

        if ($successLogin) {
            RateLimiter::clear($throttleKey);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['ip' => request()->ip()])
                ->event('login_successful')
                ->log('User ' . auth()->user()->nama . ' logged into account from IP ' . request()->ip());
            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil');
        } else {
            RateLimiter::hit($throttleKey);
            $this->errorMessage = 'Nama Atau Password Salah';
        }
    }

    public function throttle()
    {
        return $this->nama . '|' . request()->ip();
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
