<x-guest-layout>
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h1 class="h3 mb-0">Mot de passe oublié</h1>
        </div>
        <div class="card-body">
            <p class="login-box-msg">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autofocus>
                    <div class="input-group-text">
                        <span class="bi bi-envelope"></span>
                    </div>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Envoyer le lien de réinitialisation</button>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="{{ route('login') }}">Connexion</a>
            </p>
            <p class="mb-0">
                <a href="{{ route('register') }}" class="text-center">S'inscrire</a>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</x-guest-layout>
