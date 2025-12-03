<x-guest-layout>
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h1 class="h3 mb-0">Inscription</h1>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Créer un nouveau compte</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nom complet" value="{{ old('name') }}" required autofocus autocomplete="name">
                    <div class="input-group-text">
                        <span class="bi bi-person"></span>
                    </div>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autocomplete="username">
                    <div class="input-group-text">
                        <span class="bi bi-envelope"></span>
                    </div>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mot de passe" required autocomplete="new-password">
                    <div class="input-group-text">
                        <span class="bi bi-lock-fill"></span>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="input-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmer le mot de passe" required autocomplete="new-password">
                    <div class="input-group-text">
                        <span class="bi bi-lock-fill"></span>
                    </div>
                    @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                            <label class="form-check-label" for="agreeTerms">
                                J'accepte les <a href="#">conditions</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">S'inscrire</button>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center mt-2 mb-3">
                <!-- Social login links could go here -->
            </div>

            <p class="mb-0">
                <a href="{{ route('login') }}" class="text-center">J'ai déjà un compte</a>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</x-guest-layout>
